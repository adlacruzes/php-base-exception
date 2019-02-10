FROM php:7.0-alpine

RUN apk add ncurses wget gnupg \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && wget -q -O /usr/local/bin/phive https://phar.io/releases/phive.phar && chmod +x /usr/local/bin/phive
