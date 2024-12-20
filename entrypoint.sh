#!/bin/bash

set -e

# Ensure correct ownership of the /var/www/html directory
if [ -d /var/www/html ]; then
  chown -R www-data:www-data /var/www/html
fi

# Execute the container's main command
exec "$@"
