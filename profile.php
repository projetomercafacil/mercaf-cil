<?php
// public/profile.php
session_start();
require_once __DIR__ . '/../app/Controllers/UserController.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$uc = new UserController();
$user = $uc->getProfile($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - Mercafácil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrap">
        <h2>Meu Perfil</h2>
        <?php if ($user): ?>
            <p><strong>Nome:</strong> <?= htmlspecialchars($user['nome']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Criado em:</strong> <?= htmlspecialchars($user['criado_em']) ?></p>
        <?php else: ?>
            <p>Usuário não encontrado.</p>
        <?php endif; ?>
        <p><a href="index.php">Voltar</a></p>
    </div>
</body>
</html>
