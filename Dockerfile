FROM php:7.3.6-apache
LABEL worksena.version="1.0.0"
RUN a2enmod rewrite
RUN service apache2 restart
RUN apt update && apt install -y git 
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y libzip-dev unzip
RUN docker-php-ext-install zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
