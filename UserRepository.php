<?php
// app/Repositories/UserRepository.php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../Models/User.php';

class UserRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function save(User $user) {
        $sql = "INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->db->prepare($sql);
        $hashed = password_hash($user->senha, PASSWORD_BCRYPT);
        return $stmt->execute([
            ':nome' => $user->nome,
            ':email' => $user->email,
            ':senha' => $hashed
        ]);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}
