#!/bin/bash

# Laravel Deployment Quick Start Script
# Run this script on your server after uploading your project

echo "🚀 Laravel Deployment Quick Start"
echo "=================================="

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if running as root
if [ "$EUID" -eq 0 ]; then 
   echo -e "${RED}Please do not run as root. Use sudo when needed.${NC}"
   exit 1
fi

# Get project directory
read -p "Enter project directory [/var/www/booking]: " PROJECT_DIR
PROJECT_DIR=${PROJECT_DIR:-/var/www/booking}

if [ ! -d "$PROJECT_DIR" ]; then
    echo -e "${RED}Directory $PROJECT_DIR does not exist!${NC}"
    exit 1
fi

cd $PROJECT_DIR

echo -e "${GREEN}✓${NC} Project directory: $PROJECT_DIR"

# Check if .env exists
if [ ! -f ".env" ]; then
    echo -e "${YELLOW}Creating .env file...${NC}"
    cp .env.example .env
    php artisan key:generate
    echo -e "${GREEN}✓${NC} .env file created"
else
    echo -e "${GREEN}✓${NC} .env file exists"
fi

# Install dependencies
echo -e "${YELLOW}Installing Composer dependencies...${NC}"
composer install --optimize-autoloader --no-dev
echo -e "${GREEN}✓${NC} Composer dependencies installed"

echo -e "${YELLOW}Installing NPM dependencies...${NC}"
npm install
npm run build
echo -e "${GREEN}✓${NC} NPM dependencies installed and built"

# Set permissions
echo -e "${YELLOW}Setting file permissions...${NC}"
sudo chown -R www-data:www-data $PROJECT_DIR
sudo find $PROJECT_DIR -type d -exec chmod 755 {} \;
sudo find $PROJECT_DIR -type f -exec chmod 644 {} \;
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
echo -e "${GREEN}✓${NC} Permissions set"

# Run migrations
read -p "Run database migrations? (y/n) [y]: " RUN_MIGRATE
RUN_MIGRATE=${RUN_MIGRATE:-y}
if [ "$RUN_MIGRATE" = "y" ]; then
    echo -e "${YELLOW}Running migrations...${NC}"
    php artisan migrate --force
    echo -e "${GREEN}✓${NC} Migrations completed"
fi

# Run seeders
read -p "Run database seeders? (y/n) [y]: " RUN_SEED
RUN_SEED=${RUN_SEED:-y}
if [ "$RUN_SEED" = "y" ]; then
    echo -e "${YELLOW}Running seeders...${NC}"
    php artisan db:seed --force
    echo -e "${GREEN}✓${NC} Seeders completed"
fi

# Optimize Laravel
echo -e "${YELLOW}Optimizing Laravel...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo -e "${GREEN}✓${NC} Laravel optimized"

# Secure .env
echo -e "${YELLOW}Securing .env file...${NC}"
sudo chmod 600 .env
echo -e "${GREEN}✓${NC} .env file secured"

echo ""
echo -e "${GREEN}==================================${NC}"
echo -e "${GREEN}✅ Deployment setup complete!${NC}"
echo -e "${GREEN}==================================${NC}"
echo ""
echo "Next steps:"
echo "1. Configure your .env file with production settings"
echo "2. Set up your web server (Nginx/Apache)"
echo "3. Configure your domain DNS"
echo "4. Install SSL certificate (Let's Encrypt)"
echo ""
echo "See DEPLOYMENT_GUIDE.md for detailed instructions."

