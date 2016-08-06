#!/bin/bash

set -euf -o pipefail

sed -i 's/;*daemonize\s*=.*/daemonize = no/g' /etc/php/7.0/fpm/php-fpm.conf

sed -i -e 's/^pm.max_children\s*=.*$/pm.max_children = 10/' \
  -e 's/^pm.max_spare_servers\s*=.*$/pm.max_spare_servers = 6/' \
  /etc/php/7.0/fpm/pool.d/www.conf
