# iris EMR Installation & Deployment Guide
# For American Caregivers Incorporated

This guide provides step-by-step instructions for installing and deploying the iris EMR system for American Caregivers Incorporated.

## System Requirements

- Docker Engine 20.10.x or higher
- Docker Compose 2.x or higher
- Minimum 4GB RAM
- 20GB free disk space
- Internet connection for downloading Docker images

## Local Development Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/dydact/aci.git
cd aci
```

### Step 2: Configure Environment (Optional)

If you need to modify any default settings:

1. Create a `.env` file from the template:
   ```bash
   cp .env.example .env
   ```

2. Edit the `.env` file to set custom values for:
   - Database credentials
   - Port mappings
   - Volume paths

### Step 3: Start the Application

```bash
docker-compose up -d
```

This will:
- Pull the necessary Docker images
- Build the custom iris EMR container
- Start the MySQL and iris EMR services
- Apply the database customizations

### Step 4: Verify Installation

1. Run the test script to verify that all customizations are properly applied:
   ```bash
   ./test-customization.sh
   ```

2. Access the application in your browser:
   - URL: http://localhost/iris
   - Default credentials:
     - Username: admin
     - Password: pass

## Production Deployment

### Step 1: Prepare the Production Server

1. Install Docker and Docker Compose on your production server
2. Configure firewall to allow access to ports 80 and 443
3. Set up a domain name with DNS records pointing to your server

### Step 2: Configure SSL for Production

1. Replace the self-signed certificates with production certificates:
   - Update the `Dockerfile` to copy your production certificates
   - Or set up Let's Encrypt with Certbot

2. Example Certbot configuration:
   ```bash
   certbot certonly --webroot -w /var/www/html -d yourdomain.com
   ```

3. Update Apache configuration to use the production certificates

### Step 3: Secure the Installation

1. Change default passwords:
   - Update `docker-compose.yml` with secure passwords
   - Change the admin password after first login

2. Configure database backups:
   - Set up a cron job to dump the database regularly
   - Example backup script:
     ```bash
     #!/bin/bash
     DATE=$(date +%Y-%m-%d)
     docker exec mysql mysqldump -u admin -piris aci-EMR > backup-$DATE.sql
     ```

### Step 4: Deploy to Production

1. Clone the repository on your production server:
   ```bash
   git clone https://github.com/dydact/aci.git
   cd aci
   ```

2. Start the application in production mode:
   ```bash
   docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
   ```

3. Configure a reverse proxy (optional):
   - Set up Nginx or Traefik as a reverse proxy
   - Configure SSL termination at the proxy level

## Maintenance Procedures

### Database Backups

1. Manual backup:
   ```bash
   docker exec mysql mysqldump -u admin -piris aci-EMR > backup.sql
   ```

2. Restore from backup:
   ```bash
   cat backup.sql | docker exec -i mysql mysql -u admin -piris aci-EMR
   ```

### Updating the Application

1. Pull the latest changes:
   ```bash
   git pull
   ```

2. Rebuild and restart the containers:
   ```bash
   docker-compose down
   docker-compose build --no-cache
   docker-compose up -d
   ```

3. Verify the update:
   ```bash
   ./test-customization.sh
   ```

### Monitoring

1. Check container status:
   ```bash
   docker-compose ps
   ```

2. View logs:
   ```bash
   docker-compose logs
   ```

3. Monitor container performance:
   ```bash
   docker stats
   ```

## Troubleshooting

### Common Issues

1. **Container fails to start**:
   - Check Docker logs: `docker-compose logs iris-emr`
   - Verify disk space: `df -h`
   - Check for port conflicts: `netstat -tuln`

2. **Database connection errors**:
   - Verify MySQL container is running: `docker-compose ps mysql`
   - Check database credentials in configuration
   - Try connecting manually: `docker exec -it mysql mysql -u admin -piris`

3. **Branding issues**:
   - Verify the database customization script was executed
   - Check Apache configuration for proper URL routing
   - Clear browser cache or try in incognito mode

### Getting Support

For technical assistance, contact:
- Email: support@dydact.com
- Include in your request:
  - Error messages from logs
  - Screenshots of any issues
  - Output of `docker-compose ps` and `docker-compose logs` 