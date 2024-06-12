# Sistema de Suporte
# Teste admissional ProConsult

Este é um sistema de suporte desenvolvido em PHP, utilizando Bootstrap para a interface de usuário e MySQL para o banco de dados. O sistema permite que clientes abram chamados, anexem arquivos, e que colaboradores possam gerenciar esses chamados.

## Funcionalidades

- Registro de usuários (clientes e colaboradores)
- Autenticação de usuários
- Abertura de chamados por clientes
- Anexo de arquivos aos chamados
- Listagem de chamados
- Visualização e resposta de chamados
- Envio de notificações por email para colaboradores

## Estrutura do Projeto

```plaintext
suporte/
│
├── public/
│   ├── index.php
│   ├── login.php
│   ├── registro.php
│   ├── painel.php
│   ├── abrir_chamado.php
│   ├── ver_chamado.php
│   └── baixar_anexo.php
│
├── src/
│   ├── config/
│   │   └── banco.php
│   ├── controllers/
│   │   ├── AutenticacaoController.php
│   │   └── ChamadoController.php
│   ├── models/
│   │   ├── Usuario.php
│   │   └── Chamado.php
│   ├── services/
│   │   └── EmailService.php
│   └── utils/
│       └── helpers.php
