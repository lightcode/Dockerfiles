FROM lightcode/nginx-php:php5.6

MAINTAINER lightcode@gmx.com

ARG WALLABAG_VERSION=1.9.1-b

RUN mkdir /app \
    && curl -s https://codeload.github.com/wallabag/wallabag/tar.gz/${WALLABAG_VERSION} | tar xz -C /tmp \
    && mv /tmp/wallabag-${WALLABAG_VERSION}/* /app

RUN chown -R www-data:www-data /app

WORKDIR /app

RUN curl -s http://getcomposer.org/installer | php \
    && php composer.phar install

COPY 50-setup-database.php /etc/boot-scripts.d/50-setup-database.php

RUN chmod +x /etc/boot-scripts.d/50-setup-database.php

RUN sed -i "/require 'check_setup.php';/ d" index.php
