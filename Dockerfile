FROM alpine:3.13

LABEL maintainer="Jan Dankert"

# Install packages
RUN apk --update --no-cache add \
    apache2 apache2-http2 curl \
    php7 php7-apache2 php7-session php7-pdo php7-pdo_mysql php7-pdo_pgsql php7-json php7-ftp php7-iconv php7-openssl php7-mbstring php7-dom php7-xml

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
    DOCROOT="/var/www/localhost/cms"

# Configuring apache webserver
# - disable access log
# - enable HTTP/2
RUN sed -i '/CustomLog/s/^/#/g'                     /etc/apache2/httpd.conf && \
    # Enable apache modules
    sed -i '/LoadModule http2_module/s/^#//g'       /etc/apache2/httpd.conf && \
    sed -i '/LoadModule vhost_alias_module/s/^#//g' /etc/apache2/httpd.conf && \
    # Listening on ports
    sed -i 's/^Listen 80/Listen 8080\nListen 8081\nListen 8082/g'       /etc/apache2/httpd.conf && \
    chown apache /var/log/apache2 && \
    chown apache /run/apache2     && \
    mkdir $DOCROOT                && \
    mkdir -p /var/www/localhost/public     && \
    chown apache /var/www/localhost/public && \
    # Virtual host for CMS
    echo "<VirtualHost *:8080>"         >> /etc/apache2/httpd.conf && \
    echo "  DocumentRoot $DOCROOT"      >> /etc/apache2/httpd.conf && \
    echo "</VirtualHost>"               >> /etc/apache2/httpd.conf && \
    # Virtual host for generated pages
    echo "<VirtualHost *:8081>"         >> /etc/apache2/httpd.conf && \
    echo "  DocumentRoot /var/www/localhost/public"   >> /etc/apache2/httpd.conf && \
    echo "  ServerSignature Off"        >> /etc/apache2/httpd.conf && \
    echo "  php_value engine off"       >> /etc/apache2/httpd.conf && \
    echo "</VirtualHost>"               >> /etc/apache2/httpd.conf && \
    # Virtual host for multiple domains
    echo "<VirtualHost *:8082>"         >> /etc/apache2/httpd.conf && \
    echo "  UseCanonicalName    Off"    >> /etc/apache2/httpd.conf && \
    echo "  VirtualDocumentRoot /var/www/localhost/public/%0"  >> /etc/apache2/httpd.conf && \
    echo "  ServerSignature Off"        >> /etc/apache2/httpd.conf && \
    echo "  php_value engine off"       >> /etc/apache2/httpd.conf && \
    echo "</VirtualHost>"               >> /etc/apache2/httpd.conf && \
    # Directory configuration
    echo "<Directory \"/var/www/localhost/cms\"> " >> /etc/apache2/httpd.conf && \
    echo "  AllowOverride None"         >> /etc/apache2/httpd.conf && \
    echo "  Options None"               >> /etc/apache2/httpd.conf && \
    echo "  Require all granted"        >> /etc/apache2/httpd.conf && \
    echo "</Directory>"                 >> /etc/apache2/httpd.conf && \
    echo "<Directory \"/var/www/localhost/public\"> " >> /etc/apache2/httpd.conf && \
    echo "  Options Indexes"            >> /etc/apache2/httpd.conf && \
    echo "  AllowOverride None"         >> /etc/apache2/httpd.conf && \
    echo "  Require all granted"        >> /etc/apache2/httpd.conf && \
    echo "</Directory>"                 >> /etc/apache2/httpd.conf && \
    # Enable HTTP/2
    echo "Protocols h2 h2c http/1.1"    >> /etc/apache2/httpd.conf && \
    echo "H2ModernTLSOnly off"          >> /etc/apache2/httpd.conf

# Copy the application to document root
COPY . $DOCROOT

# Place configuration in /etc, outside the docroot.
RUN echo "include: /etc/openrat.yml" >  $DOCROOT/config/config.yml

# Create configuration
RUN echo -e '\
# OpenRat CMS configuration for Docker\n\
login:\n\
  motd: "${env:CMS_MOTD}"\n\
\n\
database-default:\n\
  default-id:  db\n\
\n\
\n\
database:\n\
  db:\n\
    enabled    :  true\n\
    dsn        :  "${env:DB_TYPE}:host=${env:DB_HOST}; dbname=${env:DB_NAME}"\n\
    description:  "PDO"\n\
    name       :  "PRO"\n\
    user       :  ${env:DB_USER}\n\
    password   :  ${env:DB_PASS}\n\
    base64     :  true                 #  store binary as BASE64 (should be true for postgresql)\n\
    prefix     :  cms_\n\
    suffix     :  _or\n\
\n\
log:\n\
  file :  ""\n\
  level:  "${env:CMS_LOG_LEVEL}"\n\
  stdout: true\n\
\n\
production: ${env:CMS_PRODUCTION}\n\
\n\
publish:\n\
  filesystem:\n\
    directory: /var/www/localhost/public\n\
\n\
application:\n\
	name: "${env:CMS_NAME}"\n\
	operator: "${env:CMS_OPERATOR}"\n\
\n\
' >> /etc/openrat.yml

# Logfiles are redirected to standard out
RUN ln -sf /dev/stdout $DOCROOT/log/cms.log       && \
    ln -sf /dev/stderr /var/log/apache2/error.log

EXPOSE 8080
EXPOSE 8081
EXPOSE 8082

WORKDIR $DOCROOT

USER apache

HEALTHCHECK --interval=10s --timeout=5m --retries=1 CMD curl -f http://localhost:8080/status/?health || exit 1
CMD /usr/sbin/httpd -D FOREGROUND
