
# Setup Do Projeto de Agendamento

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/TR014777/projeto-laravel-11.git
```
```sh
cd projeto-laravel-11
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Crie o Arquivo .env
```sh
cp .env.example .env
```

Mude o fuso horário para o seu dentro do arquivo .env
Ex.:
```
APP_TIMEZONE=America/Sao_Paulo
```

Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

OPCIONAL: Gere o banco SQLite (caso não use o banco MySQL)
```sh
touch database/database.sqlite
```

Rodar as migrations
```sh
php artisan migrate
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
