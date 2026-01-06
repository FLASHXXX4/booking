# Laravel Hosting - Quick Reference (AWS EC2)

## AWS EC2 Setup

### 1. Create EC2 Instance
- Go to AWS Console → EC2 → Launch Instance
- **AMI**: Ubuntu Server 24.04 LTS
- **Instance Type**: t2.micro (free tier) or t3.small
- **Key Pair**: Create/download .pem file
- **Network Settings**: 
  - Allow SSH (port 22) from your IP
  - Allow HTTP (port 80) from anywhere (0.0.0.0/0)
  - Allow HTTPS (port 443) from anywhere (0.0.0.0/0)
- **Storage**: 20GB minimum
- Launch instance

### 2. Configure Security Group
- EC2 → Security Groups → Your group
- **Inbound Rules:**
  - SSH (22) - Your IP
  - HTTP (80) - 0.0.0.0/0
  - HTTPS (443) - 0.0.0.0/0
- **Outbound Rules:** All traffic (default)

### 3. Allocate Elastic IP (Optional but Recommended)
- EC2 → Elastic IPs → Allocate
- Associate with your instance
- **Note the IP** - this is your server's permanent IP

### 4. Connect via SSH
```bash
# Windows (PowerShell/CMD)
ssh -i "your-key.pem" ubuntu@your-ec2-ip

# Linux/Mac
chmod 400 your-key.pem
ssh -i your-key.pem ubuntu@your-ec2-ip
```

### 5. Update System
```bash
sudo apt update && sudo apt upgrade -y
```

### 6. Install Required Software
```bash
# Install Nginx, PHP, Composer, Node.js
sudo apt install -y nginx
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.4-fpm php8.4-cli php8.4-mysql php8.4-zip php8.4-gd php8.4-mbstring php8.4-curl php8.4-xml php8.4-bcmath php8.4-sqlite3

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

### 7. Upload Project Files
**Option A: Using SCP (from your local PC)**
```bash
# Windows (PowerShell)
scp -i "your-key.pem" -r C:\Users\Administrator\Desktop\BOOKING ubuntu@your-ec2-ip:/home/ubuntu/

# Linux/Mac
scp -i your-key.pem -r /path/to/BOOKING ubuntu@your-ec2-ip:/home/ubuntu/
```

**Option B: Using Git (if project is in repository)**
```bash
cd /var/www
sudo git clone your-repo-url booking
```

**Option C: Using SFTP Client (FileZilla, WinSCP)**
- Connect via SFTP with your .pem key
- Upload project folder to `/home/ubuntu/`

### 8. Move Project to Web Directory
```bash
sudo mv /home/ubuntu/BOOKING /var/www/booking
# Or if using different folder name:
sudo mv /home/ubuntu/your-folder-name /var/www/booking
```

---

## Server Setup Steps

**1. Find project:**
```bash
sudo find /var/www -name "artisan" -type f
```

**2. Install PHP-FPM:**
```bash
sudo apt update && sudo apt install php8.4-fpm -y
sudo ls -la /var/run/php/ | grep fpm.sock
```

**3. Disable default site:**
```bash
sudo rm -f /etc/nginx/sites-enabled/default
```

**4. Create Nginx config:**
```bash
sudo nano /etc/nginx/sites-available/booking
```
Paste config (see below), save (Ctrl+X, Y, Enter)

**5. Enable site & test:**
```bash
sudo ln -s /etc/nginx/sites-available/booking /etc/nginx/sites-enabled/booking
sudo nginx -t
sudo systemctl restart php8.4-fpm && sudo systemctl restart nginx
```

**6. Configure database (.env):**
```bash
cd /var/www/booking
sudo nano .env
```
Add: `DB_CONNECTION=sqlite` and `DB_DATABASE=/var/www/booking/database/database.sqlite`

**7. Setup database:**
```bash
sudo touch database/database.sqlite
sudo chown www-data:www-data database/database.sqlite
sudo chmod 664 database/database.sqlite
```

**8. Set permissions:**
```bash
sudo chown -R www-data:www-data /var/www/booking
sudo chmod -R 755 /var/www/booking
sudo chmod -R 775 storage bootstrap/cache
sudo chmod 600 .env
```

**9. Install Faker & seed:**
```bash
sudo composer require --dev fakerphp/faker
sudo php artisan migrate:fresh --seed --force
sudo php artisan config:clear
```

**10. Enable auto-start:**
```bash
sudo systemctl enable nginx php8.4-fpm
```

---

## Nginx Config (`/etc/nginx/sites-available/booking`)

```nginx
server {
    listen 80;
    server_name _;
    root /var/www/booking/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

---

## Quick Commands

```bash
# Restart services
sudo systemctl restart nginx php8.4-fpm

# Check logs
sudo tail -f /var/log/nginx/booking_error.log
sudo tail -f /var/www/booking/storage/logs/laravel.log

# Clear cache
cd /var/www/booking && sudo php artisan config:clear
```

---

---

## AWS Additional Steps

### Configure Firewall (UFW)
```bash
sudo ufw allow 'Nginx Full'
sudo ufw allow ssh
sudo ufw enable
sudo ufw status
```

### Set Up Domain (Optional)
1. **Route 53 or your domain registrar:**
   - Create A record pointing to your Elastic IP
   - Example: `yourdomain.com` → `your-elastic-ip`

2. **Update Nginx config:**
   ```bash
   sudo nano /etc/nginx/sites-available/booking
   ```
   Change: `server_name _;` to `server_name yourdomain.com www.yourdomain.com;`

3. **Restart Nginx:**
   ```bash
   sudo systemctl restart nginx
   ```

### SSL Certificate (Let's Encrypt - Free)
```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
# Follow prompts, certbot auto-configures Nginx
```

### AWS Backup Strategy
- **EBS Snapshots**: EC2 → Snapshots → Create snapshot
- **Automated**: Use AWS Backup service or create scheduled snapshots
- **Database**: Regular exports: `php artisan backup:run` (if using backup package)

### Monitor Resources
```bash
# Check disk space
df -h

# Check memory
free -h

# Check CPU
top
```

### AWS Cost Optimization
- Use t2.micro/t3.micro for testing (free tier eligible)
- Stop instance when not in use (data persists on EBS)
- Use Elastic IP (free if attached to running instance)
- Enable CloudWatch alarms for billing

---

## Notes
- Services run automatically (no terminal needed)
- Remote server = no impact on local PC
- Site accessible 24/7 via server IP or domain
- AWS charges only when instance is running
- Elastic IP is free if attached to running instance

