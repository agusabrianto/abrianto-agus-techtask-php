# Abrianto-Agus-TechTask-PHP

## Cara Instalasi (Menggunakan Composer)

- Clone repositori dengan `git clone` command:

```
git clone https://github.com/agusabrianto/abrianto-agus-techtask-php.git
```

- Masuk ke direktori `abrianto-agus-techtask-php` dengan perintah `cd abrianto-agus-techtask-php`

- Jalankan perintah `composer install`

- Jalankan perintah `symfony server:start` untuk menjalankan web server

- Buka browser pada alamat `http://localhost:8000` atau sesuai port yang tampil ketika menjalankan perintah diatas

- Buka API lunch dengan alamat `http://localhost:8000/lunch?use-by=2019-03-01`

## Cara Instalasi (Menggunakan Docker)

- Clone repositori dengan `git clone` command:

```
git clone https://github.com/agusabrianto/abrianto-agus-techtask-php.git
```

- Masuk ke direktori `abrianto-agus-techtask-php` dengan perintah `cd abrianto-agus-techtask-php`

- Jalankan perintah `composer install`

- Masuk ke direktori `abrianto-agus-techtask-php/docker` dengan perintah `cd abrianto-agus-techtask-php/docker`

- Jalankan perintah `docker-compose build`

- Jalankan perintah `docker-compose up -d`

- Buka browser pada alamat `http://localhost:8080`

- Buka API lunch dengan alamat `http://localhost:8080/lunch?use-by=2019-03-01`

## Unit Testing

```bash
php bin/phpunit
```