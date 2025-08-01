<?php
// index.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mercafácil</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
    body { background: #fafafa; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 10px; }
    .container {
        width: 100%;
        max-width: 400px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        padding: 25px 20px;
    }
    .logo { text-align: center; margin-bottom: 20px; }
    .logo h2 { font-size: 1.8em; color: #333; }
    .tabs { display: flex; justify-content: space-around; margin-bottom: 20px; }
    .tab { font-weight: bold; cursor: pointer; padding: 8px 12px; }
    .active { color: red; border-bottom: 2px solid red; }
    form { display: none; flex-direction: column; }
    form.active { display: flex; }
    input[type="text"], input[type="email"], input[type="password"] {
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1em;
    }
    button {
        background: red;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1em;
        margin-top: 10px;
    }
    .social { display: flex; flex-direction: column; margin: 10px 0; }
    .social button { background: #000; margin: 5px 0; font-size: 1em; }
    .google { background: #4285F4; }
    a { color: #007BFF; text-decoration: none; font-size: 0.9em; text-align: right; margin-top: 5px; }
    .switch { text-align: center; margin-top: 12px; font-size: 0.95em; }
</style>
</head>
<body>
<div class="container">
    <div class="logo">
        <h2>🛒 Mercafácil</h2>
    </div>
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
</div>
<script>
function showForm(form) {
    document.getElementById('login').classList.remove('active');
    document.getElementById('register').classList.remove('active');
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    if(form === 'login') {
        document.getElementById('login').classList.add('active');
        document.querySelectorAll('.tab')[0].classList.add('active');
    } else {
        document.getElementById('register').classList.add('active');
        document.querySelectorAll('.tab')[1].classList.add('active');
    }
}
</script>
</body>
</html>
