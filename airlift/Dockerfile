FROM debian:jessie

ARG VERSION

RUN export DEBIAN_FRONTEND=noninteractive; \
    apt-get update \
    && apt-get install -yq --no-install-recommends curl ca-certificates \
    && curl -sL https://github.com/moshee/airlift/releases/download/v${VERSION}/airliftd-v${VERSION}-linux_amd64.tar.gz | tar xfz - -C /usr/bin \
    && apt-get autoremove --purge -yq curl ca-certificates \
    && apt-get clean \
    && useradd -m -u 4000 -g nogroup airlift

USER airlift

EXPOSE 60606

CMD ["/usr/bin/airliftd"]
