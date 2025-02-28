# iris EMR - American Caregivers Incorporated

## Overview

This repository contains a customized version of the iris Electronic Medical Records (EMR) system for American Caregivers Incorporated. iris EMR is powered by dydact LLMs and built on the OpenEMR platform.

## Features

- Customized branding with the "iris," name and "Powered by dydact LLMs" tagline
- Pre-configured with American Caregivers Incorporated information:
  - Practice name: American Caregivers Incorporated
  - Address: 2301 Broadbirch Drive, Ste 135, Silver Spring, MD 20904
  - Custom facility setup

## Quick Start with Docker

1. Clone this repository:
   ```bash
   git clone https://github.com/dydact/aci.git
   cd aci
   ```

2. Start the containers:
   ```bash
   docker-compose up -d
   ```

3. Access the EMR system:
   - Open your web browser and go to `http://localhost`
   - Login with the default credentials:
     - Username: admin
     - Password: pass
   - You will be prompted to change the password on first login

## Directory Structure

- `sites/americancaregivers/` - Site-specific configuration files and customizations
- `sql/` - Database initialization and customization scripts
- `docker/` - Docker configuration files

## Customization

### Logos

Custom logo files for the "iris," brand are included in:
- `sites/americancaregivers/images/`

### Database

The system comes pre-configured with the American Caregivers facility and branding settings.

## Security Notice

This repository includes default credentials for demonstration purposes only. Before deploying in a production environment:

1. Change all default passwords
2. Follow OpenEMR's security recommendations
3. Consider implementing additional security measures appropriate for healthcare data

## License

This software is licensed under the dydact LLC Proprietary License and is only available as a Software-as-a-Service (SaaS) offering. Unauthorized use, reproduction, distribution, or modification is strictly prohibited.

The proprietary license restricts the use of this software exclusively to authorized users who have entered into a valid subscription agreement with dydact LLC. All rights to the software and its contents are reserved by dydact LLC.

See the LICENSE file for complete terms and conditions.

## Support

For support with this customized EMR system, please contact dydact LLMs support. 