FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configuración del virtual host
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite