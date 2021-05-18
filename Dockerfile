FROM php:7.4-apache
RUN docker-php-ext-install mysqli

RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

COPY apache2.conf /etc/apache2
COPY 000-default.conf /etc/apache2/sites-available
COPY default-ssl.conf /etc/apache2/sites-available