<?php
namespace App\Models;

use App\Core\Database;

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get user by username
    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    // Get user by ID
    public function getUserById($id) {
        $this->db->query("SELECT * FROM users WHERE user_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Authenticate user
    public function authenticate($username, $password) {
        $this->db->query("SELECT * FROM users WHERE username = :username AND password = :password");
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        return $this->db->single();
    }

    // Get all users
    public function getAllUsers() {
        $this->db->query("SELECT * FROM users ORDER BY user_id DESC");
        return $this->db->resultSet();
    }

    // Add user
    public function addUser($data) {
        $this->db->query("INSERT INTO users (name, username, email, password, role) VALUES (:name, :username, :email, :password, :role)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        return $this->db->execute();
    }

    // Update user
    public function updateUser($data) {
        if (isset($data['role'])) {
            $this->db->query("UPDATE users SET name = :name, username = :username, email = :email, password = :password, role = :role WHERE user_id = :id");
            $this->db->bind(':role', $data['role']);
        } else {
            $this->db->query("UPDATE users SET name = :name, username = :username, email = :email, password = :password WHERE user_id = :id");
        }
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    // Delete user
    public function deleteUser($id) {
        $this->db->query("DELETE FROM users WHERE user_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
