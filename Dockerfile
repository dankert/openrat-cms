FROM alpine:3.24

LABEL org.opencontainers.image.title="OpenRat CMS"
LABEL org.opencontainers.image.description="OpenRat Content Management System"
LABEL org.opencontainers.image.url="http://www.openrat.de"
LABEL org.opencontainers.image.source="http://code.weiherhei.de/openrat-cms/"
LABEL org.opencontainers.image.licenses="GPL-3.0-or-later"
LABEL org.opencontainers.image.authors="Jan Dankert"

# Install packages
RUN apk --update --no-cache add \
    apache2 curl \
    php85 php85-apache2 php85-session php85-pdo php85-pdo_mysql php85-pdo_pgsql php85-json php85-ftp php85-iconv php85-openssl php85-mbstring php85-dom php85-xml

ENV DB_TYPE="mysql"     \
    DB_HOST="localhost" \
    DB_NAME="cms"       \
    DB_USER="cms"       \
    DB_PASS=""          \
    CMS_MOTD=""         \
    CMS_NAME="OpenRat CMS (Docker)"      \
    CMS_OPERATOR=""                      \
    CMS_LOG_LEVEL="info"                 \
    CMS_PRODUCTION="true"                \
    CMS_TIMEZONE=""                      \
    CMS_LANGUAGE=""                      \
    DOCROOT="/var/www/localhost/cms"

# Configuring apache webserver
# - disable access log
RUN sed -i '/CustomLog/s/^/#/g'                     /etc/apache2/httpd.conf && \
    sed -i '/LoadModule vhost_alias_module/s/^#//g' /etc/apache2/httpd.conf && \
    sed -i '/LoadModule rewrite_module/s/^#//g' /etc/apache2/httpd.conf && \
    sed -i 's/^Listen 80/Listen 8080\nListen 8090\nListen 8081\nListen 8082/g'       /etc/apache2/httpd.conf && \
    sed -i -e 's/ServerSignature On/ServerSignature Off/' /etc/apache2/httpd.conf && \
    sed -i -e 's/expose_php = On/expose_php = Off/' /etc/php85/php.ini && \
    echo "Header set Server \"OpenRat CMS\"" >> /etc/apache2/httpd.conf && \
    chown apache /var/log/apache2 && \
    chown apache /run/apache2     && \
    mkdir $DOCROOT                && \
    mkdir -p /var/www/localhost/public     && \
    chown apache /var/www/localhost/public

COPY docker/apache.conf /etc/apache2/conf.d/openrat.conf

# Copy the application to document root
COPY . $DOCROOT

# Place configuration in /etc, outside the docroot.
RUN echo "include: /etc/openrat.yml" >  $DOCROOT/config/config.yml

COPY docker/config.yml /etc/openrat.yml

RUN rm -rv $DOCROOT/docker

# Logfiles are redirected to standard out
RUN ln -sf /dev/stdout $DOCROOT/log/cms.log       && \
    ln -sf /dev/stderr /var/log/apache2/error.log

EXPOSE 8080
EXPOSE 8081
EXPOSE 8082
EXPOSE 8090

WORKDIR $DOCROOT

USER apache

HEALTHCHECK --interval=10s --timeout=5m --retries=1 CMD curl -f http://localhost:8080/status/?upgrade || exit 1
CMD /usr/sbin/httpd -D FOREGROUND
