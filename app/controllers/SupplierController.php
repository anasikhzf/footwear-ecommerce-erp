<?php
namespace App\Controllers;

use App\Core\Controller;

class SupplierController extends Controller {
    private $requestModel;
    private $userModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }
        if ($_SESSION['role'] !== 'supplier') {
            $this->redirectDashboard($_SESSION['role']);
        }
        $this->requestModel = $this->model('RequestModel');
        $this->userModel = $this->model('UserModel');
    }

    public function dashboard() {
        // Fetch financial info & counts
        $allBills = $this->requestModel->getAllBills();
        
        $totalPaid = 0;
        $totalPendingCount = 0;
        $totalCompletedCount = 0;
        $paidCount = 0;
        $unpaidCount = 0;

        foreach ($allBills as $bill) {
            if ($bill->payment_status === 'paid') {
                $totalPaid += $bill->total_cost;
                $paidCount++;
            } else {
                $unpaidCount++;
            }
        }

        $allRequests = $this->requestModel->getAllRequests();
        $totalRequests = count($allRequests);
        foreach ($allRequests as $req) {
            if ($req->status === 'completed') {
                $totalCompletedCount++;
            } else {
                $totalPendingCount++;
            }
        }

        $data['revenue'] = $totalPaid;
        $data['total_requests'] = $totalRequests;
        $data['completed_requests'] = $totalCompletedCount;
        $data['pending_requests'] = $totalPendingCount;
        $data['paid_requests'] = $paidCount;
        $data['unpaid_requests'] = $unpaidCount;

        $this->view('supplier/dashboard', $data);
    }

    public function stock_requests() {
        $data['pending_requests'] = $this->requestModel->getRequestsByStatus('pending');
        $this->view('supplier/stock_requests', $data);
    }

    public function accept_request() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $requestId = $_POST['request_id'];
            if ($this->requestModel->completeRequest($requestId)) {
                $_SESSION['success'] = "Stock request completed successfully!";
            } else {
                $_SESSION['error'] = "Failed to complete stock request.";
            }
        }
        $this->redirect('supplier/stock_requests');
    }

    public function history() {
        $data['completed_requests'] = $this->requestModel->getRequestsByStatus('completed');
        $this->view('supplier/history', $data);
    }

    public function profile() {
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => !empty($_POST['password']) ? trim($_POST['password']) : $user->password
            ];

            if ($this->userModel->updateUser($data)) {
                $_SESSION['name'] = $data['name'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['a_global']->name = $data['name'];
                $_SESSION['a_global']->username = $data['username'];
                $_SESSION['a_global']->email = $data['email'];
                $_SESSION['a_global']->password = $data['password'];

                $_SESSION['success'] = "Profile updated successfully!";
                $this->redirect('supplier/profile');
            } else {
                $data['error'] = "Failed to update profile.";
                $data['user'] = $user;
                $this->view('supplier/profile', $data);
            }
        } else {
            $data['user'] = $user;
            $this->view('supplier/profile', $data);
        }
    }

    private function redirectDashboard($role) {
        if ($role === 'admin') {
            $this->redirect('admin/dashboard');
        } else {
            $this->redirect('user/dashboard');
        }
    }
}
