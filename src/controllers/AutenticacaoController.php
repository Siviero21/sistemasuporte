<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../utils/helpers.php';

class AutenticacaoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registrar($dados) {
        $usuario = new Usuario($this->pdo);
        $usuarioExistente = $usuario->encontrarPorEmailOuCpf($dados['email'], $dados['cpf']);
        if ($usuarioExistente) {
            echo "Email ou CPF já registrado.";
            return;
        }
        $usuario->criar($dados);
        header('Location: login.php');
    }

    public function login($dados) {
        $usuario = new Usuario($this->pdo);
        $dadosUsuario = $usuario->encontrarPorEmail($dados['email']);
        if ($dadosUsuario && password_verify($dados['senha'], $dadosUsuario['senha'])) {
            session_start();
            $_SESSION['usuario_id'] = $dadosUsuario['id'];
            $_SESSION['usuario_tipo'] = $dadosUsuario['tipo'];
            header('Location: painel.php');
        } else {
            echo "Credenciais inválidas.";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
    }
}
?>
