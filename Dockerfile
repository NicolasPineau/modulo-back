FROM php:8.1-fpm

RUN apt update && \
	apt install -y git unzip libzip-dev libicu-dev
RUN docker-php-ext-install pdo pdo_mysql zip intl && \
    docker-php-ext-enable pdo pdo_mysql zip intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY --from=node:lts /usr/local/bin/node /usr/local/bin/node
COPY --from=node:lts /usr/local/lib/node_modules/ /usr/local/lib/node_modules/

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

WORKDIR /app
