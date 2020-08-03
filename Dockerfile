FROM php:7.4-fpm-alpine

COPY ./src /var/www/html
WORKDIR /var/www/html


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql

RUN composer update

RUN chown -R www-data:www-data /var/www/html 
# RUN chmod -R 777 public/uploads
# RUN php artisan key:generate
# RUN  php artisan jwt:secret
RUN php artisan cache:clear
