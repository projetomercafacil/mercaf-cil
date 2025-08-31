<?php
require_once __DIR__ . '/../Repositories/ShopRepository.php';

class PaymentController {
    public function checkout(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userId = $_SESSION['user']['id'] ?? 0;
        if (!$userId){ header('Location: '.BASE_URL.'/router.php?page=login'); exit; }

        $shop = new ShopRepository();
        $cartId = $shop->getOrCreateCartId($userId);
        $items = $shop->cartItems($cartId);
        if (!$items){ $_SESSION['flash']='Seu carrinho está vazio.'; header('Location: '.BASE_URL.'/router.php?page=products'); exit; }

        $method = $_POST['method'] ?? 'pix';
        $orderId = $shop->createOrder($userId, $items, $method);
        $shop->clearCart($cartId);

        $shop->addActivity($userId, 'order', ['order_id'=>$orderId,'method'=>$method]);
        $shop->createNotification($userId, 'Pedido confirmado', 'Seu pagamento foi aprovado. Pedido #'.$orderId);

        header('Location: '.BASE_URL.'/router.php?page=payment_success&order='.$orderId);
        exit;
    }

    public function success(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        require __DIR__ . '/../views/partials/header.php';
        require __DIR__ . '/../views/payment/success.php';
        require __DIR__ . '/../views/partials/footer.php';
    }
    public function process()
{
    $method = $_POST['method'] ?? 'pix';

    // Simula pagamento
    if ($method === 'pix') {
        $msg = "Pagamento via Pix realizado com sucesso!";
    } elseif ($method === 'credit') {
        $msg = "Pagamento via Cartão de Crédito aprovado!";
    } else {
        $msg = "Pagamento via Cartão de Débito aprovado!";
    }

    // Redireciona para view de sucesso
    require __DIR__ . '/../views/payment/success.php';
}

}
