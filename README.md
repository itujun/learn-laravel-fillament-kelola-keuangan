## Kebutuhan

### Install Fillament

```bash
composer require filament/filament:"^3.2.52" -W

php artisan filament:install --panels
```

#### Create user

Membuat user untuk login admin

```bash
php artisan make:filament-user
```

USER
name = Juna
email = itujun@example.com
password = secret

#### Create model

```bash
php artisan make:model Category -m
php artisan make:model Transaction -m
```
