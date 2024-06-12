<?php
session_start();
require_once '../src/config/banco.php';
require_once '../src/utils/helpers.php';
require_once '../src/controllers/ChamadoController.php';
requerLogin();

$chamadoController = new ChamadoController($pdo);
$chamados = $chamadoController->obterChamados();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h2>Painel</h2>
            <a type="button" href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <a type="button" href="config_email.php" class="btn btn-success">Configurações de Email</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Chamados Abertos</h5>
                <p class="card-text">Aqui você pode ver e gerenciar seus chamados.</p>
                <a href="abrir_chamado.php" class="btn btn-primary">Abrir Novo Chamado</a>
            </div>
        </div>
        <div class="mt-4">
            <h3>Lista de Chamados</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($chamados as $chamado): ?>
                        <tr>
                            <td><?php echo $chamado['id']; ?></td>
                            <td><?php echo $chamado['titulo']; ?></td>
                            <td><?php echo $chamado['status']; ?></td>
                            <td>
                                <a href="ver_chamado.php?id=<?php echo $chamado['id']; ?>"
                                    class="btn btn-info btn-sm">Ver</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>