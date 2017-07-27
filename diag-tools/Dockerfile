FROM alpine:3.5

ARG http_echo_url="https://github.com/hashicorp/http-echo/releases/download/v0.2.3/http-echo_0.2.3_linux_amd64.tar.gz"

COPY init.sh /usr/bin/start

RUN apk add --no-cache bind-tools curl mtr netcat-openbsd tcpdump && \
    curl -L "${http_echo_url}" -o /tmp/http-echo.tar.gz && \
    tar xf /tmp/http-echo.tar.gz -C /usr/bin && \
    rm /tmp/http-echo.tar.gz && \
    chmod +x /usr/bin/start

CMD ["/usr/bin/start"]
