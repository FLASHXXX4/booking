# Git Commands

## Local
```bash
git add .
git commit -m "message"
git push origin master
```

## Server
```bash
cd /var/www/booking
sudo git pull origin master
sudo php artisan migrate
sudo php artisan route:clear
```

