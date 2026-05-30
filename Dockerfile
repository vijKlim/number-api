FROM yiisoftware/yii2-php:8.3-apache

WORKDIR /app

COPY . /app

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN mkdir -p /app/runtime /app/web/assets \
    && chmod -R 777 /app/runtime /app/web/assets
