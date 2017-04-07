#!/bin/bash

set -euf -o pipefail
set -x

declare -r SCRIPT_DIR="/etc/boot-scripts.d"


if [ -d "$SCRIPT_DIR" ]; then
  for script in $(find "$SCRIPT_DIR" -executable -type f -print); do
    $script
  done
fi


exec /usr/local/bin/dumb-init runsvdir -P /etc/service
