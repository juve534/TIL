FROM hhvm/hhvm-proxygen:latest

RUN rm -rf /var/www \
 && cd '/' \
 && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/local/bin/composer
ADD . /var/www

EXPOSE 80
