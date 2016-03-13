FROM lightcode/http-php5

MAINTAINER lightcode@gmx.com

RUN export DEBIAN_FRONTEND=noninteractive; \
    apt-get update \
    && apt-get install -y -q --no-install-recommends \
        git \
    && git clone --depth=1 https://tt-rss.org/git/tt-rss.git /app \
    && rm -rf /app/.git \
    && apt-get autoremove -y -q --purge git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && chown -R www-data:www-data /app \
    && rm -rf /app/install /app/config.php-dist

COPY boot-scripts.d /etc/boot-scripts.d

COPY service /etc/service

COPY initialize-database.php /tmp/initialize-database.php

RUN find /etc/boot-scripts.d -name "*.sh" -type f -exec chmod +x {} \; \
    && chmod u+x /etc/service/ttrss/run \
    && chmod u+x /tmp/initialize-database.php
