#!/bin/bash
# Script to run iris database customization

echo "Running iris database customization for American Caregivers Incorporated..."

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
until mysql -h mysql -u admin -piris -e "SELECT 1"; do
    echo "MySQL is not ready yet... waiting 5 seconds"
    sleep 5
done

echo "MySQL is ready! Running customization script..."

# Run the database customization script
mysql -h mysql -u admin -piris aci-EMR < /docker-entrypoint-initdb.d/iris-database-customization.sql

# Additional custom database changes for path and URL updates
mysql -h mysql -u admin -piris aci-EMR << EOF
-- Update any URLs or paths in the database to use /iris instead of /openemr
UPDATE globals SET gl_value = REPLACE(gl_value, '/openemr', '/iris') WHERE gl_value LIKE '%/openemr%';
UPDATE globals SET gl_value = REPLACE(gl_value, 'openemr/', 'iris/') WHERE gl_value LIKE '%openemr/%';

-- Update any other tables that might contain openemr references
UPDATE registry SET directory = REPLACE(directory, 'openemr', 'iris') WHERE directory LIKE '%openemr%';
UPDATE documents SET url = REPLACE(url, '/openemr', '/iris') WHERE url LIKE '%/openemr%';
EOF

echo "Database customization completed successfully!" 