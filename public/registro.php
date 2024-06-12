<?php
require_once '../src/config/banco.php';
require_once '../src/controllers/AutenticacaoController.php';

$autenticacao = new AutenticacaoController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autenticacao->registrar($_POST);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Registro de Usuário</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo de Usuário</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="cliente">Cliente</option>
                    <option value="colaborador">Colaborador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a type="button" href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
    <script src="js/cpf_mask.js"></script>
</body>

</html>