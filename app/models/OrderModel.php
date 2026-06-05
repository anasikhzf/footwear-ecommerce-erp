<?php
namespace App\Models;

use App\Core\Database;

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createOrder($userId, $billing, $items, $subtotal, $shipping, $total) {
        // We will execute these inserts
        // 1. Insert billing details
        $this->db->query("INSERT INTO billing_details (user_id, name, tlp_number, address) VALUES (:user_id, :name, :phone, :address)");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':name', $billing['name']);
        $this->db->bind(':phone', $billing['phone']);
        $this->db->bind(':address', $billing['address']);
        
        if ($this->db->execute()) {
            $billingId = $this->db->lastInsertId();
            
            // 2. Insert order
            $this->db->query("INSERT INTO orders (billing_id, subtotal, shipping, order_total, payment) VALUES (:billing_id, :subtotal, :shipping, :total, :payment)");
            $this->db->bind(':billing_id', $billingId);
            $this->db->bind(':subtotal', $subtotal);
            $this->db->bind(':shipping', $shipping);
            $this->db->bind(':total', $total);
            $this->db->bind(':payment', $total);
            
            if ($this->db->execute()) {
                $orderId = $this->db->lastInsertId();
                
                // 3. Insert order items & reduce stock
                foreach ($items as $item) {
                    $this->db->query("INSERT INTO order_items (order_id, sepatu_id, ukuran_id, product_price, quantity) 
                                      VALUES (:order_id, :sepatu_id, :ukuran_id, :price, :quantity)");
                    $this->db->bind(':order_id', $orderId);
                    $this->db->bind(':sepatu_id', $item->sepatu_id);
                    $this->db->bind(':ukuran_id', $item->ukuran_id);
                    $this->db->bind(':price', $item->unit_price);
                    $this->db->bind(':quantity', $item->quantity);
                    $this->db->execute();

                    // Reduce stock in ukuran_sepatu
                    $this->db->query("UPDATE ukuran_sepatu SET stok = stok - :qty 
                                      WHERE sepatu_id = :sepatu_id AND ukuran_id = :ukuran_id");
                    $this->db->bind(':qty', $item->quantity);
                    $this->db->bind(':sepatu_id', $item->sepatu_id);
                    $this->db->bind(':ukuran_id', $item->ukuran_id);
                    $this->db->execute();
                }
                return $orderId;
            }
        }
        return false;
    }

    public function getAllOrders() {
        $this->db->query("SELECT o.*, b.name, b.tlp_number, b.address, b.created_at FROM orders o 
                          JOIN billing_details b ON o.billing_id = b.billing_id 
                          ORDER BY o.order_id DESC");
        return $this->db->resultSet();
    }

    public function getOrderById($orderId) {
        $this->db->query("SELECT o.*, b.name, b.tlp_number, b.address, b.created_at, u.user_email FROM orders o 
                          JOIN billing_details b ON o.billing_id = b.billing_id 
                          JOIN user u ON b.user_id = u.user_id 
                          WHERE o.order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->single();
    }

    public function getOrderItems($orderId) {
        $this->db->query("SELECT oi.*, s.sepatu_nama, s.sepatu_gambar, u.ukuran FROM order_items oi 
                          JOIN sepatu s ON oi.sepatu_id = s.sepatu_id 
                          JOIN ukuran u ON oi.ukuran_id = u.ukuran_id 
                          WHERE oi.order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSet();
    }

    public function getSalesReport() {
        $this->db->query("SELECT o.order_id, b.name AS customer_name, b.created_at AS order_date, 
                                 s.sepatu_nama AS product_name, u.ukuran AS product_size, 
                                 oi.product_price AS price, oi.quantity, (oi.product_price * oi.quantity) AS total_revenue
                          FROM order_items oi 
                          JOIN orders o ON oi.order_id = o.order_id
                          JOIN billing_details b ON o.billing_id = b.billing_id
                          JOIN sepatu s ON oi.sepatu_id = s.sepatu_id
                          JOIN ukuran u ON oi.ukuran_id = u.ukuran_id
                          ORDER BY o.order_id DESC");
        return $this->db->resultSet();
    }

    public function getFinanceReport() {
        // We need:
        // Total orders revenue (pendapatan kotor)
        // Total completed requests cost (pengeluaran)
        // Net profit
        $this->db->query("SELECT SUM(payment) AS total_revenue FROM orders");
        $rev = $this->db->single();
        $total_revenue = $rev ? $rev->total_revenue : 0;

        $this->db->query("SELECT SUM(total_cost) AS total_cost FROM transaction_cost WHERE status_pembayaran = 'sudah dibayar'");
        $cost = $this->db->single();
        $total_cost = $cost ? $cost->total_cost : 0;

        return [
            'total_revenue' => $total_revenue ?? 0,
            'total_cost' => $total_cost ?? 0,
            'net_profit' => ($total_revenue ?? 0) - ($total_cost ?? 0)
        ];
    }
}
