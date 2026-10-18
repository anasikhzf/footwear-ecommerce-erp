<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\StockRequest;
use App\Models\SupplierTransaction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        $categories = Category::all();
        $users = User::all();

        $totalProducts = $products->count();
        $totalCategories = $categories->count();
        $totalUsers = $users->count();
        $totalStock = ProductSize::sum('stock');

        $revenue = Order::sum('payment') ?: 0;
        $cost = SupplierTransaction::where('payment_status', 'paid')->sum('total_cost') ?: 0;
        $unpaidBills = SupplierTransaction::where('payment_status', 'unpaid')->sum('total_cost') ?: 0;

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'totalStock',
            'revenue',
            'cost',
            'unpaidBills'
        ));
    }

    public function categories()
    {
        $categories = Category::orderBy('category_id', 'desc')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $image = $request->file('image');
        $imageName = 'category' . time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('assets/kategori');

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        $image->move($destinationPath, $imageName);

        Category::create([
            'category_name' => trim($request->name),
            'category_image' => $imageName,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,category_id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $category = Category::findOrFail($request->id);
        $category->category_name = trim($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'category' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/kategori');

            // Delete old image
            $oldPath = public_path('assets/kategori/' . $category->category_image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $image->move($destinationPath, $imageName);
            $category->category_image = $imageName;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function destroyCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,category_id',
        ]);

        $category = Category::findOrFail($request->id);
        $oldPath = public_path('assets/kategori/' . $category->category_image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }

    public function products()
    {
        $products = Product::with('category')->orderBy('product_id', 'desc')->get();
        $categories = Category::all();

        return view('admin.products', compact('products', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $image = $request->file('image');
        $imageName = 'product' . time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('assets/produk');

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        $image->move($destinationPath, $imageName);

        $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => trim($request->name),
            'product_price' => (int) $request->price,
            'product_image' => $imageName,
            'product_description' => $request->description,
            'product_status' => (bool) $request->status,
        ]);

        // Initialize product sizes 1 to 8 with 0 stock
        $sizes = Size::all();
        foreach ($sizes as $size) {
            ProductSize::create([
                'product_id' => $product->product_id,
                'size_id' => $size->size_id,
                'stock' => 0,
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,product_id',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $product = Product::findOrFail($request->id);
        $product->category_id = $request->category_id;
        $product->product_name = trim($request->name);
        $product->product_price = (int) $request->price;
        $product->product_description = $request->description;
        $product->product_status = (bool) $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'product' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/produk');

            $oldPath = public_path('assets/produk/' . $product->product_image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $image->move($destinationPath, $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroyProduct(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,product_id',
        ]);

        $product = Product::findOrFail($request->id);
        $oldPath = public_path('assets/produk/' . $product->product_image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    public function stock()
    {
        $products = Product::with('sizes')->orderBy('product_id', 'desc')->get();
        return view('admin.stock', compact('products'));
    }

    public function showRequestStock($id)
    {
        $product = Product::findOrFail($id);
        $sizes = ProductSize::with('size')
            ->where('product_id', $id)
            ->join('sizes', 'product_sizes.size_id', '=', 'sizes.size_id')
            ->orderBy('sizes.size_value', 'asc')
            ->select('product_sizes.*', 'sizes.size_value')
            ->get();

        return view('admin.request_stock', compact('product', 'sizes'));
    }

    public function storeRequestStock(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $sizesQuantities = $request->input('size_value', []);

        $requestedAny = false;
        foreach ($sizesQuantities as $sizeId => $quantity) {
            $qty = (int) $quantity;
            if ($qty > 0) {
                StockRequest::create([
                    'product_id' => $product->product_id,
                    'size_id' => $sizeId,
                    'quantity' => $qty,
                    'status' => 'pending',
                ]);
                $requestedAny = true;
            }
        }

        if ($requestedAny) {
            return redirect()->route('admin.stock')->with('success', 'Stock request submitted to supplier successfully!');
        }

        return back()->with('error', 'Please specify a quantity greater than 0.');
    }

    public function users()
    {
        $users = User::orderBy('user_id', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:4',
            'role' => 'required|in:admin,supplier,user',
        ]);

        User::create([
            'name' => trim($request->name),
            'username' => trim($request->username),
            'email' => trim($request->email),
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User added successfully!');
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,user_id',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->id . ',user_id',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id . ',user_id',
            'role' => 'nullable|in:admin,supplier,user',
            'password' => 'nullable|string|min:4',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);

        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function destroyUser(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,user_id',
        ]);

        $user = User::findOrFail($request->id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    public function salesReport()
    {
        $sales = Order::with(['billingDetail', 'items.product', 'items.size'])
            ->orderBy('order_id', 'desc')
            ->get();

        return view('admin.sales_report', compact('sales'));
    }

    public function financeReport()
    {
        $revenue = Order::sum('payment') ?: 0;
        $cost = SupplierTransaction::where('payment_status', 'paid')->sum('total_cost') ?: 0;
        $netProfit = $revenue - $cost;

        $orders = Order::with('billingDetail')->orderBy('order_id', 'desc')->get();
        $payments = SupplierTransaction::with(['product', 'size', 'request'])
            ->orderBy('transaction_id', 'desc')
            ->get();

        return view('admin.finance_report', compact('revenue', 'cost', 'netProfit', 'orders', 'payments'));
    }

    public function invoices()
    {
        $bills = SupplierTransaction::with(['product', 'size', 'request'])
            ->orderBy('transaction_id', 'desc')
            ->get();

        return view('admin.invoices', compact('bills'));
    }

    public function payInvoice(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:supplier_transactions,transaction_id',
            'amount' => 'required|numeric|min:0',
        ]);

        $bill = SupplierTransaction::findOrFail($request->transaction_id);

        if ((float) $request->amount == (float) $bill->total_cost) {
            $bill->payment_status = 'paid';
            $bill->save();
            return redirect()->route('admin.invoices')->with('success', 'Supplier invoice paid successfully!');
        }

        return redirect()->route('admin.invoices')->with('error', 'Payment amount does not match invoice total.');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

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

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }
}
