web: composer warmup && vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:restart && php artisan queue:work --sleep=3 --tries=3 --daemon