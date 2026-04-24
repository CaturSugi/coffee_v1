# POS Coffee Shop - "Bran Coffee n Co"
## Dokumentasi Lengkap Setup & Implementasi

---

## 📋 DAFTAR ISI
1. [Requirement & Dependencies](#requirement--dependencies)
2. [Setup Database](#setup-database)
3. [Struktur File & Folder](#struktur-file--folder)
4. [Instalasi & Konfigurasi](#instalasi--konfigurasi)
5. [Fitur-Fitur Utama](#fitur-fitur-utama)
6. [API Endpoints](#api-endpoints)
7. [Testing & Deployment](#testing--deployment)

---

## 🔧 Requirement & Dependencies

### Server Requirements
- PHP >= 8.1
- Laravel 10.x atau 11.x
- MySQL 8.0+
- Node.js >= 18.x (untuk npm packages)
- Composer
- Apache/Nginx dengan mod_rewrite

### PHP Extensions
```
- BCMath
- Ctype
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
```

### NPM Packages
```
- tailwindcss (UI Framework)
- Alpine.js (Interactive Frontend)
- axios (HTTP Client)
- laravel-echo (Real-time notifications)
- escpos (Thermal Printer)
- qrcode (QR Code Generator)
```

---

## 🗄️ Setup Database

### 1. Buat Database
```sql
CREATE DATABASE `bran_coffee_pos`;
USE `bran_coffee_pos`;
```

### 2. Struktur Tabel MySQL

**Users Table**
```sql
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20),
  `address` text,
  `role` enum('admin','manager','cs','user') DEFAULT 'user',
  `is_active` boolean DEFAULT true,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_role` (`role`),
  INDEX `idx_active` (`is_active`)
);
```

**Members Table**
```sql
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `member_code` varchar(50) NOT NULL UNIQUE,
  `member_phone` varchar(20),
  `member_email` varchar(255),
  `discount_percentage` decimal(5,2) DEFAULT 0,
  `points_balance` int DEFAULT 0,
  `total_spent` decimal(12,2) DEFAULT 0,
  `is_active` boolean DEFAULT true,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  INDEX `idx_member_code` (`member_code`),
  INDEX `idx_phone` (`member_phone`),
  UNIQUE KEY `unique_member` (`user_id`)
);
```

**Products Table**
```sql
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `sku` varchar(100) NOT NULL UNIQUE,
  `purchase_price` decimal(12,2),
  `sell_price` decimal(12,2) NOT NULL,
  `stock` int DEFAULT 0,
  `min_stock` int DEFAULT 5,
  `image` varchar(255),
  `is_active` boolean DEFAULT true,
  `created_by` bigint unsigned,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `product_categories`(`id`),
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`),
  INDEX `idx_category` (`category_id`),
  INDEX `idx_sku` (`sku`),
  UNIQUE KEY `unique_sku` (`sku`)
);
```

**Product Categories Table**
```sql
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `description` text,
  `icon` varchar(255),
  `is_active` boolean DEFAULT true,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_slug` (`slug`)
);
```

**Transactions (Orders) Table**
```sql
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(100) NOT NULL UNIQUE,
  `user_id` bigint unsigned,
  `member_id` bigint unsigned,
  `subtotal` decimal(12,2) NOT NULL,
  `discount_amount` decimal(12,2) DEFAULT 0,
  `discount_percentage` decimal(5,2) DEFAULT 0,
  `tax_amount` decimal(12,2) DEFAULT 0,
  `total_amount` decimal(12,2) NOT NULL,
  `payment_method` enum('cash','card','e-wallet','qris') NOT NULL,
  `payment_status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `payment_date` timestamp NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`member_id`) REFERENCES `members`(`id`) ON DELETE SET NULL,
  INDEX `idx_code` (`transaction_code`),
  INDEX `idx_user` (`user_id`),
  INDEX `idx_member` (`member_id`),
  INDEX `idx_payment_status` (`payment_status`),
  INDEX `idx_created` (`created_at`)
);
```

**Transaction Details Table**
```sql
CREATE TABLE `transaction_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`transaction_id`) REFERENCES `transactions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT,
  INDEX `idx_transaction` (`transaction_id`)
);
```

**Promotions Table**
```sql
CREATE TABLE `promotions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL UNIQUE,
  `description` text,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(12,2) NOT NULL,
  `min_purchase` decimal(12,2) DEFAULT 0,
  `max_discount` decimal(12,2),
  `usage_limit` int,
  `usage_count` int DEFAULT 0,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` boolean DEFAULT true,
  `created_by` bigint unsigned,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`),
  UNIQUE KEY `unique_code` (`code`),
  INDEX `idx_active` (`is_active`),
  INDEX `idx_dates` (`start_date`, `end_date`)
);
```

**Invoices Table**
```sql
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `invoice_number` varchar(100) NOT NULL UNIQUE,
  `printed_at` timestamp NULL,
  `print_count` int DEFAULT 0,
  `printer_type` enum('thermal','bluetooth','pdf') DEFAULT 'thermal',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`transaction_id`) REFERENCES `transactions`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `unique_invoice` (`invoice_number`)
);
```

**Blog Posts Table**
```sql
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `content` longtext NOT NULL,
  `featured_image` varchar(255),
  `author_id` bigint unsigned,
  `status` enum('draft','published') DEFAULT 'draft',
  `published_at` timestamp NULL,
  `views_count` int DEFAULT 0,
  `meta_description` text,
  `meta_keywords` varchar(255),
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  UNIQUE KEY `unique_slug` (`slug`),
  INDEX `idx_status` (`status`),
  INDEX `idx_author` (`author_id`),
  INDEX `idx_published` (`published_at`)
);
```

**Audit Logs Table**
```sql
CREATE TABLE `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned,
  `action` varchar(255) NOT NULL,
  `model` varchar(255),
  `model_id` bigint unsigned,
  `old_values` json,
  `new_values` json,
  `ip_address` varchar(45),
  `user_agent` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  INDEX `idx_user` (`user_id`),
  INDEX `idx_action` (`action`),
  INDEX `idx_created` (`created_at`)
);
```

**Settings Table**
```sql
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL UNIQUE,
  `value` longtext,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`key`)
);
```

---

## 📁 Struktur File & Folder

```
laravel-pos-coffee/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── MemberController.php
│   │   │   │   ├── ReportController.php
│   │   │   │   └── SettingsController.php
│   │   │   ├── Manager/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── PromotionController.php
│   │   │   │   └── ReportController.php
│   │   │   ├── POS/
│   │   │   │   ├── TransactionController.php
│   │   │   │   ├── PrinterController.php
│   │   │   │   └── PaymentController.php
│   │   │   ├── Web/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   └── MemberController.php
│   │   │   └── AuthController.php
│   │   ├── Requests/
│   │   │   ├── StoreProductRequest.php
│   │   │   ├── StoreUserRequest.php
│   │   │   ├── StoreTransactionRequest.php
│   │   │   └── StorePromotionRequest.php
│   │   └── Middleware/
│   │       ├── Authenticate.php
│   │       ├── CheckRole.php
│   │       └── LogActivity.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Member.php
│   │   ├── Product.php
│   │   ├── ProductCategory.php
│   │   ├── Transaction.php
│   │   ├── TransactionDetail.php
│   │   ├── Promotion.php
│   │   ├── Invoice.php
│   │   ├── Post.php
│   │   └── AuditLog.php
│   ├── Services/
│   │   ├── TransactionService.php
│   │   ├── PrinterService.php
│   │   ├── PromotionService.php
│   │   └── ReportService.php
│   ├── Events/
│   │   ├── TransactionCreated.php
│   │   └── ProductUpdated.php
│   ├── Jobs/
│   │   └── PrintInvoiceJob.php
│   └── Traits/
│       ├── LogsActivity.php
│       └── HasPermissions.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── web.blade.php
│   │   │   └── auth.blade.php
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── users/
│   │   │   ├── products/
│   │   │   ├── members/
│   │   │   └── reports/
│   │   ├── manager/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── promotions/
│   │   │   └── reports/
│   │   ├── pos/
│   │   │   ├── transaction.blade.php
│   │   │   ├── print-invoice.blade.php
│   │   │   └── payment.blade.php
│   │   ├── web/
│   │   │   ├── home.blade.php
│   │   │   ├── blog/
│   │   │   ├── menu.blade.php
│   │   │   └── about.blade.php
│   │   └── auth/
│   │       ├── login.blade.php
│   │       └── register.blade.php
│   ├── css/
│   │   └── app.css (Tailwind)
│   └── js/
│       ├── app.js
│       ├── pos-system.js
│       └── printer.js
├── routes/
│   ├── web.php
│   ├── api.php
│   ├── admin.php
│   ├── manager.php
│   ├── pos.php
│   └── web-public.php
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── storage/
│   ├── invoices/
│   └── reports/
├── public/
│   ├── images/
│   ├── css/
│   └── js/
└── .env (Configuration file)
```

---

## 🚀 Instalasi & Konfigurasi

### Step 1: Install Laravel Project
```bash
composer create-project laravel/laravel laravel-pos-coffee
cd laravel-pos-coffee

# Install additional packages
composer require laravel/sanctum laravel/tinker
composer require --dev laravel/pint laravel/sail
```

### Step 2: Install NPM Dependencies
```bash
npm install
npm install -D tailwindcss postcss autoprefixer
npm run build
```

### Step 3: Setup .env
```env
APP_NAME="Bran Coffee n Co"
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bran_coffee_pos
DB_USERNAME=root
DB_PASSWORD=

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password

# Printer Settings
THERMAL_PRINTER_IP=192.168.1.100
THERMAL_PRINTER_PORT=9100
BLUETOOTH_PRINTER_ENABLED=true
```

### Step 4: Run Migrations
```bash
php artisan migrate
php artisan db:seed
```

### Step 5: Setup Assets
```bash
npm run dev
# atau untuk production:
npm run build
```

---

## ✨ Fitur-Fitur Utama

### 1. **Manajemen Pengguna & Roles**
- ✅ Admin: Akses penuh, kelola user, produk, member, laporan
- ✅ Manager: Kelola promosi, laporan penjualan, member
- ✅ CS (Customer Service): Input transaksi, print invoice
- ✅ User/Member: Login, lihat riwayat transaksi, dapatkan diskon

### 2. **Sistem POS Terpadu**
- ✅ Antarmuka POS yang user-friendly
- ✅ Pencarian & filter produk real-time
- ✅ Keranjang belanja interaktif
- ✅ Penyesuaian harga & qty per item
- ✅ Kalkulasi otomatis subtotal, pajak, diskon

### 3. **Manajemen Produk**
- ✅ CRUD produk lengkap
- ✅ Kategori produk
- ✅ Stock management dengan notifikasi
- ✅ Upload image produk
- ✅ SKU tracking

### 4. **Member & Loyalty Program**
- ✅ Registrasi member
- ✅ Member code otomatis
- ✅ Discount berdasarkan member status
- ✅ Points accumulation system
- ✅ Member history transaksi

### 5. **Sistem Promosi**
- ✅ CRUD promosi
- ✅ Discount percentage & fixed amount
- ✅ Date range validation
- ✅ Usage limit tracking
- ✅ Minimum purchase requirement

### 6. **Payment Methods**
- ✅ Cash Payment
- ✅ Debit/Credit Card (integrasi simulasi)
- ✅ E-wallet (OVO, GoPay, Dana)
- ✅ QRIS Payment

### 7. **Cetak Invoice**
- ✅ Thermal Printer (80mm & 58mm)
- ✅ Bluetooth Printer
- ✅ PDF Download
- ✅ Custom layout invoice
- ✅ QR code di invoice
- ✅ History cetak

### 8. **Laporan & Analytics**
- ✅ Dashboard dengan statistik real-time
- ✅ Sales report by date/period
- ✅ Product performance report
- ✅ Member report
- ✅ Export to PDF/Excel

### 9. **Landing Page & Blog**
- ✅ Landing page responsif
- ✅ Menu showcase interaktif
- ✅ Blog/konten management
- ✅ SEO optimization
- ✅ Social media integration

### 10. **Keamanan & Audit**
- ✅ Authentication & authorization
- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ Activity logging
- ✅ IP tracking

---

## 📡 API Endpoints

### Authentication
```
POST   /api/auth/login
POST   /api/auth/logout
POST   /api/auth/register
GET    /api/auth/user
```

### Products
```
GET    /api/products
GET    /api/products/{id}
POST   /api/products (admin)
PUT    /api/products/{id} (admin)
DELETE /api/products/{id} (admin)
GET    /api/products/category/{category_id}
```

### Transactions
```
POST   /api/transactions (create order)
GET    /api/transactions/{id}
GET    /api/transactions (list)
PUT    /api/transactions/{id}/payment
POST   /api/transactions/{id}/print
```

### Members
```
GET    /api/members/{id}
POST   /api/members (register)
PUT    /api/members/{id}
GET    /api/members/{id}/transactions
```

### Promotions
```
GET    /api/promotions (active only)
POST   /api/promotions/validate-code
GET    /api/promotions (admin - all)
```

### Reports
```
GET    /api/reports/dashboard
GET    /api/reports/sales
GET    /api/reports/products
GET    /api/reports/members
```

---

## 🧪 Testing & Deployment

### Local Testing
```bash
# Run development server
php artisan serve

# Run tests
php artisan test

# Create test data
php artisan tinker
>>> User::factory(10)->create()
>>> Product::factory(50)->create()
```

### Production Deployment
```bash
# Build assets
npm run build

# Optimize
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Setup database
php artisan migrate --force

# Seed production data
php artisan db:seed --force
```

---

## 📝 Next Steps

1. ✅ Setup development environment
2. ✅ Create database & tables
3. ✅ Generate models & migrations
4. ✅ Create controllers & views
5. ✅ Implement payment gateway
6. ✅ Setup thermal printer driver
7. ✅ Create testing & QA
8. ✅ Deploy to production

---

**Dibuat oleh**: Development Team  
**Tanggal**: 2026  
**Version**: 1.0.0
