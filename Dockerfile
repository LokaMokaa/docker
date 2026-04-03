FROM php:8.2

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY conf/php.ini /usr/local/etc/php/conf.d/99-custom.ini

WORKDIR /var/www/html
COPY ./www/ /var/www/html/

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html"]