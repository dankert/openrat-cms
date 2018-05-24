#FROM php:7.0-apache
FROM debian:stretch-slim

# File Author / Maintainer
MAINTAINER dankert

RUN apt-get update \
  && apt-get install -y \
  apache2 \
  libapache2-mod-php7.0 \
  php-xml \
  php-mysql \
  && apt-get clean

# logs should go to stdout / stderr
RUN  \
	   ln -sfT /dev/stderr "/var/log/apache2/error.log"  \
	&& ln -sfT /dev/stdout "/var/log/apache2/access.log"

# Remove default index.html
RUN rm -r /var/www/html/*

COPY . /var/www/html/

EXPOSE 80

WORKDIR /var/www/html

CMD apachectl -D FOREGROUND
