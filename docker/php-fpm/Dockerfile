FROM php:7.4-fpm

ENV DEBIAN_FRONTEND noninteractive

COPY ./docker/php-fpm/php.ini /usr/local/etc/php/php.ini

RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN apt-get update \
  && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    curl \
    libssl-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
  && docker-php-ext-install pdo_mysql pdo_pgsql ftp\
  && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

RUN apt-get update \
  && apt-get install -y \
    imagemagick \
    libmagickwand-dev \
  && pecl install imagick \
  && docker-php-ext-enable imagick

WORKDIR /srv/www/sample-app