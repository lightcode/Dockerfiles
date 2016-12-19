FROM lightcode/nginx-php:php7.0

ARG TTRSS_COMMIT=73c4e7ddf2118d6cbb76491fc52dded208175894
ARG THEME_FEEDLY_COMMIT=07f2973b82e47ea8ee4771e089a608495c89b5c9

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
    && find /etc/boot-scripts.d -name "*.sh" -type f -exec chmod +x {} + \
    && chmod u+x /etc/service/ttrss/run \
    && chmod u+x /scripts/initialize-database.php

VOLUME "/app/feed-icons"
VOLUME "/app/cache"
