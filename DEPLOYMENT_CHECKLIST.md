# Deployment Checklist

Use this checklist to ensure a smooth deployment process.

## Pre-Deployment

- [ ] Code is tested and working locally
- [ ] All sensitive data removed from code
- [ ] `.env.example` is up to date
- [ ] Database migrations are ready
- [ ] Seeders are tested
- [ ] Assets are built (`npm run build`)
- [ ] Git repository is clean (if using Git)

## Server Preparation

- [ ] Server has required PHP version (8.2+)
- [ ] All PHP extensions installed
- [ ] MySQL/MariaDB installed and running
- [ ] Composer installed
- [ ] Node.js and NPM installed
- [ ] Web server (Apache/Nginx) installed
- [ ] Firewall configured
- [ ] SSH access configured

## Project Upload

- [ ] Project files uploaded to server
- [ ] Files in correct directory (`/var/www/booking`)
- [ ] Ownership set to `www-data:www-data`
- [ ] Permissions set correctly (755 for dirs, 644 for files)
- [ ] Storage and cache directories have 775 permissions

## Configuration

- [ ] `.env` file created from `.env.example`
- [ ] `APP_KEY` generated (`php artisan key:generate`)
- [ ] `APP_ENV=production` set
- [ ] `APP_DEBUG=false` set
- [ ] `APP_URL` set to your domain
- [ ] Database credentials configured
- [ ] Mail settings configured (if needed)
- [ ] `.env` file permissions set to 600

## Database

- [ ] Database created
- [ ] Database user created with proper permissions
- [ ] Migrations run successfully
- [ ] Seeders run (if needed)
- [ ] Database connection tested

## Dependencies

- [ ] Composer dependencies installed (`composer install --no-dev`)
- [ ] NPM dependencies installed
- [ ] Assets built (`npm run build`)
- [ ] Autoloader optimized

## Web Server

- [ ] Virtual host/server block configured
- [ ] Document root set to `public` directory
- [ ] URL rewriting enabled
- [ ] Site enabled and default site disabled
- [ ] Web server restarted
- [ ] Tested with IP address

## Domain & SSL

- [ ] Domain DNS configured (A records)
- [ ] DNS propagation verified
- [ ] Domain points to server
- [ ] SSL certificate obtained (Let's Encrypt)
- [ ] HTTPS redirect configured
- [ ] SSL auto-renewal configured

## Security

- [ ] Firewall rules configured
- [ ] `.env` file secured (600 permissions)
- [ ] Sensitive files protected
- [ ] Directory listing disabled
- [ ] Security headers configured
- [ ] Database user has minimal privileges
- [ ] SSH key authentication enabled (recommended)

## Optimization

- [ ] OPcache enabled
- [ ] Config cached (`php artisan config:cache`)
- [ ] Routes cached (`php artisan route:cache`)
- [ ] Views cached (`php artisan view:cache`)
- [ ] Autoloader optimized
- [ ] Gzip compression enabled

## Testing

- [ ] Home page loads
- [ ] Hotels listing works
- [ ] Hotel details page works
- [ ] User registration works
- [ ] User login works
- [ ] Reservation creation works
- [ ] Admin dashboard accessible (if admin user exists)
- [ ] All forms submit correctly
- [ ] Images load correctly
- [ ] No console errors
- [ ] Mobile responsive works

## Monitoring

- [ ] Error logging configured
- [ ] Log rotation set up
- [ ] Backup script created
- [ ] Backup automation configured (cron)
- [ ] Monitoring tools set up (optional)

## Post-Deployment

- [ ] All features tested
- [ ] Performance checked
- [ ] Error logs reviewed
- [ ] Backup tested
- [ ] Documentation updated
- [ ] Team notified of deployment

## Quick Commands Reference

```bash
# After deployment, run these:
cd /var/www/booking
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev

# Check logs
tail -f storage/logs/laravel.log

# Check permissions
ls -la storage/
ls -la bootstrap/cache/

# Restart services
sudo systemctl restart nginx  # or apache2
sudo systemctl restart php8.2-fpm
```

---

**Remember:** Always test in a staging environment first!

