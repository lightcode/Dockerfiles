FROM lightcode/nginx-php:php7.0

MAINTAINER lightcode@gmx.com

ARG TTRSS_COMMIT=48007463861d8db8b2b79c2f4f54e0564edb0ec0
ARG THEME_FEEDLY_COMMIT=0fcd9a4edb0dcaa7da50c0fa9f0809bf2dbb5942

RUN mkdir -p /app \
    && curl -Lv "http://tt-rss.org/gitlab/fox/tt-rss/repository/archive.tar.gz?ref=${TTRSS_COMMIT}" | tar xz -C /tmp \
    && mv /tmp/tt-rss.git/* /app \
    && rm -rf /tmp/tt-rss.git /app/install /app/config.php-dist

RUN curl -Lv https://github.com/levito/tt-rss-feedly-theme/archive/${THEME_FEEDLY_COMMIT}.tar.gz | tar xz -C /tmp \
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
