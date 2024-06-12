<?php

class Chamado {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criar($dados) {
        $stmt = $this->pdo->prepare("INSERT INTO chamados (titulo, descricao, status, usuario_id) VALUES (?, ?, 'Aberto', ?)");
        $stmt->execute([$dados['titulo'], $dados['descricao'], $dados['usuario_id']]);
        return $this->pdo->lastInsertId();
    }

    public function adicionarAnexo($chamadoId, $nomeArquivo, $dadosArquivo) {
        $stmt = $this->pdo->prepare("INSERT INTO chamados_anexos (chamado_id, nome_arquivo, dados_arquivo) VALUES (?, ?, ?)");
        $stmt->execute([$chamadoId, $nomeArquivo, $dadosArquivo]);
    }

    public function encontrarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM chamados WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function encontrarTodos() {
        $stmt = $this->pdo->prepare("SELECT * FROM chamados");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function atualizarStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE chamados SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }

    public function adicionarResposta($chamadoId, $resposta, $usuarioId) {
        $stmt = $this->pdo->prepare("INSERT INTO chamados_respostas (chamado_id, resposta, usuario_id) VALUES (?, ?, ?)");
        $stmt->execute([$chamadoId, $resposta, $usuarioId]);
        $this->atualizarStatus($chamadoId, 'Em atendimento');
    }

    public function finalizarChamado($id) {
        $this->atualizarStatus($id, 'Finalizado');
    }

    public function obterAnexos($chamadoId) {
        $stmt = $this->pdo->prepare("SELECT * FROM chamados_anexos WHERE chamado_id = ?");
        $stmt->execute([$chamadoId]);
        return $stmt->fetchAll();
    }

    public function obterColaboradores() {
        $stmt = $this->pdo->prepare("SELECT email FROM usuarios WHERE tipo = 'colaborador'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
