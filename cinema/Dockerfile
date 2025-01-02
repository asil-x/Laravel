FROM php:8.2-fpm

WORKDIR /var/www/html

# Instal PDO and Extensions for Export Excel
# RUN docker-php-ext-install pdo pdo_mysql

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY /composer.lock /composer.json /var/www/html/

COPY php.ini /usr/local/etc/php/php.ini

RUN install-php-extensions pdo pdo_mysql zip gd simplexml intl

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

USER $user
