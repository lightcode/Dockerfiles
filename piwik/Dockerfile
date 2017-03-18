FROM lightcode/nginx-php:php7.0

ARG PIWIK_VERSION=2.16.2

RUN curl -Lso /tmp/piwik.tar.gz https://builds.piwik.org/piwik-${PIWIK_VERSION}.tar.gz \
    && tar xf /tmp/piwik.tar.gz -C /tmp \
    && mv /tmp/piwik /app \
    && chown -R www-data:www-data /app \
    && curl -Lso /tmp/GeoIPCity.dat.gz http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz \
    && gunzip /tmp/GeoIPCity.dat.gz \
    && rm -rf /tmp/*

VOLUME /app/config
