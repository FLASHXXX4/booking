#!/bin/bash
# Upload Payment Files to Server
# Replace YOUR-SERVER-IP and YOUR-KEY.pem with your actual values

SERVER_IP="54.207.236.259"  # Change this to your server IP
KEY_FILE="your-key.pem"      # Change this to your key file path
SERVER_USER="ubuntu"
SERVER_PATH="/var/www/booking"

echo "Uploading files to server..."

# Upload routes
echo "Uploading routes/web.php..."
scp -i "$KEY_FILE" routes/web.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/routes/

# Upload controller
echo "Uploading ReservationController.php..."
scp -i "$KEY_FILE" app/Http/Controllers/ReservationController.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/app/Http/Controllers/

# Upload model
echo "Uploading Reservation.php model..."
scp -i "$KEY_FILE" app/Models/Reservation.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/app/Models/

# Upload migration
echo "Uploading migration..."
scp -i "$KEY_FILE" database/migrations/2026_01_05_000000_add_payment_fields_to_reservations_table.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/database/migrations/

# Create payment views directory if needed and upload view
echo "Uploading payment view..."
ssh -i "$KEY_FILE" ${SERVER_USER}@${SERVER_IP} "mkdir -p ${SERVER_PATH}/resources/views/payment"
scp -i "$KEY_FILE" resources/views/payment/show.blade.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/resources/views/payment/

# Upload reservations view
echo "Uploading reservations view..."
scp -i "$KEY_FILE" resources/views/reservations/index.blade.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/resources/views/reservations/

echo ""
echo "Files uploaded successfully!"
echo ""
echo "Now run these commands on your server:"
echo "cd /var/www/booking"
echo "sudo php artisan migrate"
echo "sudo php artisan route:clear"
echo "sudo php artisan config:clear"
echo "sudo php artisan view:clear"

