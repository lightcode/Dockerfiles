FROM lightcode/http-php5

MAINTAINER lightcode@gmx.com

ENV TTRSS_COMMIT 399678a14e98cefd61f228b11e20fa711ea6d55b

RUN export DEBIAN_FRONTEND=noninteractive; \
    apt-get update \
    && apt-get install -y -q --no-install-recommends \
        curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN mkdir -p /app \
    && curl -s https://tt-rss.org/gitlab/fox/tt-rss/repository/archive.tar.gz?ref=${TTRSS_COMMIT} | tar xz -C /tmp \
    && mv /tmp/tt-rss.git/* /app \
    && rm -rf /tmp/tt-rss.git /app/install /app/config.php-dist \
    && chown -R www-data:www-data /app

COPY boot-scripts.d /etc/boot-scripts.d

COPY service /etc/service

COPY initialize-database.php /tmp/initialize-database.php

RUN find /etc/boot-scripts.d -name "*.sh" -type f -exec chmod +x {} \; \
    && chmod u+x /etc/service/ttrss/run \
    && chmod u+x /tmp/initialize-database.php
