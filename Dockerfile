FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN composer update

RUN chown -R www-data:www-data /app && a2enmod rewrite
RUN chmod -R 777 public/uploads
RUN php artisan key:generate
RUN  php artisan jwt:secret
RUN php artisan cache:clear
