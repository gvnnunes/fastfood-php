# Deploy da aplicação:

### Pré-requisitos:

- Laravel 8
- PHP 7.4
- MySQL 8.0.23

## Siga estes passos para configuração do banco:
- Crie um banco de dados chamado fastfood dentro do mysql: `create database fastfood;`

- Dentro da pasta raíz do projeto edite o arquivo .env a altere os parâmetros DB_HOST, DB_USERNAME, DB_PASSWORD com os dados de acesso do seu mysql.

- O usuário configurado em DB_USERNAME deve ter permissão para acessar o banco de dados fastfood.

- Na pasta raiz do projeto execute o comando `php artisan migrate --seed` para criar as tabelas e popular o banco.

#### Credenciais para acessar o sistema:

- **Usuário:** cliente
- **Senha:** 123456

- **Usuário:** cozinha
- **Senha:** 123456

## Inicialização do servidor:

Na pasta raíz do projeto execute o comando `php artisan serve` para iniciar o servidor.

A aplicação estará rodando na sua máquina em [localhost:8000](http://localhost:8000 "localhost:8000")
