#!/bin/bash

cat > /etc/davical/config.php <<EOF
<?php
\$c->admin_email  = '${DAVICAL_ADMIN_MAIL}';
\$c->pg_connect[] = 'host=${DAVICAL_POSTGRES_HOST:=postgres} dbname=${DAVICAL_DB_NAME:=davical} user=${DAVICAL_DB_USER:=davical_app} password=${DAVICAL_DB_PASSWORD}';
EOF
