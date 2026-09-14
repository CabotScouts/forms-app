FROM composer:2.2 AS build

WORKDIR /build
COPY src ./
RUN composer install --optimize-autoloader --no-interaction --no-progress

FROM alpine:3.24

WORKDIR /data

RUN apk add --no-cache \
  curl \
  mysql-client \
  nginx \
  php85 \
  php85-bcmath \
  php85-cli \
  php85-ctype \
  php85-curl \
  php85-dom \
  php85-fileinfo \
  php85-fpm \
  php85-gd \
  php85-imap \
  php85-intl \
  php85-ldap \
  php85-mbstring \
  php85-openssl \
  php85-pdo_mysql \
  php85-pdo_sqlite \
  php85-pecl-igbinary \
  php85-pecl-imagick \
  php85-pecl-memcached \
  php85-pecl-msgpack \
  php85-pecl-pcov \
  # php85-pecl-swoole \
  php85-phar \
  php85-redis \
  php85-session \
  php85-soap \
  php85-sqlite3 \
  php85-tokenizer \
  php85-xml \
  php85-xmlreader \
  php85-xmlwriter \
  php85-zip \
  redis \
  sqlite \
  supercronic \
  supervisor

RUN addgroup -g 1000 --system runner
RUN adduser -G runner --system -D -s /bin/sh -u 1000 runner
RUN chown runner:runner ./

COPY --chown=runner src ./
COPY --from=build --chown=runner /build/vendor vendor/
COPY container/crontab /etc/crontabs/runner
COPY container/nginx.conf /etc/nginx/nginx.conf
COPY container/conf.d /etc/nginx/conf.d/
COPY container/fpm-pool.conf /etc/php85/php-fpm.d/www.conf
COPY container/php.ini /etc/php85/conf.d/custom.ini
COPY container/redis.conf /etc/redis/redis.conf
COPY container/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY container/init /init

RUN chmod +x /init
RUN mkdir /redis
RUN chown -R runner:runner /run /redis /var/lib/nginx /var/log/nginx /etc/crontabs/runner

USER runner
EXPOSE 8080
ENTRYPOINT [ "/init" ]
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/up || exit 1

LABEL org.opencontainers.image.source=https://github.com/CabotScouts/forms-app
