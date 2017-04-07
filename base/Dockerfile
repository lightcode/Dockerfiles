FROM debian:jessie

RUN export DEBIAN_FRONTEND=noninteractive; \
    apt-get update \
    && apt-get install -y -q --no-install-recommends \
        runit \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD https://github.com/Yelp/dumb-init/releases/download/v1.2.0/dumb-init_1.2.0_amd64 /usr/local/bin/dumb-init

RUN chmod +x /usr/local/bin/dumb-init

COPY boot.sh /boot.sh

CMD ["/boot.sh"]
