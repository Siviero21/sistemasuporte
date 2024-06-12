<?php

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criar($dados) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, cpf, email, senha, tipo) VALUES (?, ?, ?, ?, ?)");
        $senhaHash = password_hash($dados['senha'], PASSWORD_BCRYPT);
        $stmt->execute([$dados['nome'], $dados['cpf'], $dados['email'], $senhaHash, $dados['tipo']]);
    }

    public function encontrarPorEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function encontrarPorEmailOuCpf($email, $cpf) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ? OR cpf = ?");
        $stmt->execute([$email, $cpf]);
        return $stmt->fetch();
    }
}
?>
