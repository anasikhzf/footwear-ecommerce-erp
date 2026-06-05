<?php
namespace App\Models;

use App\Core\Database;

class CartModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCartByUser($userId) {
        $this->db->query("SELECT c.*, s.product_name, s.product_image, u.size_value FROM cart c 
                          JOIN products s ON c.product_id = s.product_id 
                          JOIN sizes u ON c.size_id = u.size_id 
                          WHERE c.user_id = :user_id 
                          ORDER BY c.cart_id DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getCartItem($userId, $productId, $sizeId) {
        $this->db->query("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id AND size_id = :size_id");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':size_id', $sizeId);
        return $this->db->single();
    }

    public function addToCart($userId, $productId, $sizeId, $quantity, $price) {
        $existing = $this->getCartItem($userId, $productId, $sizeId);
        if ($existing) {
            $newQty = $existing->quantity + $quantity;
            $newTotal = $newQty * $price;
            $this->db->query("UPDATE cart SET quantity = :qty, total_price = :total WHERE cart_id = :id");
            $this->db->bind(':qty', $newQty);
            $this->db->bind(':total', $newTotal);
            $this->db->bind(':id', $existing->cart_id);
            return $this->db->execute();
        } else {
            $total = $quantity * $price;
            $this->db->query("INSERT INTO cart (user_id, product_id, size_id, quantity, unit_price, total_price) 
                              VALUES (:user_id, :product_id, :size_id, :quantity, :price, :total)");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':product_id', $productId);
            $this->db->bind(':size_id', $sizeId);
            $this->db->bind(':quantity', $quantity);
            $this->db->bind(':price', $price);
            $this->db->bind(':total', $total);
            return $this->db->execute();
        }
    }

    public function updateQuantity($cartId, $quantity) {
        // Fetch unit price first
        $this->db->query("SELECT unit_price FROM cart WHERE cart_id = :id");
        $this->db->bind(':id', $cartId);
        $item = $this->db->single();
        if ($item) {
            $total = $quantity * $item->unit_price;
            $this->db->query("UPDATE cart SET quantity = :qty, total_price = :total WHERE cart_id = :id");
            $this->db->bind(':qty', $quantity);
            $this->db->bind(':total', $total);
            $this->db->bind(':id', $cartId);
            return $this->db->execute();
        }
        return false;
    }

    public function removeFromCart($cartId) {
        $this->db->query("DELETE FROM cart WHERE cart_id = :id");
        $this->db->bind(':id', $cartId);
        return $this->db->execute();
    }

    public function clearCart($userId) {
        $this->db->query("DELETE FROM cart WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
}
