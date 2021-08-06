#! [Aplicativo de exemplo]

--------
## Instalação

Por favor, verifique o guia oficial de instalação do laravel para os requisitos do servidor antes de começar. [Documentação oficial] (https://laravel.com/docs/5.4/installation#installation)

Clone o repositório

    git clone https://github.com/sandrojrs/DOKDespachante.git

Mudar para a pasta repo

    cd DOKDespachante

Instale todas as dependências usando composer

    composer install

Copie o arquivo env de exemplo e faça as alterações de configuração necessárias no arquivo .env

    cp .env.example .env

Gerar uma nova chave de aplicativo

    php artisan key:generate

Inicie o servidor de desenvolvimento local

    php artisan serve

Agora você pode acessar o servidor em http:// localhost:8000/login

** Certifique-se de definir as informações de conexão do banco de dados corretas antes de executar as migrações ** [variáveis ​​de ambiente] (# variáveis ​​de ambiente)

*** Nota ***: É recomendável ter um banco de dados limpo antes da propagação. Você pode atualizar suas migrações a qualquer momento para limpar o banco de dados executando o seguinte comando

    php artisan migrate: refresh

