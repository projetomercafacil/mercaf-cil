<?php
require_once __DIR__ . '/../Models/Cart.php';
require_once __DIR__ . '/../Models/Product.php';

class CheckoutController {
    private $cart;
    private $produtoModel;

    public function __construct() {
        $this->cart = new Cart();
        $this->produtoModel = new Product();
    }

    public function show() {
        $items = $this->cart->getItems();
        $products = [];
        foreach ($items as $id => $qty) {
            $product = $this->produtoModel->getById($id);
            if ($product) {
                $product['quantity'] = $qty;
                $product['subtotal'] = $qty * $product['price'];
                $products[] = $product;
            }
        }
        $total = $this->cart->getTotal($this->produtoModel);
        include __DIR__ . '/../views/checkout.php';
    }

    public function process() {
        // Simulação de pagamento (pode ser PIX, crédito ou débito)
        $method = $_POST['payment_method'] ?? '';
        $total = $this->cart->getTotal($this->produtoModel);

        if ($method) {
            // Aqui poderia integrar com uma API de pagamento real
            $this->cart->clear();
            $message = "Pagamento de R$ " . number_format($total, 2, ',', '.') . " realizado com sucesso via $method!";
            include __DIR__ . '/../views/checkout_success.php';
        } else {
            $error = "Selecione um método de pagamento.";
            $this->show();
        }
    }
}
