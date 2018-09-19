#!/usr/bin/env bash
rootCaKey="../docker/local/etc/nginx/ssl/rootCA.key"
rootCaPem="../docker/local/etc/nginx/ssl/rootCA.pem"

openssl genrsa -des3 -out ${rootCaKey} 2048
openssl req -x509 -new -nodes -key ${rootCaKey} -sha256 -days 3650 -out ${rootCaPem}