FROM php:8.2-apache

# Установка расширений PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# ИСПРАВЛЕНИЕ MPM: отключаем event/worker, включаем prefork
RUN a2dismod mpm_event mpm_worker || true && \
    a2enmod mpm_prefork

# Включаем rewrite
RUN a2enmod rewrite

# Копирование конфигураций
COPY conf/php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY conf/apache-utf8.conf /etc/apache2/conf-available/
RUN a2enconf apache-utf8

WORKDIR /var/www/html
COPY ./www/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

EXPOSE 80