FROM lightcode/nginx-php:php7.0

ARG VERSION

RUN curl -Lso /tmp/piwik.tar.gz https://builds.piwik.org/piwik-${VERSION}.tar.gz \
    && tar xf /tmp/piwik.tar.gz -C /tmp \
    && mv /tmp/piwik/* /var/www \
    && chown -R www-data:www-data /var/www \
    && curl -Lso /tmp/GeoIPCity.dat.gz http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz \
    && gunzip /tmp/GeoIPCity.dat.gz \
    && rm -rf /tmp/*

VOLUME /var/www/config
