FROM openemr/openemr:7.0.2

LABEL maintainer="dydact LLMs <support@dydact.ai>"
LABEL description="iris EMR customized for American Caregivers Incorporated"
LABEL version="1.0.0"

# No modifications to the base image
# Using the default OpenEMR setup

# Copy American Caregivers site files
COPY sites/americancaregivers /var/www/localhost/htdocs/openemr/sites/americancaregivers

# Make sure directories have proper permissions and create required subdirectories
RUN chmod -R 755 /var/www/localhost/htdocs/openemr/sites/americancaregivers && \
    mkdir -p /var/www/localhost/htdocs/openemr/sites/americancaregivers/documents/smarty/gacl && \
    mkdir -p /var/www/localhost/htdocs/openemr/sites/americancaregivers/documents/smarty/main && \
    mkdir -p /var/www/localhost/htdocs/openemr/sites/americancaregivers/documents/mpdf/pdf_tmp && \
    chmod -R 777 /var/www/localhost/htdocs/openemr/sites/americancaregivers/documents && \
    chmod -R 777 /var/www/localhost/htdocs/openemr/sites/americancaregivers/images && \
    chown -R apache:apache /var/www/localhost/htdocs/openemr/sites/americancaregivers

# Enable multisite setup
RUN sed -i 's/\$allow_multisite_setup = false;/\$allow_multisite_setup = true;/' /var/www/localhost/htdocs/openemr/setup.php

# Copy SQL customization script
COPY sql/iris-database-customization.sql /docker-entrypoint-initdb.d/

# Generate self-signed SSL certificates for testing
RUN mkdir -p /etc/ssl/certs && \
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/private/webserver.key.pem \
    -out /etc/ssl/certs/webserver.cert.pem \
    -subj "/C=US/ST=MD/L=Silver Spring/O=American Caregivers/CN=localhost"

# Use the default OpenEMR entrypoint
# We'll use the default entrypoint of the openemr image

# Default command - use the Alpine Linux httpd command
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"] 