FROM lightcode/nginx-php:php7.0

MAINTAINER lightcode@gmx.com

ARG PIWIK_VERSION=2.16.2

RUN export DEBIAN_FRONTEND=nonintieractive; \
    apt-get update -q \
    && apt-get install -qy --no-install-recommends unzip \
    && curl -Lso /tmp/piwik.zip https://builds.piwik.org/piwik.zip \
    && unzip -qd /tmp /tmp/piwik.zip \
    && mv /tmp/piwik /app \
    && chown -R www-data:www-data /app \
    && curl -Lso /tmp/GeoIPCity.dat.gz http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz \
    && gunzip /tmp/GeoIPCity.dat.gz \
    && rm -rf /tmp/*
