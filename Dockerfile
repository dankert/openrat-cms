FROM alpine:3.10

LABEL maintainer="Jan Dankert"

ENV DOCROOT=/var/www/localhost/htdocs

RUN apk --update --no-cache add \
    apache2 apache2-http2 \
    php7 php7-apache2 php7-session php7-pdo php7-pdo_mysql php7-pdo_pgsql php7-json php7-ftp php7-iconv php7-openssl \
    git curl && \
    sed -i '/LoadModule log_module/s/^/#/g' /etc/apache2/httpd.conf && \
    sed -i 's/^Listen 80/Listen 8080/g' /etc/apache2/httpd.conf && \
    chown apache /var/log/apache2 && \
    chown apache /run/apache2 && \
    rm -r $DOCROOT/* && \
    mkdir -p /var/www/preview && chown apache /var/www/preview && \
    echo "Alias /preview /var/www/preview" >> /etc/apache2/httpd.conf && \
    echo "Protocols h2 h2c http/1.1" >> /etc/apache2/httpd.conf



# Copy the application to document root
COPY . $DOCROOT

# Place configuration in /etc, outside the docroot.
RUN echo "include: /etc/openrat.yml" >  $DOCROOT/config/config.yml
COPY doc/examples/config/docker.yml /etc/openrat.yml

# Cleanup
RUN rm -r $DOCROOT/doc/* && \
    find $DOCROOT/modules/cms-ui -type f -name "*.src.xml"|xargs rm

EXPOSE 8080


ENV DB_TYPE="mysql"
ENV DB_TYPE="mysql"
ENV DB_HOST="localhost"
ENV DB_NAME="cms"
ENV DB_USER=""
ENV DB_PASS=""

ENV CMS_MOTD="Welcome to dockerized CMS"
ENV CMS_NAME="OpenRat CMS (Docker)"
ENV CMS_OPERATOR="Docker-Host"

WORKDIR $DOCROOT

USER apache

CMD /usr/sbin/httpd -D FOREGROUND
