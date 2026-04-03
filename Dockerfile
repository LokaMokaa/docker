FROM php:8.2-apache

# Установка расширений
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Включаем rewrite
RUN a2enmod rewrite

# Копирование конфигов
COPY conf/php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY conf/apache-utf8.conf /etc/apache2/conf-available/
RUN a2enconf apache-utf8

WORKDIR /var/www/html
COPY ./www/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

EXPOSE 80

# КРИТИЧНО ДЛЯ RAILWAY: Исправляем MPM при запуске
CMD ["/bin/bash", "-c", "a2dismod mpm_event mpm_worker 2>/dev/null; a2enmod mpm_prefork; apache2-foreground"]
