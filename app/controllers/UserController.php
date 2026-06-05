<?php
namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller {
    private $productModel;
    private $categoryModel;
    private $cartModel;
    private $orderModel;
    private $userModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->cartModel = $this->model('CartModel');
        $this->orderModel = $this->model('OrderModel');
        $this->userModel = $this->model('UserModel');
    }

    public function dashboard() {
        $data['categories'] = $this->categoryModel->getAllCategories();
        $data['products'] = $this->productModel->getActiveProducts();
        $this->view('user/dashboard', $data);
    }

    public function collection() {
        $search = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';
        $category = isset($_GET['category_id']) ? trim($_GET['category_id']) : '';

        $data['products'] = $this->productModel->getActiveProducts($search, $category);
        $data['categories'] = $this->categoryModel->getAllCategories();
        $data['search_query'] = $search;
        $data['category_id'] = $category;
        
        $this->view('user/collection', $data);
    }

    public function detail($id) {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            $this->redirect('user/dashboard');
        }

        $data['product'] = $product;
        $data['sizes'] = $this->productModel->getProductSizes($id);
        
        $this->view('user/detail', $data);
    }

    // Add to cart action
    public function add_to_cart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
            $sizeId = $_POST['size_id'];
            $quantity = intval($_POST['quantity']);

            $product = $this->productModel->getProductById($productId);
            if ($product && $quantity > 0) {
                // Verify size stock exists
                $sizes = $this->productModel->getProductSizes($productId);
                $availableStock = 0;
                foreach ($sizes as $s) {
                    if ($s->ukuran_id == $sizeId) {
                        $availableStock = $s->stok;
                        break;
                    }
                }

                if ($quantity > $availableStock) {
                    $_SESSION['error'] = "Cannot add item. Requested quantity exceeds available stock ($availableStock left).";
                    $this->redirect('user/detail/' . $productId);
                }

                if (isset($_SESSION['user_id'])) {
                    $this->cartModel->addToCart($_SESSION['user_id'], $productId, $sizeId, $quantity, $product->sepatu_harga);
                } else {
                    // Temporarily store in session so redirect target (cart) can read and save to localStorage
                    $_SESSION['guest_cart_add'] = [
                        'productId' => $productId,
                        'sizeId' => $sizeId,
                        'quantity' => $quantity,
                        'name' => $product->sepatu_nama,
                        'image' => $product->sepatu_gambar,
                        'size' => $sizes[array_search($sizeId, array_column($sizes, 'ukuran_id'))]->ukuran,
                        'price' => floatval($product->sepatu_harga)
                    ];
                }
                $_SESSION['success'] = "Added to cart successfully!";
                $this->redirect('user/cart');
            }
        }
        $this->redirect('user/dashboard');
    }

    public function cart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_id'])) {
                // Update cart item action
                if (isset($_POST['action'])) {
                    $cartId = $_POST['cart_id'];
                    if ($_POST['action'] === 'remove') {
                        $this->cartModel->removeFromCart($cartId);
                    } elseif ($_POST['action'] === 'update') {
                        $qty = intval($_POST['quantity']);
                        if ($qty > 0) {
                            $this->cartModel->updateQuantity($cartId, $qty);
                        } else {
                            $this->cartModel->removeFromCart($cartId);
                        }
                    }
                }
            }
        }

        if (isset($_SESSION['user_id'])) {
            $data['cart_items'] = $this->cartModel->getCartByUser($_SESSION['user_id']);
        } else {
            $data['cart_items'] = [];
        }
        
        $this->view('user/cart', $data);
    }

    // API endpoint to sync localStorage cart after login
    public function sync_cart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input['cart']) && is_array($input['cart'])) {
                foreach ($input['cart'] as $item) {
                    $this->cartModel->addToCart(
                        $_SESSION['user_id'],
                        $item['productId'],
                        $item['sizeId'],
                        $item['quantity'],
                        $item['price']
                    );
                }
                echo json_encode(['success' => true]);
                exit;
            }
        }
        echo json_encode(['success' => false]);
        exit;
    }

    public function checkout() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_url'] = 'user/checkout';
            $this->redirect('auth/login');
        }

        $cartItems = $this->cartModel->getCartByUser($_SESSION['user_id']);
        if (empty($cartItems)) {
            $this->redirect('user/cart');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $billing = [
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address'])
            ];

            // Calculate totals
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item->total_price;
            }
            $shipping = 10000; // Flat shipping rate
            $total = $subtotal + $shipping;

            $orderId = $this->orderModel->createOrder($_SESSION['user_id'], $billing, $cartItems, $subtotal, $shipping, $total);
            
            if ($orderId) {
                // Clear cart
                $this->cartModel->clearCart($_SESSION['user_id']);
                $_SESSION['checkout_order_id'] = $orderId;
                $this->redirect('user/checkout_done');
            } else {
                $data['error'] = "Something went wrong during checkout.";
                $data['cart_items'] = $cartItems;
                $this->view('user/checkout', $data);
            }
        } else {
            $data['cart_items'] = $cartItems;
            $this->view('user/checkout', $data);
        }
    }

    public function checkout_done() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
        if (!isset($_SESSION['checkout_order_id'])) {
            $this->redirect('user/dashboard');
        }
        $orderId = $_SESSION['checkout_order_id'];
        unset($_SESSION['checkout_order_id']); // Clear after rendering

        $data['order'] = $this->orderModel->getOrderById($orderId);
        $data['items'] = $this->orderModel->getOrderItems($orderId);
        $this->view('user/checkout_done', $data);
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => !empty($_POST['password']) ? trim($_POST['password']) : $user->user_password
            ];

            if ($this->userModel->updateUser($data)) {
                // Update session globals
                $_SESSION['user_nama'] = $data['name'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['a_global']->user_nama = $data['name'];
                $_SESSION['a_global']->username = $data['username'];
                $_SESSION['a_global']->user_email = $data['email'];
                $_SESSION['a_global']->user_password = $data['password'];

                $_SESSION['success'] = "Profile updated successfully!";
                $this->redirect('user/profile');
            } else {
                $data['error'] = "Failed to update profile.";
                $data['user'] = $user;
                $this->view('user/profile', $data);
            }
        } else {
            $data['user'] = $user;
            $this->view('user/profile', $data);
        }
    }

    private function redirectDashboard($role) {
        if ($role === 'admin') {
            $this->redirect('admin/dashboard');
        } else {
            $this->redirect('supplier/dashboard');
        }
    }


}
