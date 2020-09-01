FROM php:7.4-fpm

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apt-get update && apt-get install -y zlib1g-dev git nodejs npm && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    composer config -g repos.packagist composer https://packagist.jp && \
    composer global require hirak/prestissimo && \
    npm install npm@latest -g && \
    npm install -g serverless