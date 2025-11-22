# Fix for Laravel Excel Not Found Error in Production

## Problem
`Class "Maatwebsite\Excel\Facades\Excel" not found` error when clicking export button in clients section.

## Solution Steps

### Connect to your production server via SSH and navigate to your project:
```bash
cd /home/u158680994/domains/zen-tix.site/public_html
```

### Step 1: Install/Update Composer Dependencies
```bash
composer install --optimize-autoloader --no-dev
```

**Note:** Use `composer install` (not `composer update`) to install the exact versions specified in composer.lock. The `--no-dev` flag excludes development dependencies in production.

### Step 2: Clear and Rebuild Laravel Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 3: Rebuild Optimized Files
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 4: Regenerate Autoloader
```bash
composer dump-autoload --optimize
```

### Step 5: Verify Installation
Check if the package is installed:
```bash
composer show maatwebsite/excel
```

You should see package information. If not, manually require it:
```bash
composer require maatwebsite/excel:^3.1
```

### Step 6: Restart PHP-FPM (if applicable)
Depending on your server setup:
```bash
# Find your PHP-FPM service name first
sudo systemctl restart php8.2-fpm
# OR for cPanel/shared hosting, you may need to use:
# pkill -9 php-fpm
```

### Step 7: Test the Export Function
After completing these steps, try clicking the export button again in the clients section.

## Additional Troubleshooting

### If the issue persists, check:

1. **Verify composer.json includes the package:**
   ```bash
   cat composer.json | grep maatwebsite
   ```
   Should show: `"maatwebsite/excel": "^3.1"`

2. **Check PHP version compatibility:**
   ```bash
   php -v
   ```
   The package requires PHP ^8.0. Laravel 12 requires PHP ^8.2.

3. **Check file permissions:**
   ```bash
   ls -la vendor/maatwebsite/
   ```
   Ensure the web server user can read these files.

4. **Check composer.lock exists:**
   ```bash
   ls -la composer.lock
   ```
   This file should be committed to your repository.

5. **Verify package discovery:**
   ```bash
   php artisan package:discover
   ```

## Common Causes

- Composer dependencies not installed on production server
- Using `composer update` instead of `composer install` (causing version mismatches)
- Outdated Laravel cache files
- File permission issues
- PHP-FPM not restarted after changes

## Prevention

Always include these commands in your deployment script:
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```



