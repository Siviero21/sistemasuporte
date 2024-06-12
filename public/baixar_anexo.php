<?php
require_once '../src/config/banco.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT nome_arquivo, dados_arquivo FROM chamados_anexos WHERE id = ?");
$stmt->execute([$id]);
$anexo = $stmt->fetch();

if ($anexo) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($anexo['nome_arquivo']) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($anexo['dados_arquivo']));
    echo $anexo['dados_arquivo'];
    exit;
} else {
    echo "Anexo não encontrado.";
}
?>