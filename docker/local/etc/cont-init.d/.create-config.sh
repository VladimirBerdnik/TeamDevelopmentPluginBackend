#!/usr/bin/env bash

source /root/.bashrc
## Generate laravel .env file and remove other .env configs
if [ ! -f .env ]; then
  echo -e "${BLUE}--- Crating Laravel config ---${NC}"
  cp .env.docker .env
fi

if [[ -n $(grep "APP_KEY=SomeRandomString" .env) ]]; then
  echo -e "${YELLOW}Application key was not set yet, generating new one${NC}"
  php artisan key:generate
  php artisan jwt:secret --force
  cp -f .env .env.docker
  php composer.phar self-update
fi
