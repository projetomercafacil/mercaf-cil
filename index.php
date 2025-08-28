<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mercafácil</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <div class="logo">
        <h2>🛒 Mercafácil</h2>
    </div>

    <?php if(isset($_SESSION['user'])): ?>
        <p class="welcome">Olá, <?= htmlspecialchars($_SESSION['user']['nome']) ?>!</p>
        <a href="logout.php"><button>Sair</button></a>
    <?php else: ?>
        <div class="tabs">
            <div class="tab active" onclick="showForm('login')">Login</div>
            <div class="tab" onclick="showForm('register')">Cadastro</div>
        </div>
        <!-- Login Form -->
        <form id="login" class="active" method="post" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <a href="#">Esqueceu a senha?</a>
            <button type="submit">Continue</button>
            <div class="social">
                <button type="button"> Logar com Apple</button>
                <button type="button" class="google">G Logar com Google</button>
            </div>
            <div class="switch">Não tem conta? <a href="#" onclick="showForm('register')">Cadastre-se</a></div>
        </form>
        <!-- Register Form -->
        <form id="register" method="post" action="register.php">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="password" name="confirmar" placeholder="Confirme a senha" required>
            <button type="submit">Cadastre-se</button>
            <div class="switch">Já tem conta? <a href="#" onclick="showForm('login')">Login</a></div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>