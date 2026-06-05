<?php
namespace App\Controllers;

use App\Core\Controller;

class AdminController extends Controller {
    private $productModel;
    private $categoryModel;
    private $requestModel;
    private $userModel;
    private $orderModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }
        if ($_SESSION['role'] !== 'admin') {
            $this->redirectDashboard($_SESSION['role']);
        }
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->requestModel = $this->model('RequestModel');
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
    }

    public function dashboard() {
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        $users = $this->userModel->getAllUsers();
        
        $totalProducts = count($products);
        $totalCategories = count($categories);
        $totalUsers = count($users);

        // Calculate total stock
        $totalStock = 0;
        foreach ($products as $product) {
            $sizes = $this->productModel->getProductSizes($product->product_id);
            foreach ($sizes as $size) {
                $totalStock += $size->stock;
            }
        }

        $finance = $this->orderModel->getFinanceReport();
        
        // Count unpaid supplier bills
        $bills = $this->requestModel->getAllBills();
        $totalUnpaidBillsAmount = 0;
        foreach ($bills as $bill) {
            if ($bill->payment_status === 'unpaid') {
                $totalUnpaidBillsAmount += $bill->total_cost;
            }
        }

        $data = [
            'total_products' => $totalProducts,
            'total_categories' => $totalCategories,
            'total_users' => $totalUsers,
            'total_stock' => $totalStock,
            'revenue' => $finance['total_revenue'],
            'cost' => $finance['total_cost'],
            'unpaid_bills' => $totalUnpaidBillsAmount
        ];

        $this->view('admin/dashboard', $data);
    }

    // Category Management
    public function categories() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['action'] ?? '';
            
            if ($action === 'add') {
                $name = trim($_POST['name']);
                
                // Handle file upload
                $imageName = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['image']['tmp_name'];
                    $fileName = $_FILES['image']['name'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = 'category' . time() . '.' . $fileExtension;
                    
                    $uploadFileDir = __DIR__ . '/../../public/assets/kategori/';
                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0777, true);
                    }
                    $dest_path = $uploadFileDir . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $imageName = $newFileName;
                    }
                }

                if (!empty($name) && !empty($imageName)) {
                    $this->categoryModel->addCategory(['name' => $name, 'image' => $imageName]);
                    $_SESSION['success'] = "Category added successfully!";
                } else {
                    $_SESSION['error'] = "Category name and image are required.";
                }
            } elseif ($action === 'edit') {
                $id = $_POST['id'];
                $name = trim($_POST['name']);
                $imageName = '';

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['image']['tmp_name'];
                    $fileName = $_FILES['image']['name'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = 'category' . time() . '.' . $fileExtension;
                    
                    $uploadFileDir = __DIR__ . '/../../public/assets/kategori/';
                    $dest_path = $uploadFileDir . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $imageName = $newFileName;
                        // Delete old image
                        $oldCategory = $this->categoryModel->getCategoryById($id);
                        if ($oldCategory && file_exists($uploadFileDir . $oldCategory->category_image)) {
                            unlink($uploadFileDir . $oldCategory->category_image);
                        }
                    }
                }

                $this->categoryModel->updateCategory(['id' => $id, 'name' => $name, 'image' => $imageName]);
                $_SESSION['success'] = "Category updated successfully!";
            } elseif ($action === 'delete') {
                $id = $_POST['id'];
                // Delete image file first
                $category = $this->categoryModel->getCategoryById($id);
                if ($category) {
                    $uploadFileDir = __DIR__ . '/../../public/assets/kategori/';
                    if (file_exists($uploadFileDir . $category->category_image)) {
                        unlink($uploadFileDir . $category->category_image);
                    }
                    $this->categoryModel->deleteCategory($id);
                    $_SESSION['success'] = "Category deleted successfully!";
                }
            }
            $this->redirect('admin/categories');
        }

        $data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('admin/categories', $data);
    }

    // Product Management
    public function products() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'add') {
                $name = trim($_POST['name']);
                $categoryId = $_POST['category_id'];
                $price = intval($_POST['price']);
                $description = $_POST['description'];
                $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
                
                $imageName = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['image']['tmp_name'];
                    $fileName = $_FILES['image']['name'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = 'product' . time() . '.' . $fileExtension;
                    
                    $uploadFileDir = __DIR__ . '/../../public/assets/produk/';
                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0777, true);
                    }
                    $dest_path = $uploadFileDir . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $imageName = $newFileName;
                    }
                }

                if (!empty($name) && !empty($imageName)) {
                    $this->productModel->addProduct([
                        'category_id' => $categoryId,
                        'name' => $name,
                        'price' => $price,
                        'image' => $imageName,
                        'description' => $description,
                        'status' => $status
                    ]);
                    $_SESSION['success'] = "Product added successfully!";
                } else {
                    $_SESSION['error'] = "Product name and image are required.";
                }
            } elseif ($action === 'edit') {
                $id = $_POST['id'];
                $name = trim($_POST['name']);
                $categoryId = $_POST['category_id'];
                $price = intval($_POST['price']);
                $description = $_POST['description'];
                $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
                
                $imageName = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['image']['tmp_name'];
                    $fileName = $_FILES['image']['name'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = 'product' . time() . '.' . $fileExtension;
                    
                    $uploadFileDir = __DIR__ . '/../../public/assets/produk/';
                    $dest_path = $uploadFileDir . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $imageName = $newFileName;
                        // Delete old image
                        $oldProduct = $this->productModel->getProductById($id);
                        if ($oldProduct && file_exists($uploadFileDir . $oldProduct->product_image)) {
                            unlink($uploadFileDir . $oldProduct->product_image);
                        }
                    }
                }

                $this->productModel->updateProduct([
                    'id' => $id,
                    'category_id' => $categoryId,
                    'name' => $name,
                    'price' => $price,
                    'image' => $imageName,
                    'description' => $description,
                    'status' => $status
                ]);
                $_SESSION['success'] = "Product updated successfully!";
            } elseif ($action === 'delete') {
                $id = $_POST['id'];
                $product = $this->productModel->getProductById($id);
                if ($product) {
                    $uploadFileDir = __DIR__ . '/../../public/assets/produk/';
                    if (file_exists($uploadFileDir . $product->product_image)) {
                        unlink($uploadFileDir . $product->product_image);
                    }
                    $this->productModel->deleteProduct($id);
                    $_SESSION['success'] = "Product deleted successfully!";
                }
            }
            $this->redirect('admin/products');
        }

        $data['products'] = $this->productModel->getAllProducts();
        $data['categories'] = $this->categoryModel->getAllCategories();
        $this->view('admin/products', $data);
    }

    // Stock Management (Admin stock display and supplier requests)
    public function stock() {
        $data['products'] = $this->productModel->getAllProducts();
        $this->view('admin/stock', $data);
    }

    public function request_stock($id) {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            $this->redirect('admin/stock');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sizes = $_POST['size_value'] ?? [];
            if ($this->requestModel->createRequest($id, $sizes)) {
                $_SESSION['success'] = "Stock request submitted to supplier successfully!";
                $this->redirect('admin/stock');
            } else {
                $_SESSION['error'] = "Failed to submit stock request.";
            }
        }

        $data['product'] = $product;
        $data['sizes'] = $this->productModel->getProductSizes($id);
        $this->view('admin/request_stock', $data);
    }

    // User Management CRUD
    public function users() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['action'] ?? '';
            
            if ($action === 'add') {
                $data = [
                    'role' => trim($_POST['role']),
                    'name' => trim($_POST['name']),
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password'])
                ];

                if ($this->userModel->getUserByUsername($data['username'])) {
                    $_SESSION['error'] = "Username is already taken.";
                } else {
                    $this->userModel->addUser($data);
                    $_SESSION['success'] = "User added successfully!";
                }
            } elseif ($action === 'edit') {
                $id = $_POST['id'];
                $user = $this->userModel->getUserById($id);
                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => !empty($_POST['password']) ? trim($_POST['password']) : $user->password
                ];
                $this->userModel->updateUser($data);
                $_SESSION['success'] = "User updated successfully!";
            } elseif ($action === 'delete') {
                $id = $_POST['id'];
                $this->userModel->deleteUser($id);
                $_SESSION['success'] = "User deleted successfully!";
            }
            $this->redirect('admin/users');
        }

        $data['users'] = $this->userModel->getAllUsers();
        $this->view('admin/users', $data);
    }

    // Reports
    public function sales_report() {
        $data['sales'] = $this->orderModel->getSalesReport();
        $this->view('admin/sales_report', $data);
    }

    public function finance_report() {
        $finance = $this->orderModel->getFinanceReport();
        $data['revenue'] = $finance['total_revenue'];
        $data['cost'] = $finance['total_cost'];
        $data['net_profit'] = $finance['net_profit'];
        
        // Fetch financial history
        $data['orders'] = $this->orderModel->getAllOrders();
        $data['payments'] = $this->requestModel->getAllBills();

        $this->view('admin/finance_report', $data);
    }

    // Invoices (Tagihan Supplier)
    public function invoices() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $transactionId = $_POST['transaction_id'];
            $amount = floatval($_POST['amount']);

            if ($this->requestModel->payBill($transactionId, $amount)) {
                $_SESSION['success'] = "Supplier invoice paid successfully!";
            } else {
                $_SESSION['error'] = "Payment amount does not match invoice total.";
            }
            $this->redirect('admin/invoices');
        }

        $data['bills'] = $this->requestModel->getAllBills();
        $this->view('admin/invoices', $data);
    }

    // Profile Settings
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
                $this->redirect('admin/profile');
            } else {
                $data['error'] = "Failed to update profile.";
                $data['user'] = $user;
                $this->view('admin/profile', $data);
            }
        } else {
            $data['user'] = $user;
            $this->view('admin/profile', $data);
        }
    }

    private function redirectDashboard($role) {
        if ($role === 'supplier') {
            $this->redirect('supplier/dashboard');
        } else {
            $this->redirect('user/dashboard');
        }
    }
}
