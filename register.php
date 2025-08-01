<?php
require 'db.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if ($senha !== $confirmar) {
    echo "❌ As senhas não coincidem!";
    exit;
}

// Verificar se email já existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    echo "❌ Email já cadastrado!";
    exit;
}

// Hash da senha
$hash = password_hash($senha, PASSWORD_DEFAULT);

// Inserir usuário
$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
if ($stmt->execute([$nome, $email, $hash])) {
    echo "✅ Usuário cadastrado com sucesso!";
} else {
    echo "❌ Erro ao cadastrar usuário.";
}
?>
<br><a href="index.php">Voltar</a>
