<?php
namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            $this->redirectDashboard($_SESSION['role']);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->userModel->authenticate($username, $password);

            if ($user) {
                $_SESSION['status_login'] = true;
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
                $_SESSION['name'] = $user->name;
                $_SESSION['a_global'] = $user;
                $_SESSION['login'] = "You have successfully logged in!";

                if (isset($_SESSION['redirect_url'])) {
                    $redir = $_SESSION['redirect_url'];
                    unset($_SESSION['redirect_url']);
                    $this->redirect($redir);
                } else {
                    $this->redirectDashboard($user->role);
                }
            } else {
                $data['error'] = "Incorrect username or password.";
                $this->view('auth/login', $data);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function register() {
        if (isset($_SESSION['user_id'])) {
            $this->redirectDashboard($_SESSION['role']);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'role' => 'user', // Customer role
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password'])
            ];

            // Check if username exists
            if ($this->userModel->getUserByUsername($data['username'])) {
                $data['error'] = "Username is already taken.";
                $this->view('auth/register', $data);
                return;
            }

            if ($this->userModel->addUser($data)) {
                $_SESSION['login'] = "Registration successful! Please login.";
                $this->redirect('auth/login');
            } else {
                $data['error'] = "Something went wrong during registration.";
                $this->view('auth/register', $data);
            }
        } else {
            $this->view('auth/register');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['logout_success'] = true;
        $this->redirect('auth/login');
    }

    private function redirectDashboard($role) {
        if ($role === 'admin') {
            $this->redirect('admin/dashboard');
        } elseif ($role === 'supplier') {
            $this->redirect('supplier/dashboard');
        } else {
            $this->redirect('user/dashboard');
        }
    }
}
