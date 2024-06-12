<?php
session_start();
require_once '../src/config/banco.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'];
    $port = $_POST['port'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $from_email = $_POST['from_email'];
    $from_name = $_POST['from_name'];

    $stmt = $pdo->prepare("INSERT INTO email_config (host, port, username, password, from_email, from_name) VALUES (?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE host = VALUES(host), port = VALUES(port), username = VALUES(username), password = VALUES(password), from_email = VALUES(from_email), from_name = VALUES(from_name)");
    $stmt->execute([$host, $port, $username, $password, $from_email, $from_name]);

    echo "Configurações de e-mail salvas com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração de E-mail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Configuração de E-mail</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="host">Host</label>
                <input type="text" class="form-control" id="host" name="host" required>
            </div>
            <div class="form-group">
                <label for="port">Porta</label>
                <input type="text" class="form-control" id="port" name="port" required>
            </div>
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="from_email">E-mail de Remetente</label>
                <input type="email" class="form-control" id="from_email" name="from_email" required>
            </div>
            <div class="form-group">
                <label for="from_name">Nome do Remetente</label>
                <input type="text" class="form-control" id="from_name" name="from_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Configurações</button>
        </form>
    </div>
</body>

</html>