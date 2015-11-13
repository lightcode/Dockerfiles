FROM gliderlabs/alpine:3.2

MAINTAINER lightcode.fr

RUN apk add --update \
        ca-certificates \
        py-pip \
        python \
    && pip install youtube-dl

CMD ["youtube-dl"]

WORKDIR /tmp/videos

VOLUME /tmp/videos
