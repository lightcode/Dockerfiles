FROM lightcode/nginx-php:php7.0

ARG TTRSS_COMMIT
ARG THEME_FEEDLY_COMMIT

RUN curl -Lv "http://tt-rss.org/gitlab/fox/tt-rss/repository/archive.tar.gz?ref=${TTRSS_COMMIT}" | tar xz -C /tmp \
    && mv /tmp/tt-rss*/* /var/www \
    && rm -rf /tmp/tt-rss* /var/www/install /var/www/config.php-dist

RUN curl -Lv https://github.com/levito/tt-rss-feedly-theme/archive/${THEME_FEEDLY_COMMIT}.tar.gz | tar xz -C /tmp \
    && mv /tmp/tt-rss-feedly-theme-*/feedly*.css /tmp/tt-rss-feedly-theme-*/feedly /var/www/themes \
    && rm -rf /tmp/tt-rss-feedly-theme-*

COPY boot-scripts.d /etc/boot-scripts.d
COPY service /etc/service
COPY initialize-database.php /scripts/initialize-database.php

RUN chown -R www-data:www-data /var/www \
    && find /etc/boot-scripts.d -name "*.sh" -type f -exec chmod +x {} + \
    && chmod u+x /etc/service/ttrss/run \
    && chmod u+x /scripts/initialize-database.php

VOLUME "/var/www/feed-icons"
VOLUME "/var/www/cache"
