#!/bin/bash

# Laravel Backup Script
# Run this daily via cron: 0 2 * * * /usr/local/bin/backup-booking.sh

# Configuration
BACKUP_DIR="/var/backups/booking"
PROJECT_DIR="/var/www/booking"
DB_NAME="booking_db"
DB_USER="booking_user"
DB_PASS="your_database_password_here"
RETENTION_DAYS=7

# Create backup directory if it doesn't exist
mkdir -p $BACKUP_DIR

# Get current date
DATE=$(date +%Y%m%d_%H%M%S)

# Backup database
echo "Backing up database..."
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Backup files (excluding unnecessary directories)
echo "Backing up files..."
tar -czf $BACKUP_DIR/files_$DATE.tar.gz \
    --exclude='node_modules' \
    --exclude='vendor' \
    --exclude='.git' \
    --exclude='storage/logs/*' \
    --exclude='storage/framework/cache/*' \
    --exclude='storage/framework/sessions/*' \
    --exclude='storage/framework/views/*' \
    -C /var/www booking

# Backup .env file separately (important!)
cp $PROJECT_DIR/.env $BACKUP_DIR/.env_$DATE

# Clean up old backups (keep last 7 days)
echo "Cleaning up old backups..."
find $BACKUP_DIR -name "db_*.sql.gz" -mtime +$RETENTION_DAYS -delete
find $BACKUP_DIR -name "files_*.tar.gz" -mtime +$RETENTION_DAYS -delete
find $BACKUP_DIR -name ".env_*" -mtime +$RETENTION_DAYS -delete

echo "Backup completed: $DATE"
echo "Backup location: $BACKUP_DIR"

# Optional: Send backup to remote storage (S3, FTP, etc.)
# aws s3 cp $BACKUP_DIR/db_$DATE.sql.gz s3://your-bucket/backups/
# aws s3 cp $BACKUP_DIR/files_$DATE.tar.gz s3://your-bucket/backups/

