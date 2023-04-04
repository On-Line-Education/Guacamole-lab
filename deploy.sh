#!/bin/bash

[ -x "$(command -v docker)" ] && echo "Docker is installed" || ( echo "Docker is not installed"; exit 1)
[ -x "$(command -v docker-compose)" ] && echo "Docker-compose is installed" || ( echo "Docker-compose is not installed"; exit 1)
groups | grep "docker" && echo "User is in docker group" || ( echo "User is not in docker group. Add user to docker group and relogin"; exit 1)
[[ $UID == 0 ]] && echo "Running this script as root is not supported. Please use a different user." && exit 1
#[[ $err == 1 ]] && exit

cp .env.example .env
echo "Reading application variables. Press ENTER for default"

read -p "GUACAMOLE_DATABASE_PASSWORD> " GUACAMOLE_DATABASE_PASSWORD
read -p "GUACAMOLE_DATABASE_USER (guac_db_user)> " GUACAMOLE_DATABASE_USER
read -p "GUACAMOLE_ADMIN (guacadmin)> " GUACAMOLE_ADMIN
read -p "GUACAMOLE_ADMIN_PASSWORD (guacadmin)> " GUACAMOLE_ADMIN_PASSWORD
read -p "DB_PASSWORD> " DB_PASSWORD
read -p "Server hostname (eg. IP ADDRESS) (localhost)> " APP_URL
read -p "App name (Guacamole)> " APP_NAME
echo "Now enter app port - web application will listen on that port ON THE SERVER, so redirect a port on your PUBLIC IP ADDRESS to THIS PORT ON THE SERVER"
read -p "App port (8888)> " APP_PORT
echo "Now enter external Guacamole (RDP Gateway) port - this port MUST be available on your PUBLIC IP address and redirected to 8080 port ON THE SERVER"
read -p "Guacamole external port (8080) > " GUACAMOLE_PORT

GUACAMOLE_DATABASE_PASSWORD=${GUACAMOLE_DATABASE_PASSWORD:-fsewfdsqedsae}
GUACAMOLE_DATABASE_USER=${GUACAMOLE_DATABASE_USER:-guac_db_user}
GUACAMOLE_ADMIN=${GUACAMOLE_ADMIN:-guacadmin}
GUACAMOLE_ADMIN_PASSWORD=${GUACAMOLE_ADMIN_PASSWORD:-guacadmin}
DB_PASSWORD=${DB_PASSWORD:-fsewfdsqedsae}
APP_URL=${APP_URL:-localhost}
APP_NAME=${APP_NAME:-Guacamole}
APP_PORT=${APP_PORT:-8888}
GUACAMOLE_PORT=${GUACAMOLE_PORT:-8080}



sed -i "s/^GUACAMOLE_DATABASE_PASSWORD=.*$/GUACAMOLE_DATABASE_PASSWORD=$GUACAMOLE_DATABASE_PASSWORD/" .env
sed -i "s/^GUACAMOLE_DATABASE_USER=.*$/GUACAMOLE_DATABASE_USER=$GUACAMOLE_DATABASE_USER/" .env
sed -i "s/^GUACAMOLE_ADMIN=.*$/GUACAMOLE_ADMIN=$GUACAMOLE_ADMIN/" .env
sed -i "s/^GUACAMOLE_ADMIN_PASSWORD=.*$/GUACAMOLE_ADMIN_PASSWORD=$GUACAMOLE_ADMIN_PASSWORD/" .env
sed -i "s/^APP_PORT=.*$/APP_PORT=$APP_PORT/" .env
sed -i "s|^APP_URL=.*$|APP_URL=http://$APP_URL|" .env
sed -i "s|^GUACAMOLE_APP_URL=.*$|GUACAMOLE_APP_URL=http://$APP_URL:$GUACAMOLE_PORT|" .env
sed -i "s/^APP_NAME=.*$/APP_NAME=$APP_NAME/" .env
#sed -i "s/^GUACAMOLE_PORT=.*$/GUACAMOLE_PORT=$GUACAMOLE_PORT/" .env
sed -i "s/^DB_PASSWORD=.*$/DB_PASSWORD=$DB_PASSWORD/" .env

[ -z $UID ] && (echo "Cannot read UID variable, please set it with export UID=<UID OF YOUR USER> and rerun script"; exit)

#[[ $err == 1 ]] && exit

docker build -t php --build-arg WWWGROUP=$(id -g) --build-arg WWWUSER=$UID docker-php/

docker run --rm -v $PWD:/var/www/html -ti php

sed -i 's/^.*platform:.*$//g' docker-compose.yml

./vendor/bin/sail up -d

./vendor/bin/sail npm install

echo "Changing ownership of log file - temporary fix. Please provide sudo password"
sudo chown $USER storage/logs/laravel.log

./vendor/bin/sail npm run prod

./vendor/bin/sail artisan migrate

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan make:test:admin
