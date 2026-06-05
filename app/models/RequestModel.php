<?php
namespace App\Models;

use App\Core\Database;

class RequestModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all requests
    public function getAllRequests() {
        $this->db->query("SELECT r.*, s.product_name, s.product_image, u.size_value FROM stock_requests r 
                          JOIN products s ON r.product_id = s.product_id 
                          JOIN sizes u ON r.size_id = u.size_id 
                          ORDER BY r.request_id DESC");
        return $this->db->resultSet();
    }

    // Create a new request
    public function createRequest($sepatuId, $sizesQuantities) {
        foreach ($sizesQuantities as $sizeId => $quantity) {
            if ($quantity > 0) {
                $this->db->query("INSERT INTO stock_requests (product_id, size_id, quantity, status) VALUES (:product_id, :size_id, :quantity, 'pending')");
                $this->db->bind(':product_id', $sepatuId);
                $this->db->bind(':size_id', $sizeId);
                $this->db->bind(':quantity', $quantity);
                $this->db->execute();
            }
        }
        return true;
    }

    // Get requests by status
    public function getRequestsByStatus($status) {
        $this->db->query("SELECT r.*, s.product_name, s.product_image, u.size_value FROM stock_requests r 
                          JOIN products s ON r.product_id = s.product_id 
                          JOIN sizes u ON r.size_id = u.size_id 
                          WHERE r.status = :status
                          ORDER BY r.request_id DESC");
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    // Complete a request (Supplier action)
    public function completeRequest($requestId) {
        // Get request details
        $this->db->query("SELECT * FROM stock_requests WHERE request_id = :request_id");
        $this->db->bind(':request_id', $requestId);
        $request = $this->db->single();

        if ($request) {
            // Update request status
            $this->db->query("UPDATE stock_requests SET status = 'completed' WHERE request_id = :request_id");
            $this->db->bind(':request_id', $requestId);
            $this->db->execute();

            // Increase stock
            $this->db->query("UPDATE product_sizes SET stock = stock + :qty WHERE product_id = :product_id AND size_id = :size_id");
            $this->db->bind(':qty', $request->quantity);
            $this->db->bind(':product_id', $request->product_id);
            $this->db->bind(':size_id', $request->size_id);
            $this->db->execute();

            // Fetch shoe price
            $this->db->query("SELECT product_price FROM products WHERE product_id = :product_id");
            $this->db->bind(':product_id', $request->product_id);
            $sepatu = $this->db->single();
            $product_price = $sepatu ? $sepatu->product_price : 0;

            // Calculate cost (80% of product_price)
            $unit_price = $product_price * 0.8;
            $total_cost = $unit_price * $request->quantity;

            // Record transaction cost
            $this->db->query("INSERT INTO supplier_transactions (request_id, product_id, size_id, quantity, unit_price, total_cost, payment_status) 
                              VALUES (:request_id, :product_id, :size_id, :quantity, :unit_price, :total_cost, 'unpaid')");
            $this->db->bind(':request_id', $requestId);
            $this->db->bind(':product_id', $request->product_id);
            $this->db->bind(':size_id', $request->size_id);
            $this->db->bind(':quantity', $request->quantity);
            $this->db->bind(':unit_price', $unit_price);
            $this->db->bind(':total_cost', $total_cost);
            return $this->db->execute();
        }
        return false;
    }

    // Get all bills / transaction costs
    public function getAllBills() {
        $this->db->query("SELECT tc.*, s.product_name, u.size_value, r.status FROM supplier_transactions tc 
                          JOIN products s ON tc.product_id = s.product_id 
                          JOIN sizes u ON tc.size_id = u.size_id 
                          JOIN stock_requests r ON tc.request_id = r.request_id 
                          ORDER BY tc.transaction_id DESC");
        return $this->db->resultSet();
    }

    // Get bill by ID
    public function getBillById($transactionId) {
        $this->db->query("SELECT * FROM supplier_transactions WHERE transaction_id = :id");
        $this->db->bind(':id', $transactionId);
        return $this->db->single();
    }

    // Pay bill
    public function payBill($transactionId, $amount) {
        $bill = $this->getBillById($transactionId);
        if ($bill && $amount == $bill->total_cost) {
            $this->db->query("UPDATE supplier_transactions SET payment_status = 'paid' WHERE transaction_id = :id");
            $this->db->bind(':id', $transactionId);
            return $this->db->execute();
        }
        return false;
    }
}
