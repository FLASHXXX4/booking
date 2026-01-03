# Server Configuration Files

This directory contains server configuration templates for deploying the Laravel application.

## Files

- **nginx-booking.conf** - Nginx server block configuration
- **apache-booking.conf** - Apache virtual host configuration
- **backup-script.sh** - Automated backup script

## Usage

### Nginx Setup

1. Copy the configuration file:
   ```bash
   sudo cp server-configs/nginx-booking.conf /etc/nginx/sites-available/booking
   ```

2. Edit the file and replace:
   - `yourdomain.com` with your actual domain
   - `/var/www/booking` with your project path (if different)

3. Enable the site:
   ```bash
   sudo ln -s /etc/nginx/sites-available/booking /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl restart nginx
   ```

### Apache Setup

1. Copy the configuration file:
   ```bash
   sudo cp server-configs/apache-booking.conf /etc/apache2/sites-available/booking.conf
   ```

2. Edit the file and replace:
   - `yourdomain.com` with your actual domain
   - `/var/www/booking` with your project path (if different)

3. Enable the site:
   ```bash
   sudo a2ensite booking.conf
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

### Backup Script Setup

1. Copy the backup script:
   ```bash
   sudo cp server-configs/backup-script.sh /usr/local/bin/backup-booking.sh
   ```

2. Edit the script and update:
   - Database credentials
   - Project directory path
   - Backup directory path

3. Make it executable:
   ```bash
   sudo chmod +x /usr/local/bin/backup-booking.sh
   ```

4. Add to crontab:
   ```bash
   sudo crontab -e
   # Add: 0 2 * * * /usr/local/bin/backup-booking.sh
   ```

## Important Notes

- Always test configurations before applying: `nginx -t` or `apache2ctl configtest`
- Replace all placeholder values with your actual values
- After SSL setup, uncomment and configure HTTPS sections
- Regularly test your backup restoration process

