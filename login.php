<?php
require 'db.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Buscar usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($senha, $user['senha'])) {
    echo "✅ Login realizado com sucesso! Bem-vindo, " . htmlspecialchars($user['nome']);
} else {
    echo "❌ Email ou senha inválidos.";
}
?>
<br><a href="index.php">Voltar</a>
