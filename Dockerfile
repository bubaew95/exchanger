FROM php:8.2-fpm
RUN apt-get update  \
    && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && apt-get install -y --no-install-recommends supervisor \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip
#    && docker-php-ext-install http

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

WORKDIR /var/www/app

COPY php.ini /usr/local/etc/php
COPY supervisord.conf /etc/supervisor
COPY ./supervisor/* /etc/supervisor/conf.d

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
  && apt install -y symfony-cli \
  && git config --global user.email "fank-1191@mail.ru" \
  && git config --global user.name "Borz"

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]