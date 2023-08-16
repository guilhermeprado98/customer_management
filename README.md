<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Gerenciamento de Clientes

Antes de tudo, configure o .env conforme sua estrutura de banco de dados. Lembre-se de criar o database "customers".

Para instalar as dependências necessárias, utilize em seu terminal o seguinte comando:
composer install

Para criar uma conta no painel de clientes, utilize em seu terminal o seguinte comando:
php artisan make:filament-user

Para rodar os migrations, utilize o seguinte comando:
php artisan migrate

Para rodar a aplicação em seu ambiente, utilize o seguinte comando:
php artisan serve

## API de busca de clientes

Segue a documentação de uso da API para busca de clientes pelo nome ou por todos existentes.

<p align="center"><img src="https://github.com/guilhermeprado98/customer_management/blob/main/API-Busca-de-Clientes-1.png?raw=true" width="400"></p>
