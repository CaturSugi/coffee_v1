# 📦 PANDUAN INSTALASI LENGKAP - POS COFFEE SHOP

## DAFTAR ISI
1. [Prerequisites](#prerequisites)
2. [Instalasi Step-by-Step](#instalasi-step-by-step)
3. [Konfigurasi Database](#konfigurasi-database)
4. [Setup Aplikasi](#setup-aplikasi)
5. [Testing](#testing)
6. [Troubleshooting](#troubleshooting)

---

## Prerequisites

### Software yang Harus Diinstall:
```
✅ PHP 8.1+ (dengan extensions: mbstring, zip, intl, gd)
✅ MySQL 8.0+
✅ Composer (latest)
✅ Node.js 18+ & npm
✅ Git (optional)
✅ Visual Studio Code / Text Editor
```

### Verifikasi Instalasi:
```bash
php -v
mysql -v
composer --version
npm --version
node --version
```

---

## Instalasi Step-by-Step

### Step 1: Create Project
```bash
# Via Composer (Recommended)
composer create-project laravel/laravel laravel-pos-coffee
cd laravel-pos-coffee

# OR Clone dari Git
git clone https://github.com/yourusername/laravel-pos-coffee.git
cd laravel-pos-coffee
composer install
```

### Step 2: Install Dependencies
```bash
# PHP Dependencies
composer require laravel/sanctum laravel/tinker
composer require --dev laravel/pint laravel/sail

# NPM Dependencies
npm install
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

### Step 3: Environment Configuration
```bash
# Copy .env.example ke .env
cp .env.example .env

# Generate APP_KEY
php artisan key:generate
```

### Step 4: Edit .env File
```env
APP_NAME="Bran Coffee n Co"
APP_ENV=local
APP_KEY=base64:... (auto-generated)
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bran_coffee_pos
DB_USERNAME=root
DB_PASSWORD=your_password

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Mail Configuration (Optional)
MAIL_MAILER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password

# Optional: Printer Configuration
THERMAL_PRINTER_IP=192.168.1.100
THERMAL_PRINTER_PORT=9100
BLUETOOTH_PRINTER_ENABLED=true
```

### Step 5: Create Database
```bash
# Via MySQL CLI
mysql -u root -p
CREATE DATABASE `bran_coffee_pos` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# OR via Laravel
php artisan migrate --database=mysql
```

### Step 6: Run Migrations
```bash
php artisan migrate
php artisan migrate:fresh (jika reset)
```

### Step 7: Seed Database (Dummy Data)
```bash
php artisan db:seed
# atau specific seeder:
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ProductSeeder
```

### Step 8: Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### Step 9: Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Konfigurasi Database

### Create Database via PHPMyAdmin:
1. Buka http://localhost/phpmyadmin
2. Klik "New"
3. Nama: `bran_coffee_pos`
4. Collation: `utf8mb4_unicode_ci`
5. Create

### Create Database via MySQL CLI:
```sql
CREATE DATABASE `bran_coffee_pos` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bran_coffee_pos`;
```

---

## Setup Aplikasi

### 1. Create Database Tables
```bash
# Jalankan semua migrations
php artisan migrate

# Output:
# Migration table created successfully.
# Migrating: 2014_10_12_000000_create_users_table
# Migrated: 2014_10_12_000000_create_users_table
# ... (and more)
```

### 2. Create Admin User
```bash
php artisan tinker

# Inside tinker:
>>> use App\Models\User;
>>> User::create([
...   'name' => 'Admin',
...   'email' => 'admin@brancoffee.com',
...   'password' => bcrypt('password'),
...   'role' => 'admin',
...   'is_active' => true
... ]);
>>> exit
```

### 3. Create Default Data
```bash
# Run seeders
php artisan db:seed

# Or specific seeder
php artisan db:seed --class=ProductCategorySeeder
php artisan db:seed --class=ProductSeeder
```

### 4. Create Storage Symlink
```bash
php artisan storage:link
```

### 5. Configure Permissions (Linux/Mac)
```bash
# Set storage writable
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set public writable (if needed)
chmod -R 775 public/storage
```

---

## Testing

### Start Development Server
```bash
# Method 1: Built-in PHP Server
php artisan serve
# Access: http://localhost:8000

# Method 2: Laravel Sail (Docker)
./vendor/bin/sail up

# Method 3: Apache/Nginx
# Configure vhost pointing to public/ folder
```

### Access Aplikasi
```
Frontend (Landing Page): http://localhost:8000
Admin Panel: http://localhost:8000/admin
Manager Panel: http://localhost:8000/manager
POS System: http://localhost:8000/pos

Default Admin:
Email: admin@brancoffee.com
Password: password
```

### Test Database Connection
```bash
php artisan tinker

# Test:
>>> DB::connection()->getPDO()
>>> User::count()
>>> Product::count()
```

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test tests/Feature/TransactionTest.php

# With coverage
php artisan test --coverage
```

---

## Struktur File yang Dibuat

### Models (app/Models/)
```
✅ User.php
✅ Member.php
✅ Product.php
✅ ProductCategory.php
✅ Transaction.php
✅ TransactionDetail.php
✅ Promotion.php
✅ Invoice.php
✅ Post.php
✅ AuditLog.php
```

### Controllers (app/Http/Controllers/)
```
✅ Admin/
   ├── DashboardController.php
   ├── ProductController.php
   ├── UserController.php
   ├── MemberController.php
   ├── ReportController.php
   └── SettingsController.php

✅ Manager/
   ├── DashboardController.php
   ├── PromotionController.php
   └── ReportController.php

✅ POS/
   ├── TransactionController.php
   └── PaymentController.php

✅ Web/
   ├── HomeController.php
   ├── BlogController.php
   └── AuthController.php
```

### Services (app/Services/)
```
✅ TransactionService.php
✅ PrinterService.php
✅ PromotionService.php
✅ ReportService.php
```

### Views (resources/views/)
```
✅ layouts/
   ├── app.blade.php
   ├── web.blade.php
   └── auth.blade.php

✅ admin/
   ├── dashboard.blade.php
   ├── users/
   ├── products/
   └── reports/

✅ pos/
   ├── transaction.blade.php
   ├── payment.blade.php
   └── invoice.blade.php

✅ web/
   ├── home.blade.php
   ├── menu.blade.php
   └── blog/
```

---

## Konfigurasi Printer

### Thermal Printer (80mm)

**Requirements:**
- Thermal printer dengan dukungan TCP/IP atau USB
- Driver printer terinstall
- Network connection ke printer

**Setup:**

1. **Identify Printer IP:**
```bash
# Windows
netstat -an | findstr :9100

# Linux
nmap -p 9100 192.168.1.0/24

# Mac
arp -a | grep -i printer
```

2. **Update .env:**
```env
THERMAL_PRINTER_IP=192.168.1.100
THERMAL_PRINTER_PORT=9100
```

3. **Test Connection:**
```bash
php artisan tinker

>>> $service = app(App\Services\PrinterService::class);
>>> $service->printThermal($transaction);
```

### Bluetooth Printer

**Requirements:**
- Bluetooth printer compatible
- Pairing completed
- JavaScript Bluetooth API support

**Frontend Implementation (JavaScript):**

```javascript
// request() -> requestDevice()
// connect() -> connectGATT()
// write() -> writeValue()

async function printBluetooth(receiptData) {
    try {
        const device = await navigator.bluetooth.requestDevice({
            filters: [{ services: ['180a'] }]
        });
        
        const server = await device.gatt.connect();
        const service = await server.getPrimaryService('180a');
        const characteristic = await service.getCharacteristic('2a29');
        
        await characteristic.writeValue(new TextEncoder().encode(receiptData));
        
        return {
            success: true,
            message: 'Berhasil mencetak via Bluetooth'
        };
    } catch (error) {
        return {
            success: false,
            message: 'Error: ' + error.message
        };
    }
}
```

---

## Troubleshooting

### Error: "Class Not Found"
```bash
# Regenerate autoloader
composer dump-autoload

# Clear cache
php artisan cache:clear
```

### Error: "SQLSTATE[HY000]: General error: 1030"
```bash
# Check database connection
php artisan tinker
>>> DB::connection()->getPDO()

# Or check .env settings
```

### Error: "The stream or file could not be opened"
```bash
# Fix permissions
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

### Error: "Vite manifest not found"
```bash
# Rebuild assets
npm run build

# Or dev mode
npm run dev
```

### Port Already in Use
```bash
# Use different port
php artisan serve --port=8001

# Or find and kill process
lsof -i :8000
kill -9 <PID>
```

### Database Connection Failed
```bash
# Verify MySQL running
mysql -u root -p

# Check .env credentials
cat .env | grep DB_

# Reset database
php artisan migrate:fresh --seed
```

---

## Development Tips

### Use Tinker for Testing
```bash
php artisan tinker

# Create test data
>>> $user = User::factory()->create(['role' => 'admin']);
>>> $product = Product::factory()->create();
>>> $member = Member::factory()->create(['user_id' => $user->id]);
```

### Watch Mode for Assets
```bash
# Terminal 1: Watch assets
npm run dev

# Terminal 2: Run server
php artisan serve
```

### Database Backup
```bash
# Backup
mysqldump -u root -p bran_coffee_pos > backup.sql

# Restore
mysql -u root -p bran_coffee_pos < backup.sql
```

### Check Logs
```bash
# Real-time log
tail -f storage/logs/laravel.log

# Windows
Get-Content storage\logs\laravel.log -Wait
```

---

## Production Deployment

### Preparation
```bash
# Update .env
APP_ENV=production
APP_DEBUG=false

# Install only production dependencies
composer install --no-dev --optimize-autoloader

# Build assets
npm run build
```

### Optimization
```bash
# Generate optimized config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize composer autoloader
composer dump-autoload --optimize

# Clear all cache
php artisan cache:clear
```

### Server Configuration (Apache)
```apache
<VirtualHost *:80>
    ServerName brancoffee.com
    ServerAdmin admin@brancoffee.com
    
    DocumentRoot /var/www/laravel-pos-coffee/public
    
    <Directory /var/www/laravel-pos-coffee/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

### Server Configuration (Nginx)
```nginx
server {
    listen 80;
    server_name brancoffee.com;
    root /var/www/laravel-pos-coffee/public;
    
    index index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
    
    location ~ /\. {
        deny all;
    }
}
```

---

## Support & Documentation

- **Laravel Docs**: https://laravel.com/docs
- **Tailwind CSS**: https://tailwindcss.com/docs
- **Alpine.js**: https://alpinejs.dev/
- **MySQL**: https://dev.mysql.com/doc/

---

**Created**: 2026  
**Version**: 1.0.0  
**Support**: admin@brancoffee.com
