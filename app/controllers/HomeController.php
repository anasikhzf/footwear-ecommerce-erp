<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role_id'] == 1) {
                $this->redirect('admin/dashboard');
            } elseif ($_SESSION['role_id'] == 3) {
                $this->redirect('supplier/dashboard');
            } else {
                $this->redirect('user/dashboard');
            }
        } else {
            $this->redirect('user/dashboard');
        }
    }
}
