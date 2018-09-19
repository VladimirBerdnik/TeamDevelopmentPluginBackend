FROM node:8-alpine as static-builder

# Add static sources, JS packages & versions lock file
ADD package.json yarn.lock /build/
WORKDIR /build

# 1. Install native packages, required to build NPM packages
# 2. Install NPM packages
# 3. Remove unnecessary native packages
# 4. Caches clean up
RUN apk add --no-cache --virtual .build-deps \
    git python g++ make file nasm autoconf zlib-dev &&\
    yarn install --non-interactive &&\
    apk del .build-deps &&\
    rm -rf /var/cache/apk/* &&\
    rm -rf /tmp/* &&\
    rm -rf /usr/local/share/.cache/yarn

ADD webpack.mix.js artisan .eslintrc.js .*rc ./
ADD public public/
ADD resources/ resources/

RUN npm run production;


FROM docker.saritasa.com/alpine-php71-nginx-phpfpm-s6:1.0
LABEL Vendor="Saritasa" \
      Project="Team Development"

EXPOSE 80
ENTRYPOINT ["/init"]
WORKDIR /home/www/app
ARG PHP_ENV

### Default environment variables
ENV APP_ENV=${PHP_ENV:-development}
ENV COMPOSER_HOME=/home/www/.composer

### Install composer dependencies
COPY composer.* ./
RUN COMPOSER_ALLOW_SUPERUSER=1 \
    php composer.phar install --prefer-dist --no-interaction --no-scripts --no-autoloader --no-progress --no-suggest &&\
    rm -rf ${COMPOSER_HOME}/cache &&\
    chown -R nginx:nginx /home/www

### Copy configuration files
ADD docker/config /

### Copy application files
ADD --chown=nginx:nginx ./ ./
COPY --from=static-builder --chown=nginx:nginx /build/public public
