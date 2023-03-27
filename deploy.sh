#!/bin/bash

[ -x "$(command -v docker)" ] && echo "Docker is installed" || ( echo "Docker is not installed"; err=1 )

[ $err -eq 1 ] && exit

cp .env.example .env

read -p "GUACAMOLE_DATABASE_PASSWORD> " GUACAMOLE_DATABASE_PASSWORD
read -p "GUACAMOLE_DATABASE_USER> " GUACAMOLE_DATABASE_USER
read -p "GUACAMOLE_ADMIN> " GUACAMOLE_ADMIN
read -p "GUACAMOLE_ADMIN_PASSWORD> " GUACAMOLE_ADMIN_PASSWORD
read -p "DB_PASSWORD> " DB_PASSWORD
read -p "Server hostname (eg. IP ADDRESS)> " APP_URL
read -p "App name> " APP_NAME
read -p "App port> " APP_PORT
read -p "Guacamole port> " GUACAMOLE_PORT

GUACAMOLE_DATABASE_PASSWORD=${GUACAMOLE_DATABASE_PASSWORD:-fsewfdsqedsae}
GUACAMOLE_DATABASE_USER=${GUACAMOLE_DATABASE_USER:-guac_db_user}
GUACAMOLE_ADMIN=${GUACAMOLE_ADMIN:-guacadmin}
GUACAMOLE_ADMIN_PASSWORD=${GUACAMOLE_ADMIN_PASSWORD:-fsewfdsqedsae}
DB_PASSWORD=${DB_PASSWORD:-fsewfdsqedsae}
APP_URL=${APP_URL:-localhost}
APP_NAME=${APP_NAME:-Guacamole}
APP_PORT=${APP_PORT:-8888}
GUACAMOLE_PORT=${GUACAMOLE_PORT:-8080}



sed -i "s/^GUACAMOLE_DATABASE_PASSWORD.*$/GUACAMOLE_DATABASE_PASSWORD=$GUACAMOLE_DATABASE_PASSWORD/" .env
sed -i "s/^GUACAMOLE_DATABASE_USER.*$/GUACAMOLE_DATABASE_USER=$GUACAMOLE_DATABASE_USER/" .env
sed -i "s/^GUACAMOLE_ADMIN.*$/GUACAMOLE_ADMIN=$GUACAMOLE_ADMIN/" .env
sed -i "s/^GUACAMOLE_ADMIN_PASSWORD.*$/GUACAMOLE_ADMIN_PASSWORD=$GUACAMOLE_ADMIN_PASSWORD/" .env
sed -i "s/^APP_PORT.*$/APP_PORT=$APP_PORT/" .env
sed -i "s/^APP_URL.*$/APP_URL=http://$APP_URL/" .env
sed -i "s!^GUACAMOLE_APP_URL.*$!GUACAMOLE_APP_URL=http://$APP_URL:$GUACAMOLE_PORT/guacamole!" .env
sed -i "s/^APP_NAME.*$/APP_NAME=$APP_NAME/" .env
sed -i "s/^GUACAMOLE_PORT.*$/GUACAMOLE_PORT=$GUACAMOLE_PORT/" .env

[ -z $UID ] && (echo "Cannot read UID variable, please set it with export UID=<UID OF YOUR USER> and rerun script"; err=1)

[ $err -eq 1 ] && exit

docker build -t php --build-arg WWWGROUP=$(id -g) --build-arg WWWUSER=$UID docker-php/

docker run --rm -v $PWD:/var/www/html -ti php

./vendor/bin/sail up -d

./vendor/bin/sail npm install

./vendor/bin/sail npm run prod

./vendor/bin/sail artisan migrate

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan make:test:admin