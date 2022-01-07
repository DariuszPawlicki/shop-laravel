FROM php:8.0.3-fpm

RUN apt-get update \
&& apt-get install --yes \
    git \
    libzip-dev \
    unzip \
    wkhtmltopdf \
    zip \
    netcat \
    libpng-dev \
    cron \
    libpq-dev \
&& apt-get clean \

&& docker-php-ext-install \
    pdo \
    gd \
    zip \
    bcmath \
    sockets \
    pcntl \
&&  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./docker/php-fpm/php.ini /usr/local/etc/php/
COPY ./docker/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-php-fpm.conf

RUN mkdir /application
COPY ./application /application

RUN rm -rf /application/vendor && \
    rm -rf /application/storage/framework/cache/* && \
    rm -rf /application/storage/framework/sessions/* && \
    rm -rf /application/storage/framework/testing/* && \
    rm -rf /application/storage/framework/views/*

RUN chown -R www-data /application/bootstrap/cache && \
    chown -R www-data /application/storage/framework && \
    chown -R www-data /application/storage/logs && \
    chmod -R 777 /application/bootstrap/cache && \
    chmod -R 777 /application/storage/framework && \
    chmod -R 777 /application/storage/logs

WORKDIR /application

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev

RUN php artisan clear-compiled

EXPOSE 9000
