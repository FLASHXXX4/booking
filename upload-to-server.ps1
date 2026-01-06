# Upload Payment Files to Server
# Replace YOUR-SERVER-IP and YOUR-KEY.pem with your actual values

$SERVER_IP = "54.207.236.259"  # Change this to your server IP
$KEY_FILE = "your-key.pem"      # Change this to your key file path
$SERVER_USER = "ubuntu"
$SERVER_PATH = "/var/www/booking"

Write-Host "Uploading files to server..." -ForegroundColor Green

# Upload routes
Write-Host "Uploading routes/web.php..." -ForegroundColor Yellow
scp -i $KEY_FILE routes/web.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/routes/

# Upload controller
Write-Host "Uploading ReservationController.php..." -ForegroundColor Yellow
scp -i $KEY_FILE app/Http/Controllers/ReservationController.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/app/Http/Controllers/

# Upload model
Write-Host "Uploading Reservation.php model..." -ForegroundColor Yellow
scp -i $KEY_FILE app/Models/Reservation.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/app/Models/

# Upload migration
Write-Host "Uploading migration..." -ForegroundColor Yellow
scp -i $KEY_FILE database/migrations/2026_01_05_000000_add_payment_fields_to_reservations_table.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/database/migrations/

# Create payment views directory if needed and upload view
Write-Host "Uploading payment view..." -ForegroundColor Yellow
ssh -i $KEY_FILE ${SERVER_USER}@${SERVER_IP} "mkdir -p ${SERVER_PATH}/resources/views/payment"
scp -i $KEY_FILE resources/views/payment/show.blade.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/resources/views/payment/

# Upload reservations view
Write-Host "Uploading reservations view..." -ForegroundColor Yellow
scp -i $KEY_FILE resources/views/reservations/index.blade.php ${SERVER_USER}@${SERVER_IP}:${SERVER_PATH}/resources/views/reservations/

Write-Host "`nFiles uploaded successfully!" -ForegroundColor Green
Write-Host "`nNow run these commands on your server:" -ForegroundColor Cyan
Write-Host "cd /var/www/booking" -ForegroundColor White
Write-Host "sudo php artisan migrate" -ForegroundColor White
Write-Host "sudo php artisan route:clear" -ForegroundColor White
Write-Host "sudo php artisan config:clear" -ForegroundColor White
Write-Host "sudo php artisan view:clear" -ForegroundColor White

