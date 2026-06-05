<?php
namespace App\Models;

use App\Core\Database;

class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllCategories() {
        $this->db->query("SELECT * FROM categories ORDER BY category_id DESC");
        return $this->db->resultSet();
    }

    public function getCategoryById($id) {
        $this->db->query("SELECT * FROM categories WHERE category_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addCategory($data) {
        $this->db->query("INSERT INTO categories (category_name, category_image) VALUES (:name, :image)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function updateCategory($data) {
        if (!empty($data['image'])) {
            $this->db->query("UPDATE categories SET category_name = :name, category_image = :image WHERE category_id = :id");
            $this->db->bind(':image', $data['image']);
        } else {
            $this->db->query("UPDATE categories SET category_name = :name WHERE category_id = :id");
        }
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function deleteCategory($id) {
        $this->db->query("DELETE FROM categories WHERE category_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
