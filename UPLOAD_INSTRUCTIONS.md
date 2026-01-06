# Upload Payment Files to Server

## Quick Upload Instructions

### Step 1: Edit the Upload Script

Open `upload-to-server.ps1` (for Windows PowerShell) or `upload-to-server.sh` (for Linux/Mac) and update:

1. **SERVER_IP**: Change to your server IP (currently: 54.207.236.259)
2. **KEY_FILE**: Change to your .pem key file path

### Step 2: Run the Script

**Windows (PowerShell):**
```powershell
cd C:\Users\Administrator\Desktop\BOOKING
.\upload-to-server.ps1
```

**Linux/Mac:**
```bash
cd ~/Desktop/BOOKING
chmod +x upload-to-server.sh
./upload-to-server.sh
```

### Step 3: Run Commands on Server

After files are uploaded, SSH into your server and run:

```bash
cd /var/www/booking
sudo php artisan migrate
sudo php artisan route:clear
sudo php artisan config:clear
sudo php artisan view:clear
sudo php artisan route:list | grep payment
```

---

## Manual Upload (Alternative)

If the script doesn't work, use WinSCP or FileZilla:

1. Connect to server via SFTP
2. Navigate to `/var/www/booking`
3. Upload files to their respective folders:
   - `routes/web.php` → `/var/www/booking/routes/`
   - `app/Http/Controllers/ReservationController.php` → `/var/www/booking/app/Http/Controllers/`
   - `app/Models/Reservation.php` → `/var/www/booking/app/Models/`
   - `database/migrations/2026_01_05_000000_add_payment_fields_to_reservations_table.php` → `/var/www/booking/database/migrations/`
   - `resources/views/payment/show.blade.php` → `/var/www/booking/resources/views/payment/` (create folder if needed)
   - `resources/views/reservations/index.blade.php` → `/var/www/booking/resources/views/reservations/`

