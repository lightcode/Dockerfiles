FROM jwilder/nginx-proxy:alpine

RUN echo "client_max_body_size 1g;" > /etc/nginx/conf.d/custom_options.conf

COPY nginx.tmpl /app/nginx.tmpl
