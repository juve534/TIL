FROM php:8.0-fpm

WORKDIR /var/www/html

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install sockets && \
    apt-get update &&  \
    apt-get install -y zlib1g-dev git nodejs npm wget && \
    apt-get install -y libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils libgbm-dev && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    npm install npm@latest -g && \
    npm install @nesk/puphpeteer

# 日本語フォントのインストール(これ入れないと日本語のサイトで文字化けする)
RUN apt-get install fonts-ipafont-gothic fonts-ipafont-mincho