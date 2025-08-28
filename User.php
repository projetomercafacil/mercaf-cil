<?php
// app/Models/User.php
class User {
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $criado_em;

    public function __construct($nome = null, $email = null, $senha = null) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    // Getters/Setters simples (opcionais)
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }
    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }
    public function getCriadoEm() { return $this->criado_em; }
}
