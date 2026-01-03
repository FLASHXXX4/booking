# Fixing Database Connection Issues

## Issue 1: SQLite Driver Not Found

The error "could not find driver" means PHP's SQLite extensions are not loaded.

### Solution Option 1: Enable SQLite Extensions

1. Open `C:\PHP\php.ini` in a text editor
2. Find these lines and make sure they are NOT commented (no semicolon at the start):
   ```
   extension=pdo_sqlite
   extension=sqlite3
   ```
3. If they're commented (start with `;`), remove the semicolon
4. Save the file
5. Restart your web server or PHP CLI

### Solution Option 2: Switch to MySQL

1. Make sure MySQL is installed and running
2. Create a database named `booking`:
   ```sql
   CREATE DATABASE booking;
   ```
3. Update your `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=booking
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```
4. Run migrations:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

## Issue 2: PowerShell Execution Policy

The execution policy is already set to `Bypass`, so npm should work. If you still get errors, try:

```powershell
Set-ExecutionPolicy -ExecutionPolicy Bypass -Scope Process
```

Then run:
```bash
npm run build
```

## Quick Test

After fixing, test with:
```bash
php artisan migrate
php artisan db:seed
```

