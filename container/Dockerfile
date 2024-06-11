ARG ALPINE_VERSION="latest"
FROM alpine:${ALPINE_VERSION}

ARG UID
ARG GID

WORKDIR /data

RUN apk add --no-cache \
  curl \
  nginx \
  mysql-client \
  php83 \
  php83-bcmath \
  php83-cli \
  php83-ctype \
  php83-curl \
  php83-dom \
  php83-fileinfo \
  php83-fpm \
  php83-gd \
  php83-pecl-igbinary \
  php83-pecl-imagick \
  php83-intl \
  php83-imap \
  php83-ldap \
  php83-mbstring \
  php83-pecl-memcached \
  php83-pecl-msgpack \
  php83-opcache \
  php83-openssl \
  php83-pecl-pcov \
  php83-pdo_mysql \
  php83-pdo_sqlite \
  php83-phar \
  php83-redis \
  php83-session \
  php83-soap \
  php83-sqlite3 \
  php83-pecl-swoole \
  php83-tokenizer \
  php83-xml \
  php83-xmlreader \
  php83-xmlwriter \
  php83-zip \
  supervisor \
  sqlite

ENV UID=${UID}
ENV GID=${GID}
RUN addgroup -g ${GID} --system runner
RUN adduser -G runner --system -D -s /bin/sh -u ${UID} runner

COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d /etc/nginx/conf.d/
COPY fpm-pool.conf /etc/php83/php-fpm.d/www.conf
COPY php.ini /etc/php83/conf.d/custom.ini
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY init /init
RUN chmod +x /init

RUN mkdir /.composer
RUN chmod -R ugo+rw /.composer

RUN chown -R runner.runner /data /run /var/lib/nginx /var/log/nginx

USER runner
EXPOSE 80
ENTRYPOINT [ "/init" ]
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1/up || exit 1