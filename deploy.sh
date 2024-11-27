#!/bin/bash

cd /var/www/site2
git pull origin master

/usr/bin/php7.4 artisan migrate --force

/usr/bin/php7.4 artisan config:clear
/usr/bin/php7.4 artisan cache:clear
/usr/bin/php7.4 artisan route:clear
/usr/bin/php7.4 artisan view:clear

chown -R www-data:www-data /var/www/site2
chmod -R 775 storage
chmod -R 775 bootstrap/cache
