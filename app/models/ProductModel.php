<?php
namespace App\Models;

use App\Core\Database;

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllProducts() {
        $this->db->query("SELECT s.*, k.kategori_nama FROM sepatu s JOIN kategori k ON s.kategori_id = k.kategori_id ORDER BY s.sepatu_id DESC");
        return $this->db->resultSet();
    }

    public function getActiveProducts($search = '', $category_id = '') {
        $sql = "SELECT s.*, k.kategori_nama FROM sepatu s JOIN kategori k ON s.kategori_id = k.kategori_id WHERE s.sepatu_status = 1";
        
        if (!empty($search)) {
            $sql .= " AND s.sepatu_nama LIKE :search";
        }
        if (!empty($category_id)) {
            $sql .= " AND s.kategori_id = :category_id";
        }
        
        $sql .= " ORDER BY s.sepatu_id DESC";
        
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
        $this->db->query("SELECT s.*, k.kategori_nama FROM sepatu s JOIN kategori k ON s.kategori_id = k.kategori_id WHERE s.sepatu_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get sizes and stocks of product
    public function getProductSizes($product_id) {
        $this->db->query("SELECT us.*, u.ukuran FROM ukuran_sepatu us JOIN ukuran u ON us.ukuran_id = u.ukuran_id WHERE us.sepatu_id = :product_id ORDER BY u.ukuran ASC");
        $this->db->bind(':product_id', $product_id);
        return $this->db->resultSet();
    }

    // Get all sizes master
    public function getAllSizes() {
        $this->db->query("SELECT * FROM ukuran ORDER BY ukuran ASC");
        return $this->db->resultSet();
    }

    // Add Product and initialize empty sizes
    public function addProduct($data) {
        $this->db->query("INSERT INTO sepatu (kategori_id, sepatu_nama, sepatu_harga, sepatu_gambar, sepatu_deskripsi, sepatu_status) VALUES (:category_id, :name, :price, :image, :description, :status)");
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
                $this->db->query("INSERT INTO ukuran_sepatu (sepatu_id, ukuran_id, stok) VALUES (:product_id, :size_id, 0)");
                $this->db->bind(':product_id', $productId);
                $this->db->bind(':size_id', $size->ukuran_id);
                $this->db->execute();
            }
            return true;
        }
        return false;
    }

    public function updateProduct($data) {
        if (!empty($data['image'])) {
            $this->db->query("UPDATE sepatu SET kategori_id = :category_id, sepatu_nama = :name, sepatu_harga = :price, sepatu_gambar = :image, sepatu_deskripsi = :description, sepatu_status = :status WHERE sepatu_id = :id");
            $this->db->bind(':image', $data['image']);
        } else {
            $this->db->query("UPDATE sepatu SET kategori_id = :category_id, sepatu_nama = :name, sepatu_harga = :price, sepatu_deskripsi = :description, sepatu_status = :status WHERE sepatu_id = :id");
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
        $this->db->query("UPDATE ukuran_sepatu SET stok = :stock WHERE sepatu_id = :product_id AND ukuran_id = :size_id");
        $this->db->bind(':stock', $stock);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':size_id', $sizeId);
        return $this->db->execute();
    }

    public function deleteProduct($id) {
        // Delete related stock records first
        $this->db->query("DELETE FROM ukuran_sepatu WHERE sepatu_id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();

        // Delete product
        $this->db->query("DELETE FROM sepatu WHERE sepatu_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
