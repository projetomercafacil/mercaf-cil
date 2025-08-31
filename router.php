<?php
// public/router.php
session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Database/Database.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/ProductController.php';
require_once __DIR__ . '/../app/Controllers/FavoriteController.php';
require_once __DIR__ . '/../app/Controllers/ProfileController.php';
require_once __DIR__ . '/../app/Controllers/CartController.php';
require_once __DIR__ . '/../app/Controllers/CheckoutController.php';

$authController = new AuthController();
$dashboardController = new DashboardController();
$productController = new ProductController();
$favoriteController = new FavoriteController();
$profileController = new ProfileController();
$cartController = new CartController();
$checkoutController = new CheckoutController();

$page = $_GET['page'] ?? 'login';

switch ($page) {
    // LOGIN
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $authController->login($email, $password);
        } else {
            $authController->showLogin();
        }
        break;

    // CADASTRO
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $authController->register($name, $email, $password);
        } else {
            $authController->showRegister();
        }
        break;

    // LOGOUT
    case 'logout':
        $authController->logout();
        break;

    // DASHBOARD
    case 'dashboard':
        $dashboardController->index();
        break;
    
     case 'products':
        $productController->index();
        break;
    
     case 'favorites':
        $favoriteController->index();
        break;
    
     case 'profile':
        $profileController->index();
        break;
    
    case 'payment_process':
    (new PaymentController())->process();
    break;

    case 'products':
        $productController->index();
        break;

    // ==== CARRINHO (MODAL/AJAX) ====
    case 'add_to_cart':
        $cartController->add();
        break;

    case 'remove_from_cart':
        $cartController->remove();
        break;

    case 'cart':
        $cartController->show();
        break;

    



case 'checkout':
    $checkoutController->index();
    break;

case 'checkout_process':
   $checkoutController->index();
    break;
    // ESQUECI A SENHA
    case 'forgot':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $authController->forgotPassword($email);
        } else {
            $authController->showForgot();
        }
        break;

    // RESET DE SENHA
    case 'reset':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $authController->resetPassword($token, $password);
        } else {
            $token = $_GET['token'] ?? '';
            $authController->resetPasswordPage($token);
        }
        break;

    default:
        header("Location: " . BASE_URL . "/router.php?page=login");
        exit;
}
