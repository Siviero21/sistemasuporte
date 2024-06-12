<?php
require_once '../src/config/banco.php';
require_once '../src/controllers/ChamadoController.php';

$chamadoController = new ChamadoController($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chamadoController->abrir($_POST, $_FILES);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abrir Chamado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Abrir Chamado</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="anexo">Anexo</label>
                <input type="file" class="form-control" id="anexo" name="anexo">
            </div>
            <button type="submit" class="btn btn-primary">Abrir Chamado</button>
        </form>
    </div>
</body>

</html>