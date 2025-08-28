<?php
require_once __DIR__ . '/../app/Controllers/AuthController.php';
$auth = new AuthController();

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    if ($auth->login($email, $senha)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Email ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Mercafácil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <img src="assets/img/logo.png" alt="Logo Mercafácil">

        <div class="tabs">
            <a href="login.php" class="active">Login</a>
            <a href="register.php">Cadastro</a>
        </div>

        <?php if ($message): ?>
            <p style="color:red;"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>

            <div class="forgot">
                <a href="#">Esqueceu a senha?</a>
            </div>

            <button type="submit" class="btn-primary">Continue</button>
        </form>

        <div class="separator">ou</div>

        <div class="btn-social btn-apple"> Logar com Apple</div>
        <div class="btn-social btn-google">G Logar com Google</div>

        <div class="footer">
            Não tem conta? <a href="register.php">Cadastre-se</a>
        </div>
    </div>
</body>
</html>
