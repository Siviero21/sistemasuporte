<?php

class EmailService
{
    private $config;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $stmt = $this->pdo->query("SELECT * FROM email_config LIMIT 1");
        $this->config = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function enviarEmail($para, $assunto, $mensagem)
    {
        $headers = 'From: ' . $this->config['from_email'] . "\r\n" .
            'Reply-To: ' . $this->config['from_email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($para, $assunto, $mensagem, $headers);
    }

    public function enviarNotificacaoChamadoAberto($chamadoTitulo, $chamadoDescricao, $clienteNome)
    {
        $assunto = "Novo Chamado Aberto: $chamadoTitulo";
        $mensagem = "Olá,\n\nUm novo chamado foi aberto por $clienteNome.\n\n" .
            "Título: $chamadoTitulo\n" .
            "Descrição: $chamadoDescricao\n\n" .
            "Por favor, acesse o sistema para mais detalhes.\n\n" .
            "Atenciosamente,\nEquipe de Suporte";

        $stmt = $this->pdo->prepare("SELECT email FROM usuarios WHERE tipo = 'colaborador'");
        $stmt->execute();
        $colaboradores = $stmt->fetchAll();

        foreach ($colaboradores as $colaborador) {
            $this->enviarEmail($colaborador['email'], $assunto, $mensagem);
        }
    }
}
?>