<?php

require_once __DIR__ . '/../models/Chamado.php';
require_once __DIR__ . '/../services/EmailService.php';
require_once __DIR__ . '/../utils/helpers.php';

class ChamadoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function abrir($dados, $arquivos) {
        session_start();
        if ($_SESSION['usuario_tipo'] !== 'cliente') {
            echo "Apenas clientes podem abrir chamados.";
            return;
        }

        $chamado = new Chamado($this->pdo);
        $chamadoId = $chamado->criar([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'usuario_id' => $_SESSION['usuario_id']
        ]);

        if (!empty($arquivos['anexo']['name'])) {
            $dadosArquivo = file_get_contents($arquivos['anexo']['tmp_name']);
            $chamado->adicionarAnexo($chamadoId, $arquivos['anexo']['name'], $dadosArquivo);
        }

        // Enviar email para colaboradores
        $emailService = new EmailService();
        $colaboradores = $chamado->obterColaboradores();
        foreach ($colaboradores as $colaborador) {
            $emailService->enviarEmail($colaborador['email'], "Novo Chamado Aberto", "Um novo chamado foi aberto. Título: {$dados['titulo']}");
        }

        header('Location: painel.php');
    }

    public function adicionarResposta($chamadoId, $resposta) {
        session_start();
        $chamado = new Chamado($this->pdo);
        $chamado->adicionarResposta($chamadoId, $resposta, $_SESSION['usuario_id']);
    }

    public function finalizarChamado($id) {
        $chamado = new Chamado($this->pdo);
        $chamado->finalizarChamado($id);
    }

    public function obterChamados() {
        $chamado = new Chamado($this->pdo);
        return $chamado->encontrarTodos();
    }

    public function obterChamadoPorId($id) {
        $chamado = new Chamado($this->pdo);
        return $chamado->encontrarPorId($id);
    }

    public function obterAnexos($chamadoId) {
        $chamado = new Chamado($this->pdo);
        return $chamado->obterAnexos($chamadoId);
    }
}
?>
