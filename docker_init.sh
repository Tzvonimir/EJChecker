#!/bin/bash

service nginx start

cd /core/src/admin-api
composer install
php artisan migrate:refresh --seed
cd /core/src/admin-vue
npm install
npm install -g quasar-cli
tail -f /dev/null
