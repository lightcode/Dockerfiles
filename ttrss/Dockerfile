FROM lightcode/nginx-php:php7.0

MAINTAINER lightcode@gmx.com

ARG TTRSS_COMMIT=399678a14e98cefd61f228b11e20fa711ea6d55b
ARG THEME_FEEDLY_COMMIT=3a9ed0d3dac0319680000f97c4ee4a78c36d7d49

RUN mkdir -p /app \
    && curl -s https://tt-rss.org/gitlab/fox/tt-rss/repository/archive.tar.gz?ref=${TTRSS_COMMIT} | tar xz -C /tmp \
    && mv /tmp/tt-rss.git/* /app \
    && rm -rf /tmp/tt-rss.git /app/install /app/config.php-dist

RUN curl -s https://codeload.github.com/levito/tt-rss-feedly-theme/tar.gz/${THEME_FEEDLY_COMMIT} | tar xz -C /tmp \
    && mv /tmp/tt-rss-feedly-theme-*/feedly.css /tmp/tt-rss-feedly-theme-*/feedly /app/themes \
    && rm -rf /tmp/tt-rss-feedly-theme-*

COPY boot-scripts.d /etc/boot-scripts.d
COPY service /etc/service
COPY initialize-database.php /scripts/initialize-database.php

RUN chown -R www-data:www-data /app \
    && find /etc/boot-scripts.d -name "*.sh" -type f -exec chmod +x {} \; \
    && chmod u+x /etc/service/ttrss/run \
    && chmod u+x /scripts/initialize-database.php

VOLUME "/app/feed-icons"
VOLUME "/app/cache"
