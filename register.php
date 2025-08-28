<?php
require_once __DIR__ . '/../app/Controllers/AuthController.php';
$auth = new AuthController();

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    $result = $auth->register($nome, $email, $senha, $confirmar);
    $message = $result['message'];
    if ($result['success']) {
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Mercafácil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <img src="assets/img/logo.png" alt="Logo Mercafácil">

        <div class="tabs">
            <a href="login.php">Login</a>
            <a href="register.php" class="active">Cadastro</a>
        </div>

        <?php if ($message): ?>
            <p style="color:red;"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="password" name="confirmar" placeholder="Confirme a senha" required>

            <button type="submit" class="btn-primary">Cadastre-se</button>
        </form>

        <div class="footer">
            Já tem conta? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>
