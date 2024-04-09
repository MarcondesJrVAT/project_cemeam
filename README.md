<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel + Tailwind CSS + Livewire + Docker Stack

Este é um projeto que utiliza o Laravel 11, Tailwind CSS 3 e Livewire 3, com Docker(PHP + MySQL + NginX) para facilitar o desenvolvimento.
O framework laravel ja vem com pacote de autenticação Jetstream e tradução para português.

## Tecnologias Utilizadas

- **Laravel 11.1.0**: Framework PHP para desenvolvimento web.
- **Tailwind CSS 3.4.1**: Biblioteca de estilos CSS e suporte ao modo escuro.
- **Livewire 3.4.9**: Biblioteca para construção de interfaces dinâmicas no Laravel.
- **Laravel Jetstream**: Gerenciamento de autenticação de usuário, divisão por equipes, controle de sessão e autenticação de dois fatores.
- **Docker**: Utilizado para criar uma stack de desenvolvimento consistente.
    - **PHP 8.2 FPM**: Com Composer 2.7.1 e extensões necessárias para o Laravel.
    - **MySQL 8.0**
    - **Nginx 1.25**

## Como Clonar o Projeto

1. Clone o repositório:
    ```bash
    git clone https://github.com/MarcondesJuniorDev/L11PMN
    ```

2. Acesse o diretório do projeto:
    ```bash
    cd L11PMN/
    ```

## Configuração do Ambiente

1. Copie o arquivo `.env.example` para `.env`:
    ```bash
    cp .env.example .env
    ```

2. Edite o arquivo `.env` com as configurações do seu ambiente (por exemplo, banco de dados, chaves, etc.).

## Iniciar o Docker

Certifique-se de ter o Docker instalado na sua máquina.

1. Na raiz do projeto, execute:
    ```bash
    docker-compose up -d
    ```
## Instalação das Dependências

1. Instale as dependências do projeto:
    ```bash
    composer install
    ```

2. Execute as migrações do banco de dados:
    ```bash
    php artisan migrate
    ```
3. Em caso de erro ao executar as migrações, pode ser necessário acessar o container do PHP e executar o comando manualmente. Para fazer isso, utilize o seguinte comando:
    ```bash
    docker exec -it l11pmn-app-1 bash
    ```
   Dentro do container, execute:
    ```bash
    php artisan migrate
    ```
   Após concluir, saia do container digitando 'exit'.

## Certificar-se de Ter o Node.js e o npm Atualizados e Instalados na Máquina

Antes de compilar os assets do frontend, é importante certificar-se de ter o Node.js e o npm atualizados e instalados na sua máquina.

## Compilar Assets Frontend

Após garantir que o Node.js e o npm estão instalados e atualizados, siga os seguintes passos para compilar os assets do frontend:

1. **Instalar Dependências do Projeto:**

   Na raiz do projeto, execute o seguinte comando para instalar as dependências do projeto listadas no arquivo `package.json`:

   ```bash
   npm install
   ```

2. **Compilar para Desenvolvimento:**

   Para compilar os assets do frontend em modo de desenvolvimento, execute o comando:
    ```bash
    npm run dev
    ```
   Este comando irá compilar os assets do frontend e monitorar as mudanças nos arquivos.


3. **Compilar para Produção:**

   Para compilar os assets do frontend em modo de produção, execute o comando:
    ```bash
    npm run build
    ```
   Este comando irá compilar os assets do frontend para produção.


## Acessar o Projeto
1. Acesse o aplicativo em `http://localhost:8000`.

Agora o seu projeto está configurado e funcional! 🚀
