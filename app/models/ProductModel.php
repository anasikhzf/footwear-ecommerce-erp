<?php
namespace App\Models;

use App\Core\Database;

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllProducts() {
        $this->db->query("SELECT s.*, k.category_name FROM products s JOIN categories k ON s.category_id = k.category_id ORDER BY s.product_id DESC");
        return $this->db->resultSet();
    }

    public function getActiveProducts($search = '', $category_id = '') {
        $sql = "SELECT s.*, k.category_name FROM products s JOIN categories k ON s.category_id = k.category_id WHERE s.product_status = 1";
        
        if (!empty($search)) {
            $sql .= " AND s.product_name LIKE :search";
        }
        if (!empty($category_id)) {
            $sql .= " AND s.category_id = :category_id";
        }
        
        $sql .= " ORDER BY s.product_id DESC";
        
        $this->db->query($sql);
        
        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        if (!empty($category_id)) {
            $this->db->bind(':category_id', $category_id);
        }
        
        return $this->db->resultSet();
    }

    public function getProductById($id) {
        $this->db->query("SELECT s.*, k.category_name FROM products s JOIN categories k ON s.category_id = k.category_id WHERE s.product_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get sizes and stocks of product
    public function getProductSizes($product_id) {
        $this->db->query("SELECT us.*, u.size_value FROM product_sizes us JOIN sizes u ON us.size_id = u.size_id WHERE us.product_id = :product_id ORDER BY u.size_value ASC");
        $this->db->bind(':product_id', $product_id);
        return $this->db->resultSet();
    }

    // Get all sizes master
    public function getAllSizes() {
        $this->db->query("SELECT * FROM sizes ORDER BY ukuran ASC");
        return $this->db->resultSet();
    }

    // Add Product and initialize empty sizes
    public function addProduct($data) {
        $this->db->query("INSERT INTO products (category_id, product_name, product_price, product_image, product_description, product_status) VALUES (:category_id, :name, :price, :image, :description, :status)");
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        
        if ($this->db->execute()) {
            $productId = $this->db->lastInsertId();
            // Initialize sizes 1 to 8 with 0 stock
            $sizes = $this->getAllSizes();
            foreach ($sizes as $size) {
                $this->db->query("INSERT INTO product_sizes (product_id, size_id, stock) VALUES (:product_id, :size_id, 0)");
                $this->db->bind(':product_id', $productId);
                $this->db->bind(':size_id', $size->size_id);
                $this->db->execute();
            }
            return true;
        }
        return false;
    }

    public function updateProduct($data) {
        if (!empty($data['image'])) {
            $this->db->query("UPDATE products SET category_id = :category_id, product_name = :name, product_price = :price, product_image = :image, product_description = :description, product_status = :status WHERE product_id = :id");
            $this->db->bind(':image', $data['image']);
        } else {
            $this->db->query("UPDATE products SET category_id = :category_id, product_name = :name, product_price = :price, product_description = :description, product_status = :status WHERE product_id = :id");
        }
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    // Update stock of a specific size
    public function updateProductStock($productId, $sizeId, $stock) {
        $this->db->query("UPDATE product_sizes SET stock = :stock WHERE product_id = :product_id AND size_id = :size_id");
        $this->db->bind(':stock', $stock);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':size_id', $sizeId);
        return $this->db->execute();
    }

    public function deleteProduct($id) {
        // Delete related stock records first
        $this->db->query("DELETE FROM product_sizes WHERE product_id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();

        // Delete product
        $this->db->query("DELETE FROM products WHERE product_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
