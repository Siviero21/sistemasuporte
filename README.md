# Sistema de Suporte
# Teste admissional ProConsult

Este é um sistema de suporte desenvolvido em PHP no padrão MVC, utilizando Bootstrap para a interface de usuário e MySQL para o banco de dados. O sistema permite que clientes abram chamados, anexem arquivos, e que colaboradores possam gerenciar esses chamados.

## Funcionalidades

- Registro de usuários (clientes e colaboradores)
- Autenticação de usuários
- Abertura de chamados por clientes
- Anexo de arquivos aos chamados
- Listagem de chamados
- Visualização e resposta de chamados
- Envio de notificações por email para colaboradores

## Execução deste projeto
Este projeto foi desenvolvido e executado utilizando o XAMPP v3.3.0 em um ambiente Windows. A configuração foi realizada usando o endereço localhost (127.0.0.1) e os vhosts (virtual hosts) do XAMPP. Abaixo está o exemplo de configuração do vhost utilizado:

<VirtualHost *:80>
    ServerAdmin webmaster@suporte.com
    DocumentRoot "C:/xampp/htdocs/suporte/public"
    ServerName suporte.com
</VirtualHost>

## Estrutura do Banco de Dados

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('cliente', 'colaborador') NOT NULL
);

CREATE TABLE chamados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('Aberto', 'Em atendimento', 'Finalizado') DEFAULT 'Aberto',
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE chamados_respostas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chamado_id INT,
    resposta TEXT NOT NULL,
    usuario_id INT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chamado_id) REFERENCES chamados(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE chamados_anexos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chamado_id INT,
    nome_arquivo VARCHAR(255) NOT NULL,
    dados_arquivo LONGBLOB NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chamado_id) REFERENCES chamados(id)
);

