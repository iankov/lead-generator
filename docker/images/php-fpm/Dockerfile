FROM php:8.1-fpm

ARG WWWGROUP
ARG NODE_VERSION=19

WORKDIR /var/www

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install Postgre PDO
RUN apt-get update
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

#RUN apt-get install -y libsqlite3-dev
#RUN docker-php-ext-install sqlite3

#RUN apk add composer gcc libxslt-dev libpng-dev icu-dev gettext gettext-dev msmtp
RUN apt-get install -y libc-client-dev libkrb5-dev
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install imap

RUN apt-get install -y libxml2-dev && docker-php-ext-install xml
RUN apt-get install -y libzip-dev && docker-php-ext-install zip
RUN apt-get install -y libonig-dev && docker-php-ext-install mbstring
RUN apt-get install -y libpng-dev && docker-php-ext-install gd
RUN apt-get install -y libcurl4-gnutls-dev && docker-php-ext-install curl
RUN apt-get install -y zlib1g-dev && docker-php-ext-install pdo_mysql
RUN apt-get install -y libedit-dev && docker-php-ext-install intl
#RUN apt-get install -y libldb-dev && docker-php-ext-install ldap
#RUN apt-get install -y readline-dev && docker-php-ext-install readline
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install soap
RUN docker-php-ext-install sockets

RUN apt-get install -y librabbitmq-dev libssh-dev && pecl install amqp && docker-php-ext-enable amqp

# install pecl extension
RUN pecl install msgpack && docker-php-ext-enable msgpack
RUN pecl install igbinary && docker-php-ext-enable igbinary
#RUN pecl install ds && docker-php-ext-enable ds
#RUN pecl install imagick && docker-php-ext-enable imagick
RUN pecl install redis && docker-php-ext-enable redis

RUN apt-get install -y libmemcached-dev
RUN pecl install memcached && docker-php-ext-enable memcached

RUN pecl install swoole && docker-php-ext-enable swoole
RUN pecl install pcov && docker-php-ext-enable pcov
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs
#RUN npm install -g npm

#RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
#RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \

RUN apt-get update \
    && apt-get install -y yarn \
    && apt-get install -y mariadb-client \
    && apt-get install -y postgresql-client \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.1

RUN groupadd --force -g 1000 sail
RUN useradd -ms /bin/bash --no-user-group -g 1000 -u 1337 sail

#COPY start-container /usr/local/bin/start-container
#COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
#COPY php.ini /etc/php/8.1/cli/conf.d/99-sail.ini
#RUN chmod +x /usr/local/bin/start-container

#EXPOSE 8000

#WORKDIR /var/www
CMD ["php-fpm"]
