<?php
require_once '../src/config/banco.php';
require_once '../src/controllers/ChamadoController.php';

$chamadoController = new ChamadoController($pdo);
$chamado = $chamadoController->obterChamadoPorId($_GET['id']);
$anexos = $chamadoController->obterAnexos($chamado['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['responder'])) {
        $chamadoController->adicionarResposta($chamado['id'], $_POST['resposta']);
    } elseif (isset($_POST['finalizar'])) {
        $chamadoController->finalizarChamado($chamado['id']);
    }
    header("Location: ver_chamado.php?id=" . $chamado['id']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Chamado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Detalhes do Chamado</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $chamado['titulo']; ?></h5>
                <p class="card-text"><?php echo $chamado['descricao']; ?></p>
                <p class="card-text"><strong>Status:</strong> <?php echo $chamado['status']; ?></p>
                <?php if (!empty($anexos)): ?>
                    <h5>Anexos:</h5>
                    <ul>
                        <?php foreach ($anexos as $anexo): ?>
                            <li><a href="baixar_anexo.php?id=<?php echo $anexo['id']; ?>"
                                    target="_blank"><?php echo $anexo['nome_arquivo']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <div class="mt-4">
            <h3>Responder Chamado</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="resposta">Resposta</label>
                    <textarea class="form-control" id="resposta" name="resposta" required></textarea>
                </div>
                <button type="submit" name="responder" class="btn btn-primary">Responder</button>
                <button type="submit" name="finalizar" class="btn btn-danger">Finalizar Chamado</button>
            </form>
        </div>
    </div>
</body>

</html>