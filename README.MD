## Requirements

	PHP >= 7.1.3

## Install

Clone repo

```
git clone https://github.com/Julhend/Sistem-Prediksi-Persediaan-Barang
```

Install Composer


[Download Composer](https://getcomposer.org/download/)


composer update/install 

```
composer install
```

```

## How to setting 

Go into .env file and change Database credentials.
```
Run on your terminal
```

php artisan migrate --> migrate table to your database (create database manual first)

php artisan db:seed --> seed data to your database

php artisan key:generate --> generate app key

php artisan serve --> run program on localhost (http://127.0.0.1:8000/)
```
