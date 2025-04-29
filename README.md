# Labayar Starter Kit

This is Labayar example integration, if you only want to try [labayar](https://github.com/masraga/labayar) library without manually setup. This starter kit is using laravel 10.

### Screenshot

![labayar](https://raw.githubusercontent.com/masraga/labayar-starter-kit/refs/heads/master/screenshot/labayar.png)

### Ensure file below is exists

-   config/tripay.php
-   config/labayar.php
-   database/migrations/2025_04_07_00001_labayar_migration.php
-   database/migrations/2025_04_28_00001_labayar_product_item.php
-   database/seeders/LabayarSeeder.php
-   public/labayar-assets/\*

### Setup

1. run this in your terminal/cmd

```sh
composer install
```

2. copy .env.example to .env file
3. scroll until you find TRIPAY* and LABAYAR* prefix key, change this with your config
4. dont forget to change database config in .env file
5. run this in your terminal/cmd

```sh
php artisan migrate
```

**Note ** if you facing error like below

> SQLSTATE[HY000]: General error: 1577 Cannot proceed, because event scheduler is disabled...

Is causes your mysql event scheduler is inactive, you must setup mysql scheduler to active or if you to lazy to activing event scheduler, you can comment code in **database/migrations/2025_04_07_00001_labayar_migration.php**

```php
$expired = Constants::$paymentExpired;
    DB::unprepared("
      CREATE EVENT IF NOT EXISTS set_expired_payment
      ON SCHEDULE EVERY 5 MINUTE
      DO
        UPDATE labayar_invoice_payments
        SET payment_status = {$expired}
        WHERE expired_at < NOW()

    ");
```

and run migrate again 5. run this in your terminal

```sh
php artisan db:seed --class=LabayarSeeder
```

6. Open routes/web.php check in line 18 / check variable **$pgMode** set to use payment gateway or manual payment
7. run

```sh
php artisan serve
```

8. Open your browser and go to http://localhost:8000
