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
        $this->db->query("SELECT r.*, s.sepatu_nama, s.sepatu_gambar, u.ukuran FROM request r 
                          JOIN sepatu s ON r.sepatu_id = s.sepatu_id 
                          JOIN ukuran u ON r.ukuran_id = u.ukuran_id 
                          ORDER BY r.request_id DESC");
        return $this->db->resultSet();
    }

    // Create a new request
    public function createRequest($sepatuId, $sizesQuantities) {
        foreach ($sizesQuantities as $sizeId => $quantity) {
            if ($quantity > 0) {
                $this->db->query("INSERT INTO request (sepatu_id, ukuran_id, quantity, status) VALUES (:sepatu_id, :ukuran_id, :quantity, 'pending')");
                $this->db->bind(':sepatu_id', $sepatuId);
                $this->db->bind(':ukuran_id', $sizeId);
                $this->db->bind(':quantity', $quantity);
                $this->db->execute();
            }
        }
        return true;
    }

    // Get requests by status
    public function getRequestsByStatus($status) {
        $this->db->query("SELECT r.*, s.sepatu_nama, s.sepatu_gambar, u.ukuran FROM request r 
                          JOIN sepatu s ON r.sepatu_id = s.sepatu_id 
                          JOIN ukuran u ON r.ukuran_id = u.ukuran_id 
                          WHERE r.status = :status
                          ORDER BY r.request_id DESC");
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    // Complete a request (Supplier action)
    public function completeRequest($requestId) {
        // Get request details
        $this->db->query("SELECT * FROM request WHERE request_id = :request_id");
        $this->db->bind(':request_id', $requestId);
        $request = $this->db->single();

        if ($request) {
            // Update request status
            $this->db->query("UPDATE request SET status = 'completed' WHERE request_id = :request_id");
            $this->db->bind(':request_id', $requestId);
            $this->db->execute();

            // Increase stock
            $this->db->query("UPDATE ukuran_sepatu SET stok = stok + :qty WHERE sepatu_id = :sepatu_id AND ukuran_id = :ukuran_id");
            $this->db->bind(':qty', $request->quantity);
            $this->db->bind(':sepatu_id', $request->sepatu_id);
            $this->db->bind(':ukuran_id', $request->ukuran_id);
            $this->db->execute();

            // Fetch shoe price
            $this->db->query("SELECT sepatu_harga FROM sepatu WHERE sepatu_id = :sepatu_id");
            $this->db->bind(':sepatu_id', $request->sepatu_id);
            $sepatu = $this->db->single();
            $sepatu_harga = $sepatu ? $sepatu->sepatu_harga : 0;

            // Calculate cost (80% of sepatu_harga)
            $unit_price = $sepatu_harga * 0.8;
            $total_cost = $unit_price * $request->quantity;

            // Record transaction cost
            $this->db->query("INSERT INTO transaction_cost (request_id, sepatu_id, ukuran_id, quantity, unit_price, total_cost, status_pembayaran) 
                              VALUES (:request_id, :sepatu_id, :ukuran_id, :quantity, :unit_price, :total_cost, 'belum dibayar')");
            $this->db->bind(':request_id', $requestId);
            $this->db->bind(':sepatu_id', $request->sepatu_id);
            $this->db->bind(':ukuran_id', $request->ukuran_id);
            $this->db->bind(':quantity', $request->quantity);
            $this->db->bind(':unit_price', $unit_price);
            $this->db->bind(':total_cost', $total_cost);
            return $this->db->execute();
        }
        return false;
    }

    // Get all bills / transaction costs
    public function getAllBills() {
        $this->db->query("SELECT tc.*, s.sepatu_nama, u.ukuran, r.status FROM transaction_cost tc 
                          JOIN sepatu s ON tc.sepatu_id = s.sepatu_id 
                          JOIN ukuran u ON tc.ukuran_id = u.ukuran_id 
                          JOIN request r ON tc.request_id = r.request_id 
                          ORDER BY tc.transaction_id DESC");
        return $this->db->resultSet();
    }

    // Get bill by ID
    public function getBillById($transactionId) {
        $this->db->query("SELECT * FROM transaction_cost WHERE transaction_id = :id");
        $this->db->bind(':id', $transactionId);
        return $this->db->single();
    }

    // Pay bill
    public function payBill($transactionId, $amount) {
        $bill = $this->getBillById($transactionId);
        if ($bill && $amount == $bill->total_cost) {
            $this->db->query("UPDATE transaction_cost SET status_pembayaran = 'sudah dibayar' WHERE transaction_id = :id");
            $this->db->bind(':id', $transactionId);
            return $this->db->execute();
        }
        return false;
    }
}
