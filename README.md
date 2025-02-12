## Kebutuhan

### Install Fillament

```bash
composer require filament/filament:"^3.2.52" -W

php artisan filament:install --panels
```

## Langkah-langkah

### Create user

Membuat user untuk login admin

```bash
php artisan make:filament-user
```

USER
name = Juna
email = itujun@example.com
password = secret

### Create model

```bash
php artisan make:model Category -m
php artisan make:model Transaction -m
```

### Create resource

```bash
php artisan make:filament-resource Category --generate
php artisan make:filament-resource Transaction --generate
```

### Lakukan symlink

Lakukan symlink agar folder Storage/app/public terhubung dengan folder Public

```bash
php artisan storage:link
```

Jika sudah melakukan symlink namun gambar masih tidak muncul, sesuaikan APP_URL pada file .env mengarah pada url yg tepat seperti:

```bash
APP_URL=http://127.0.0.1:8000
```
