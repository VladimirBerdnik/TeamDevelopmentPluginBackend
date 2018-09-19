#!/usr/bin/env bash
rootCaKey="../docker/local/etc/nginx/ssl/rootCA.key"
rootCaPem="../docker/local/etc/nginx/ssl/rootCA.pem"
serverKey="../docker/local/etc/nginx/ssl/server.key"
serverCrt="../docker/local/etc/nginx/ssl/server.crt"

openssl req -new -sha256 -nodes -out server.csr -newkey rsa:2048 -keyout ${serverKey} -config <( cat server.csr.cnf )

openssl x509 -req -in server.csr -CA ${rootCaPem} -CAkey ${rootCaKey} -CAcreateserial -out ${serverCrt} -days 1825 -sha256 -extfile v3.ext

rm -f ./.srl
rm -f ./server.csr

# Bundle server and CA certificates together
cat ${rootCaPem} >> ${serverCrt}