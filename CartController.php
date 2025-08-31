<?php
// app/Controllers/CartController.php

require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Cart.php';

class CartController
{
    public function show(): void
    {
        $data = Cart::itemsWithTotals();

        if (!empty($_GET['ajax'])) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
            return;
        }

        // (Opcional) Se quiser ter uma view de página inteira:
        $products = $data['items'];
        $total = $data['total'];
        require __DIR__ . '/../Views/cart/cart.php';
    }

    public function add(): void
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            $this->json(['ok' => false, 'msg' => 'ID inválido']);
            return;
        }

        $product = (new Product())->getById($id);
        if (!$product) {
            $this->json(['ok' => false, 'msg' => 'Produto não encontrado']);
            return;
        }

        Cart::add($product, 1);

        if (!empty($_GET['ajax']) || !empty($_POST['ajax'])) {
            $this->json(['ok' => true] + Cart::itemsWithTotals());
            return;
        }

        // fallback: volta para a página anterior
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASE_URL . 'router.php?page=products'));
    }

    public function remove(): void
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            Cart::remove($id);
        }

        if (!empty($_GET['ajax']) || !empty($_POST['ajax'])) {
            $this->json(['ok' => true] + Cart::itemsWithTotals());
            return;
        }

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASE_URL . 'router.php?page=products'));
    }

    private function json(array $payload): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload);
    }
}
