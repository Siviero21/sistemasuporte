<?php

require_once __DIR__ . '/../models/Chamado.php';
require_once __DIR__ . '/../services/EmailService.php';

class ChamadoController {
    private $pdo;
    private $emailService;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->emailService = new EmailService($pdo);
    }

    public function abrirChamado($dados) {
        $stmt = $this->pdo->prepare("INSERT INTO chamados (titulo, descricao, status, usuario_id) VALUES (?, ?, 'Aberto', ?)");
        $stmt->execute([$dados['titulo'], $dados['descricao'], $dados['usuario_id']]);

        // Enviar notificação por email para todos os colaboradores
        $this->enviarNotificacaoChamadoAberto($dados['titulo'], $dados['descricao'], $dados['usuario_id']);
    }

    private function enviarNotificacaoChamadoAberto($titulo, $descricao, $usuario_id) {
        $stmt = $this->pdo->prepare("SELECT nome FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $cliente = $stmt->fetch();

        $this->emailService->enviarNotificacaoChamadoAberto(
            $titulo,
            $descricao,
            $cliente['nome']
        );
    }

    public function adicionarResposta($chamadoId, $resposta)
    {
        session_start();
        $chamado = new Chamado($this->pdo);
        $chamado->adicionarResposta($chamadoId, $resposta, $_SESSION['usuario_id']);
    }

    public function finalizarChamado($id)
    {
        $chamado = new Chamado($this->pdo);
        $chamado->finalizarChamado($id);
    }

    public function obterChamados()
    {
        $chamado = new Chamado($this->pdo);
        return $chamado->encontrarTodos();
    }

    public function obterChamadoPorId($id)
    {
        $chamado = new Chamado($this->pdo);
        return $chamado->encontrarPorId($id);
    }

    public function obterAnexos($chamadoId)
    {
        $chamado = new Chamado($this->pdo);
        return $chamado->obterAnexos($chamadoId);
    }
}
?>