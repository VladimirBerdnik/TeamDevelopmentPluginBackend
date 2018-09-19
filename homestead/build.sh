#!/bin/bash

# This script is executed with normal (vagrant user) permissions

cd /vagrant

# Create sample configuration
if [ ! -f .env ]; then
	cp .env.homestead .env
fi

. /tmp/functions_common.sh

header "Install Composer dependencies"
composer global require "hirak/prestissimo" # Speed up Composer install
composer install --prefer-source --no-interaction

header "Install NPM dependencies"
yarn install

header "Initialize application"
# Initialize application
php artisan config:cache
php artisan routes:cache
php artisan api:cache
php artisan migrate
php artisan db:seed

# Update static files
yarn run production
