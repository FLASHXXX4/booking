# Quick Fix Instructions

## Problem 1: SQLite Driver Not Found

**Solution:** The SQLite extensions need to be properly enabled in PHP.

1. **Check if SQLite DLLs exist:**
   ```powershell
   Test-Path "C:\PHP\ext\php_pdo_sqlite.dll"
   Test-Path "C:\PHP\ext\php_sqlite3.dll"
   ```

2. **If DLLs exist, enable them in `C:\PHP\php.ini`:**
   - Find: `extension=pdo_sqlite` (should NOT have `;` at start)
   - Find: `extension=sqlite3` (should NOT have `;` at start)
   - If they have `;` at the start, remove it
   - Save the file

3. **Restart PHP/Web Server** and test:
   ```bash
   php -r "echo extension_loaded('pdo_sqlite') ? 'OK' : 'NOT OK';"
   ```

4. **If still not working, try using MySQL instead** (see below)

## Problem 2: PowerShell Execution Policy

The execution policy is already set to `Bypass`, so npm should work. If you still have issues:

```powershell
npm run build
```

If that fails, try:
```powershell
Set-ExecutionPolicy -ExecutionPolicy Bypass -Scope Process -Force
npm run build
```

## Alternative: Use MySQL

If SQLite doesn't work, you can use MySQL:

1. **Enable MySQL in `C:\PHP\php.ini`:**
   - Find: `;extension=pdo_mysql`
   - Remove the `;` to make it: `extension=pdo_mysql`
   - Save the file

2. **Update `.env` file:**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=booking
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Create the database:**
   ```sql
   CREATE DATABASE booking;
   ```

4. **Run migrations:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

## After Fixing

Once the database driver is working:

```bash
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

