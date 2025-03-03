# American Caregivers Incorporated EMR

## Overview
This repository contains a customized Electronic Medical Records (EMR) system for American Caregivers Incorporated, powered by dydact LLC. The system is based on OpenEMR, rebranded as "iris" EMR, with specific configurations to meet the requirements of American Caregivers Incorporated.

## Features
- Fully customized branding as "iris" EMR
- Comprehensive patient management system
- Secure medical records storage
- Appointment scheduling
- Billing and claims management
- Clinical decision support
- Reporting and analytics
- Docker containerization for easy deployment

## Branding
The EMR system features custom branding:
- Clean, text-based "iris" branding
- Integration with dydact logos for professional appearance
- Custom color scheme and typography
- Responsive design for all devices
- Tagline: "Powered by dydact LLMs"

## Technical Details
- Containerized application using Docker
- Database customization for medical records
- Site theme and appearance customization
- Logo and branding customization
- Configuration files for site-specific settings
- URL paths use /iris instead of /openemr

## Key Changes from OpenEMR
- Complete rebranding from OpenEMR to iris
- URL paths changed from /openemr to /iris
- Custom logos for American Caregivers
- Database fields updated with American Caregivers information
- Customized docker configuration
- Apache configuration for proper URL routing

## Setup Instructions
1. Clone this repository:
   ```
   git clone https://github.com/dydact/aci.git
   cd aci
   ```

2. Start the Docker containers:
   ```
   docker-compose up -d
   ```

3. Access the application:
   - URL: http://localhost/iris
   - Default credentials:
     - Username: admin
     - Password: pass

4. Test the customizations:
   ```
   ./test-customization.sh
   ```

## Customization Details

### File Structure
- `/docker` - Contains startup and database initialization scripts
- `/apache` - Contains Apache configuration for URL routing
- `/sql` - Contains database customization scripts
- `/sites/americancaregivers` - Contains site-specific customizations

### Docker Components
- `mysql` - MariaDB database container
- `iris-emr` - Main application container with iris EMR

### Key Customization Files
- `Dockerfile` - Sets up the container with iris branding
- `docker-compose.yml` - Configures the services
- `iris-database-customization.sql` - Database changes for branding
- `apache/iris.conf` - Apache configuration for /iris URLs
- `docker/startup.sh` - Initialization script
- `docker/run-database-customization.sh` - Database setup script

## Maintenance and Updates

### Updating the Application
When updating to a newer version of OpenEMR:

1. Update the base image version in the Dockerfile:
   ```
   FROM openemr/openemr:NEW_VERSION
   ```

2. Test the customizations to ensure they still work:
   ```
   docker-compose down
   docker-compose build --no-cache
   docker-compose up -d
   ./test-customization.sh
   ```

### Logo Customization
To replace the placeholder logos with custom "iris" logos:

1. Prepare logo files according to the specifications in `sites/americancaregivers/images/logos/LOGO_INSTRUCTIONS.md`
2. Replace the files:
   - `sites/americancaregivers/images/login_logo.gif`
   - `sites/americancaregivers/images/logo_1.png`
   - `sites/americancaregivers/images/logo_2.png`

## Troubleshooting

### Common Issues

1. **Database connection errors**:
   - Check the database credentials in `docker-compose.yml`
   - Ensure the MySQL container is running

2. **Branding not updated**:
   - Verify that database customization script ran successfully
   - Check Apache configuration for proper URL routing

3. **File permission issues**:
   - Ensure the proper permissions are set in the Dockerfile

## License
This software is the proprietary property of dydact LLC, licensed exclusively to American Caregivers Incorporated.

This product is distributed as SaaS (Software as a Service) only. No redistribution, modification, or deployment outside the scope of this agreement is permitted.

All rights reserved. Copyright © 2023 dydact LLC.

## Support
For technical support, please contact:
- Email: support@dydact.com