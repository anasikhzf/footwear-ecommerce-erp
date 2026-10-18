<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use App\Models\StockRequest;
use App\Models\SupplierTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    public function dashboard()
    {
        $allBills = SupplierTransaction::all();
        $totalPaid = $allBills->where('payment_status', 'paid')->sum('total_cost');
        $paidCount = $allBills->where('payment_status', 'paid')->count();
        $unpaidCount = $allBills->where('payment_status', 'unpaid')->count();

        $allRequests = StockRequest::all();
        $totalRequests = $allRequests->count();
        $completedRequests = $allRequests->where('status', 'completed')->count();
        $pendingRequests = $allRequests->where('status', 'pending')->count();

        return view('supplier.dashboard', compact(
            'totalPaid',
            'paidCount',
            'unpaidCount',
            'totalRequests',
            'completedRequests',
            'pendingRequests'
        ));
    }

    public function stockRequests()
    {
        $pendingRequests = StockRequest::with(['product', 'size'])
            ->where('status', 'pending')
            ->orderBy('request_id', 'desc')
            ->get();

        return view('supplier.stock_requests', compact('pendingRequests'));
    }

    public function acceptRequest(Request $request)
    {
        $request->validate([
            'request_id' => 'required|exists:stock_requests,request_id',
        ]);

        $stockRequest = StockRequest::with('product')->findOrFail($request->request_id);

        if ($stockRequest->status === 'completed') {
            return back()->with('error', 'Request has already been completed.');
        }

        // 1. Mark request as completed
        $stockRequest->status = 'completed';
        $stockRequest->save();

        // 2. Increase stock in product_sizes
        $productSize = ProductSize::firstOrCreate(
            ['product_id' => $stockRequest->product_id, 'size_id' => $stockRequest->size_id],
            ['stock' => 0]
        );
        $productSize->increment('stock', $stockRequest->quantity);

        // 3. Calculate cost (80% of product price)
        $productPrice = $stockRequest->product ? $stockRequest->product->product_price : 0;
        $unitPrice = $productPrice * 0.8;
        $totalCost = $unitPrice * $stockRequest->quantity;

        // 4. Record supplier transaction
        SupplierTransaction::create([
            'request_id' => $stockRequest->request_id,
            'product_id' => $stockRequest->product_id,
            'size_id' => $stockRequest->size_id,
            'quantity' => $stockRequest->quantity,
            'unit_price' => $unitPrice,
            'total_cost' => $totalCost,
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('supplier.stock_requests')->with('success', 'Stock request completed successfully!');
    }

    public function history()
    {
        $completedRequests = StockRequest::with(['product', 'size', 'transaction'])
            ->where('status', 'completed')
            ->orderBy('request_id', 'desc')
            ->get();

        return view('supplier.history', compact('completedRequests'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('supplier.profile', compact('user'));
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

        return redirect()->route('supplier.profile')->with('success', 'Profile updated successfully!');
    }
}
