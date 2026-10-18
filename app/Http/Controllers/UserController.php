<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $categories = Category::all();
        $products = Product::where('product_status', true)->orderBy('product_id', 'desc')->get();

        return view('user.dashboard', compact('categories', 'products'));
    }

    public function collection(Request $request)
    {
        $search = trim($request->input('search_query', ''));
        $categoryId = trim($request->input('category_id', ''));

        $query = Product::where('product_status', true);

        if (!empty($search)) {
            $query->where('product_name', 'like', "%{$search}%");
        }

        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->orderBy('product_id', 'desc')->get();
        $categories = Category::all();

        return view('user.collection', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function detail($id)
    {
        $product = Product::where('product_id', $id)->firstOrFail();
        $sizes = ProductSize::with('size')
            ->where('product_id', $id)
            ->join('sizes', 'product_sizes.size_id', '=', 'sizes.size_id')
            ->orderBy('sizes.size_value', 'asc')
            ->select('product_sizes.*', 'sizes.size_value')
            ->get();

        return view('user.detail', compact('product', 'sizes'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'size_id' => 'required|exists:sizes,size_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->product_id;
        $sizeId = $request->size_id;
        $quantity = (int) $request->quantity;

        $product = Product::findOrFail($productId);
        $productSize = ProductSize::with('size')
            ->where('product_id', $productId)
            ->where('size_id', $sizeId)
            ->first();

        $availableStock = $productSize ? $productSize->stock : 0;
        if ($quantity > $availableStock) {
            return back()->with('error', "Cannot add item. Requested quantity exceeds available stock ($availableStock left).");
        }

        if (Auth::check()) {
            $userId = Auth::id();
            $cartItem = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('size_id', $sizeId)
                ->first();

            if ($cartItem) {
                $newQty = $cartItem->quantity + $quantity;
                $cartItem->quantity = $newQty;
                $cartItem->total_price = $newQty * $product->product_price;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'size_id' => $sizeId,
                    'quantity' => $quantity,
                    'unit_price' => $product->product_price,
                    'total_price' => $quantity * $product->product_price,
                ]);
            }
        } else {
            // Flash for guest local cart storage
            session()->flash('guest_cart_add', [
                'productId' => $productId,
                'sizeId' => $sizeId,
                'quantity' => $quantity,
                'name' => $product->product_name,
                'image' => $product->product_image,
                'size' => $productSize && $productSize->size ? $productSize->size->size_value : '',
                'price' => (float) $product->product_price,
            ]);
        }

        return redirect()->route('user.cart')->with('success', 'Added to cart successfully!');
    }

    public function cart(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $action = $request->input('action');
            $cartId = $request->input('cart_id');

            $cartItem = Cart::where('cart_id', $cartId)->where('user_id', Auth::id())->first();
            if ($cartItem) {
                if ($action === 'remove') {
                    $cartItem->delete();
                } elseif ($action === 'update') {
                    $qty = (int) $request->input('quantity', 1);
                    if ($qty > 0) {
                        $cartItem->quantity = $qty;
                        $cartItem->total_price = $qty * $cartItem->unit_price;
                        $cartItem->save();
                    } else {
                        $cartItem->delete();
                    }
                }
            }
            return redirect()->route('user.cart');
        }

        $cartItems = Auth::check()
            ? Cart::with(['product', 'size'])->where('user_id', Auth::id())->orderBy('cart_id', 'desc')->get()
            : collect();

        return view('user.cart', compact('cartItems'));
    }

    public function syncCart(Request $request)
    {
        if (Auth::check()) {
            $items = $request->input('cart', []);
            if (is_array($items)) {
                $userId = Auth::id();
                foreach ($items as $item) {
                    if (isset($item['productId'], $item['sizeId'], $item['quantity'], $item['price'])) {
                        $cartItem = Cart::where('user_id', $userId)
                            ->where('product_id', $item['productId'])
                            ->where('size_id', $item['sizeId'])
                            ->first();

                        if ($cartItem) {
                            $cartItem->quantity += (int) $item['quantity'];
                            $cartItem->total_price = $cartItem->quantity * $cartItem->unit_price;
                            $cartItem->save();
                        } else {
                            Cart::create([
                                'user_id' => $userId,
                                'product_id' => $item['productId'],
                                'size_id' => $item['sizeId'],
                                'quantity' => (int) $item['quantity'],
                                'unit_price' => (float) $item['price'],
                                'total_price' => ((int) $item['quantity']) * ((float) $item['price']),
                            ]);
                        }
                    }
                }
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false]);
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            session(['redirect_url' => route('user.checkout')]);
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $cartItems = Cart::with(['product', 'size'])->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:50',
                'address' => 'required|string',
            ]);

            $subtotal = $cartItems->sum('total_price');
            $shipping = 10000;
            $orderTotal = $subtotal + $shipping;

            $order = DB::transaction(function () use ($userId, $request, $cartItems, $subtotal, $shipping, $orderTotal) {
                $billing = BillingDetail::create([
                    'user_id' => $userId,
                    'name' => trim($request->name),
                    'phone_number' => trim($request->phone),
                    'address' => trim($request->address),
                ]);

                $order = Order::create([
                    'billing_id' => $billing->billing_id,
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'order_total' => $orderTotal,
                    'payment' => $orderTotal,
                ]);

                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->order_id,
                        'product_id' => $item->product_id,
                        'size_id' => $item->size_id,
                        'product_price' => $item->unit_price,
                        'quantity' => $item->quantity,
                    ]);

                    ProductSize::where('product_id', $item->product_id)
                        ->where('size_id', $item->size_id)
                        ->decrement('stock', $item->quantity);
                }

                Cart::where('user_id', $userId)->delete();

                return $order;
            });

            session(['checkout_order_id' => $order->order_id]);
            return redirect()->route('user.checkout_done');
        }

        return view('user.checkout', compact('cartItems'));
    }

    public function checkoutDone()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!session()->has('checkout_order_id')) {
            return redirect()->route('user.dashboard');
        }

        $orderId = session()->pull('checkout_order_id');
        $order = Order::with('billingDetail')->findOrFail($orderId);
        $items = OrderItem::with(['product', 'size'])->where('order_id', $orderId)->get();

        return view('user.checkout_done', compact('order', 'items'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'password' => 'nullable|string|min:4',
        ]);

        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}
