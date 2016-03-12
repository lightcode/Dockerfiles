FROM lightcode/base

MAINTAINER lightcode@gmx.com

ENV NGINX_VERSION 1.9.12-1~jessie

RUN export DEBIAN_FRONTEND=nonintieractive; \
    apt-key adv --keyserver hkp://pgp.mit.edu:80 --recv-keys 573BFD6B3D8FBC641079A6ABABF5BD827BD9BF62 \
    && echo "deb http://nginx.org/packages/mainline/debian/ jessie nginx" >> /etc/apt/sources.list \
    && apt-get update \
    && apt-get install -y -q --no-install-recommends \
        ca-certificates \
        nginx=${NGINX_VERSION} \
        php5-cli \
        php5-curl \
        php5-fpm \
        php5-gd \
        php5-geoip \
        php5-mcrypt \
        php5-mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY service /etc/service

COPY boot-scripts.d /etc/boot-scripts.d

COPY nginx.conf /etc/nginx/nginx.conf

RUN chmod u+x /etc/service/nginx/run \
    && chmod u+x /etc/service/php5-fpm/run \
    && find /etc/boot-scripts.d -name "*.sh" -type f -exec chmod +x {} \;

COPY nginx-default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
