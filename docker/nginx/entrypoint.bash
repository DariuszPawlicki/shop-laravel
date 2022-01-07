#!/bin/sh
set -e

inject_environment_variables()
{
  envsubst $(printenv | cut -f1 -d'=' | sed 's/.*/\\\${&}/' | tr '\n' ',')
}

inject_environment_variables < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

exec "$@"
