<?php

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criar($dados)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, cpf, email, senha, tipo) VALUES (?, ?, ?, ?, ?)");
            $senhaHash = password_hash($dados['senha'], PASSWORD_BCRYPT);
            $stmt->execute([$dados['nome'], $dados['cpf'], $dados['email'], $senhaHash, $dados['tipo']]);
        } catch (PDOException $e) {
            //Este código é especifico para entradas duplicadas no banco de dados.
            if ($e->getCode() == 23000) {
                if (strpos($e->getMessage(), 'cpf') !== false) {
                    throw new Exception('CPF já registrado.');
                } elseif (strpos($e->getMessage(), 'email') !== false) {
                    throw new Exception('Email já registrado.');
                } else {
                    throw new Exception('Erro ao criar usuário. Dados duplicados encontrados.');
                }
            } else {
                throw new Exception('Erro ao criar usuário. Por favor, tente novamente.');
            }
        }
    }

    public function encontrarPorEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function encontrarPorCpf($cpf)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE cpf = ?");
        $stmt->execute([$cpf]);
        return $stmt->fetch();
    }
}
?>