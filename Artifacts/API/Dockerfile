FROM docker.saritasa.com/alpine-mockserver:0.6

RUN apk add --update mc
RUN npm install --global swagger-cli yamljs

### Bundle Swagger file on container start
RUN echo -e "#!/usr/bin/with-contenv sh\n\ncd /home/www/app/data\nsh bundle.sh\nchown -R 1000:101 ." > \
    /etc/cont-init.d/02-build-swagger
