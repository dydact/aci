#!/bin/bash
set -e

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
until mysql -h "$MYSQL_HOST" -u "$MYSQL_USER" -p"$MYSQL_PASS" -e "SELECT 1"; do
  echo "MySQL is unavailable - waiting..."
  sleep 5
done

echo "MySQL is up and running!"

# Check if the database is already initialized
if mysql -h "$MYSQL_HOST" -u "$MYSQL_USER" -p"$MYSQL_PASS" -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'openemr';" | grep -q '0'; then
  echo "Database is empty. Running initialization..."
  # If the database is not yet initialized, run the standard initialization
  /var/www/localhost/htdocs/openemr/contrib/util/installScripts/InstallerAuto.php \
    -s 1 \
    -d 0 \
    --iuser="$MYSQL_USER" \
    --iuserpass="$MYSQL_PASS" \
    --server="$MYSQL_HOST" \
    --port="3306" \
    --root="$MYSQL_ROOT_USER" \
    --rootpass="$MYSQL_ROOT_PASS" \
    --login="$OE_USER" \
    --pass="$OE_PASS" \
    --site="default"
  
  echo "Standard installation completed."
fi

# Apply American Caregivers customizations
if [ -f "/docker-entrypoint-initdb.d/iris-database-customization.sql" ]; then
  echo "Applying American Caregivers customizations..."
  mysql -h "$MYSQL_HOST" -u "$MYSQL_USER" -p"$MYSQL_PASS" openemr < /docker-entrypoint-initdb.d/iris-database-customization.sql
  echo "Customizations applied successfully."
fi

# Start Apache
echo "Starting Apache..."
exec "$@" 