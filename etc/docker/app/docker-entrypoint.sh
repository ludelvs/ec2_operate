#!/bin/bash

set -eu

PATH=/var/www/html/vendor/bin:$PATH

prehook /usr/local/bin/wait_db_connect.sh --

if [ "$APP_ENV" = 'local' ]; then
  cd /var/www/html
  composer install
  php artisan migrate
  if [ -d "storage/logs" ]; then rm -rf storage/logs/*; fi
fi

LOG_STREAM=/tmp/stdout

if ! [ -p $LOG_STREAM ]; then
  if [ -f $LOG_STREAM ]; then rm $LOG_STREAM; fi
  if [ -d "${LOG_STREAM}" ]; then rmdir ${LOG_STREAM}; fi
  mkfifo $LOG_STREAM
  chmod 666 $LOG_STREAM
fi

/bin/bash -o pipefail -c php-fpm -D | tail -f ${LOG_STREAM}

