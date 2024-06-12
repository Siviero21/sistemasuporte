<?php
require_once '../src/config/banco.php';
require_once '../src/controllers/AutenticacaoController.php';

$autenticacao = new AutenticacaoController($pdo);
$autenticacao->logout();
?>