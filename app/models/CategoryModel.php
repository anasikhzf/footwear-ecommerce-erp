<?php
namespace App\Models;

use App\Core\Database;

class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllCategories() {
        $this->db->query("SELECT * FROM kategori ORDER BY kategori_id DESC");
        return $this->db->resultSet();
    }

    public function getCategoryById($id) {
        $this->db->query("SELECT * FROM kategori WHERE kategori_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addCategory($data) {
        $this->db->query("INSERT INTO kategori (kategori_nama, kategori_gambar) VALUES (:name, :image)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function updateCategory($data) {
        if (!empty($data['image'])) {
            $this->db->query("UPDATE kategori SET kategori_nama = :name, kategori_gambar = :image WHERE kategori_id = :id");
            $this->db->bind(':image', $data['image']);
        } else {
            $this->db->query("UPDATE kategori SET kategori_nama = :name WHERE kategori_id = :id");
        }
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function deleteCategory($id) {
        $this->db->query("DELETE FROM kategori WHERE kategori_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
