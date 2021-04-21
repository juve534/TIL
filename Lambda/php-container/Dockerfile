# Uses PHP 80-fpm.0, as the base image
FROM bref/php-80-fpm

# download composer for dependency management
RUN  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
     php composer-setup.php && \
     php -r "unlink('composer-setup.php');" && \
     mv composer.phar /usr/local/bin/composer

# install bref using composer
RUN composer require bref/bref

# copy the project files into a Location that the Lambda service can read from
COPY index.php /var/task

#set the function handler entry point
CMD _HANDLER=index.php /opt/bootstrap