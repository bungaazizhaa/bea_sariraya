web: composer warmup && vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:work redis --daemon