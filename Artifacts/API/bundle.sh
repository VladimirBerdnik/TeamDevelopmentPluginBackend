#!/usr/bin/env bash

# Prerequisites:
### npm install -g swagger-cli
### npm install -g yamljs

# Build mobile API
swagger-cli bundle -o swagger.json mobile.yaml
json2yaml -d 15 swagger.json > swagger.yaml
rm swagger.json
swagger-cli validate swagger.yaml

# Replace host with specified address
[[ ! -z $1 ]] && sed -i "s/^host:.*/host: ${1}/" swagger.yaml
