#!/bin/bash
# iris-emr startup script for American Caregivers Incorporated

echo "Starting iris EMR for American Caregivers Incorporated..."

# Apply any necessary file system changes
echo "Applying file system customizations..."

# Ensure symlink exists from openemr to iris
if [ ! -L /var/www/localhost/htdocs/iris ]; then
    echo "Creating symlink from openemr to iris..."
    ln -sf /var/www/localhost/htdocs/openemr /var/www/localhost/htdocs/iris
fi

# Run the database customization script in the background
# This will wait for MySQL to be ready before applying changes
echo "Scheduling database customization in background..."
/usr/local/bin/run-database-customization.sh &

# Allow Apache to start
echo "Starting Apache web server..."
exec /usr/sbin/httpd -D FOREGROUND 