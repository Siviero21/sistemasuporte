<?php

function sanitizarEntrada($dados) {
    return htmlspecialchars(stripslashes(trim($dados)));
}

function estaLogado() {
    return isset($_SESSION['usuario_id']);
}

function requerLogin() {
    if (!estaLogado()) {
        header('Location: login.php');
        exit();
    }
}
?>
