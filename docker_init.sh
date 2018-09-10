#!/bin/bash

service nginx start

cd /core
npm install
cd /core/src/admin-api
composer install
cd /core/src/admin-vue
npm install
npm install -g quasar-cli@0.6.5
cd /core/src/admin-api
php artisan migrate:refresh --seed
tail -f /dev/null
