FROM php:8.2-apache

# Установка расширений PHP (без mbstring)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Включение модуля rewrite
RUN a2enmod rewrite

# Копирование конфигурации PHP
COPY conf/php.ini /usr/local/etc/php/conf.d/99-custom.ini

# Копирование конфигурации Apache
COPY conf/apache-utf8.conf /etc/apache2/conf-available/
RUN a2enconf apache-utf8

# Установка рабочей директории
WORKDIR /var/www/html

# Копирование файлов сайта
COPY ./www/ /var/www/html/

# Права доступа
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

EXPOSE 80
