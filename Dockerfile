FROM openemr/openemr:7.0.2

LABEL maintainer="dydact LLMs <support@dydact.ai>"
LABEL description="iris EMR customized for American Caregivers Incorporated"
LABEL version="1.0.0"

# Copy American Caregivers site files
COPY sites/americancaregivers /var/www/localhost/htdocs/openemr/sites/americancaregivers

# Make sure directories have proper permissions
RUN chmod -R 755 /var/www/localhost/htdocs/openemr/sites/americancaregivers && \
    chmod -R 777 /var/www/localhost/htdocs/openemr/sites/americancaregivers/documents && \
    chmod -R 777 /var/www/localhost/htdocs/openemr/sites/americancaregivers/images && \
    chown -R apache:apache /var/www/localhost/htdocs/openemr/sites/americancaregivers

# Copy SQL customization script
COPY sql/iris-database-customization.sql /docker-entrypoint-initdb.d/

# Add custom entrypoint script to apply customizations
COPY docker/entrypoint.sh /
RUN chmod +x /entrypoint.sh

# Override the original entrypoint
ENTRYPOINT ["/entrypoint.sh"]

# Default command
CMD ["apache2-foreground"] 