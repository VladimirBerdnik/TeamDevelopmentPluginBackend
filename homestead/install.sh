#!/bin/bash

# This file is executed with elevated (root user) permissions

# Enable XDebug remote debugging
mv /tmp/20-xdebug.ini /etc/php/7.1/fpm/conf.d/20-xdebug.ini
service php7.1-fpm restart

. /tmp/functions_common.sh

header "Install additional packages"

# Install Grunt and dependencies, required to run Saritasa custom static files build
npm install -g grunt-cli
npm update -g npm
apt-get install -y cowsay
# gem install sass
