<?php
$host = 'localhost';
$db   = 'mercafacil';
$user = 'root'; // padrão do XAMPP
$pass = '';     // padrão do XAMPP é senha vazia

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
