# ARG PHP_VERSION=8.2

# FROM php:${PHP_VERSION}-fpm-alpine

# # persistent / runtime deps
# RUN apk add --no-cache --update linux-headers \
# 		acl \
# 		bash \
# 		fcgi \
# 		file \
# 		openssh-client \
# 		gettext \
# 		git \
# 		yarn \
# 		supervisor \
#         libmcrypt libmcrypt-dev \
#         libxml2-dev libxslt-dev freetype-dev libpng-dev libjpeg-turbo-dev \
#         zip unzip \
#         icu-data-full \
#         autoconf \
#         $PHPIZE_DEPS \
#         libstdc++ \
# 	;

# RUN apk update && apk add --no-cache postgresql-dev \
#     && docker-php-ext-install pdo pdo_pgsql

# RUN set -eux; \
# 	apk add --no-cache --virtual .build-deps \
# 		$PHPIZE_DEPS \
# 		icu-dev \
# 		libzip-dev \
# 		postgresql-client \
# 		postgresql-dev \
# 		zlib-dev \
# 	;

# RUN	docker-php-ext-configure zip; \
# 	docker-php-ext-install -j$(nproc) \
# 		intl \
# 		pgsql \
# 		pdo_pgsql \
# 		zip \
# 		xsl \
# 	; \
# 	pecl install \
# 		pcov \
# 	; \
# 	pecl clear-cache;

# RUN docker-php-ext-enable opcache

# RUN runDeps="$( \
# 		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
# 			| tr ',' '\n' \
# 			| sort -u \
# 			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
# 	)"; \
# 	apk add --no-cache --virtual .api-phpexts-rundeps $runDeps; \
# 	\
# 	apk del .build-deps

# # COMPOSER INSTALLATION
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # EXORT COMPOSER GLOBAL PATH
# ENV PATH="$PATH:$HOME/.composer/vendor/bin"

FROM php:8.1-cli

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/core_admin

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions amqp

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app

COPY . .

RUN composer update

EXPOSE 8021

CMD ["symfony", "server:start", "--no-tls", "--port=8021"]