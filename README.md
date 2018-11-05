# Integrare Teste Backend

Desenvolvimento do projeto para o teste, onde foi feita uma api rest utilizando o framework Laravel e como front-end Vue.js


# API

Para rodar a api, você precisar ter configurado em sua maquina 
- Php >= 7.1
- Mysql
- Composer

## Rodar a api
Agora veremos o processo para subir a api (Deve-se configurar o .env da api)
```sh
$ git clone https://github.com/atiladelcanton/integrare_teste_backend.git
$ cd integrare_teste_backend/api
$ cp .env-example .env
$ composer install
$ php artisan migrate
$ php artisan serve
```
# FRONT-END
Para rodar o front-emd, você precisar ter configurado em sua maquina 

- Node.js
- npm ou yarn

## Rodar Front-End
```sh
$ git clone https://github.com/atiladelcanton/integrare_teste_backend.git
$ cd integrare_teste_backend/front
$ yarn install / npm install
$ yarn serve / npm run serve
```
> Por default a api vem configurado http://127.0.0.1:8000 que é a porta padrão do laravel, caso suba a api com alguma porta diferente
alterar em *src>service>config.js*

Obrigado pela Oportunidade!
