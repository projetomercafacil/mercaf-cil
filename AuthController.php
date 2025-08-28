<?php
// app/Controllers/AuthController.php
require_once __DIR__ . '/../Repositories/UserRepository.php';

class AuthController {
    private $repo;

    public function __construct() {
        $this->repo = new UserRepository();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Register: retorna array [success => bool, message => string]
     */
    public function register($nome, $email, $senha, $confirmar) {
        $nome = trim($nome);
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        $senha = trim($senha);
        $confirmar = trim($confirmar);

        if (!$nome || !$email || !$senha) {
            return ['success' => false, 'message' => 'Preencha todos os campos corretamente.'];
        }

        if ($senha !== $confirmar) {
            return ['success' => false, 'message' => 'As senhas não conferem.'];
        }

        if ($this->repo->findByEmail($email)) {
            return ['success' => false, 'message' => 'Email já cadastrado.'];
        }

        $user = new User($nome, $email, $senha);
        $ok = $this->repo->save($user);

        if ($ok) {
            return ['success' => true, 'message' => 'Cadastro realizado com sucesso!'];
        }

        return ['success' => false, 'message' => 'Erro ao cadastrar. Tente novamente.'];
    }

    /**
     * Login: retorna bool
     */
    public function login($email, $senha) {
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        $senha = trim($senha);

        if (!$email || !$senha) {
            return false;
        }

        $user = $this->repo->findByEmail($email);
        if ($user && password_verify($senha, $user['senha'])) {
            // Proteção de sessão
            session_regenerate_id(true);
            // Armazenar apenas o necessário na sessão
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nome' => $user['nome'],
                'email' => $user['email']
            ];
            return true;
        }
        return false;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }
}
