# ⚡ QUICK START GUIDE - POS COFFEE SHOP

## 📋 CHECKLIST IMPLEMENTASI

### Phase 1: Setup & Database ✅
```
☐ Install PHP 8.1+, MySQL 8.0+, Node.js
☐ Clone/Create Laravel project
☐ Install composer & npm dependencies
☐ Configure .env file
☐ Generate APP_KEY
☐ Create database
☐ Run migrations
☐ Seed test data
☐ Verify database connection
```

### Phase 2: Authentication & Users ✅
```
☐ Setup User model & migrations
☐ Create authentication controllers
☐ Implement login/logout
☐ Setup role-based access control
☐ Create user management CRUD
☐ Setup password reset
☐ Test login dengan berbagai role
```

### Phase 3: Product Management ✅
```
☐ Setup Product model & migrations
☐ Create ProductCategory
☐ Build product CRUD
☐ Implement product image upload
☐ Setup SKU validation
☐ Create product search/filter
☐ Test stock management
☐ Build admin product interface
```

### Phase 4: POS System ✅
```
☐ Design POS UI (cart, products grid)
☐ Implement add/remove product logic
☐ Build quantity/price adjustment
☐ Create real-time calculation
☐ Test cart functionality
☐ Build payment method selection
☐ Test POS interface thoroughly
```

### Phase 5: Member & Loyalty ✅
```
☐ Setup Member model & migrations
☐ Create member registration
☐ Build member search functionality
☐ Implement discount logic
☐ Create points system
☐ Build member report
☐ Test member transaction history
```

### Phase 6: Promotions ✅
```
☐ Setup Promotion model & migrations
☐ Create promotion CRUD
☐ Implement promo code validation
☐ Build discount calculation
☐ Setup usage limit tracking
☐ Create manager interface
☐ Test promotion application
```

### Phase 7: Payment & Transactions ✅
```
☐ Setup Transaction model & migrations
☐ Create TransactionDetail model
☐ Implement transaction creation
☐ Setup payment processing
☐ Create payment methods (cash, card, e-wallet, QRIS)
☐ Test payment flow
☐ Build transaction history
```

### Phase 8: Printing ✅
```
☐ Setup printer configuration
☐ Implement thermal printer integration
☐ Implement Bluetooth printer support
☐ Create PDF invoice generation
☐ Test printing functionality
☐ Setup print history tracking
☐ Create print retry mechanism
```

### Phase 9: Reporting & Analytics ✅
```
☐ Create dashboard statistics
☐ Build sales report
☐ Create product performance report
☐ Build member analysis
☐ Setup date range filtering
☐ Create export to PDF/Excel
☐ Test all reports
```

### Phase 10: Landing Page & Blog ✅
```
☐ Design landing page
☐ Create about section
☐ Build menu showcase
☐ Setup blog management
☐ Implement blog CRUD
☐ Create public blog listing
☐ Setup SEO optimization
☐ Test responsive design
```

### Phase 11: Security & Audit ✅
```
☐ Implement CSRF protection
☐ Setup activity logging
☐ Create audit log viewer
☐ Setup IP tracking
☐ Implement password hashing
☐ Create user session management
☐ Test security measures
```

### Phase 12: Testing & Deployment ✅
```
☐ Write unit tests
☐ Write feature tests
☐ Perform load testing
☐ Security audit
☐ Database backup testing
☐ Setup production server
☐ Configure SSL certificate
☐ Deploy to production
```

---

## 🚀 QUICK START (5 MENIT)

### 1. Clone/Setup Project
```bash
# Clone atau create project
cd ~/projects
composer create-project laravel/laravel bran-coffee
cd bran-coffee

# Atau jika sudah ada project
git clone <your-repo>
cd <project-folder>
composer install
npm install
```

### 2. Configure Environment
```bash
# Copy env
cp .env.example .env

# Generate key
php artisan key:generate

# Edit .env (database credentials)
nano .env
```

### 3. Setup Database
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE bran_coffee_pos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations
php artisan migrate

# Seed data
php artisan db:seed
```

### 4. Create Default Admin
```bash
php artisan tinker

# Inside tinker:
>>> User::create(['name'=>'Admin','email'=>'admin@brancoffee.com','password'=>bcrypt('password'),'role'=>'admin'])
>>> exit
```

### 5. Build Assets & Run
```bash
# Build CSS/JS
npm run dev

# Run server (terminal baru)
php artisan serve

# Access: http://localhost:8000
```

---

## 🎯 DEFAULT CREDENTIALS

```
Admin Login:
Email: admin@brancoffee.com
Password: password
Role: admin

Manager Login:
Email: manager@brancoffee.com
Password: password
Role: manager

CS Login:
Email: cs@brancoffee.com
Password: password
Role: cs

Member Test:
Email: member@brancoffee.com
Password: password
Role: user
```

---

## 📍 IMPORTANT PATHS

### Controllers
```
app/Http/Controllers/
  ├── Admin/                    # Admin panel controllers
  ├── Manager/                  # Manager panel controllers
  ├── POS/                      # POS system controllers
  └── Web/                      # Frontend controllers
```

### Models
```
app/Models/
  ├── User.php
  ├── Product.php
  ├── Transaction.php
  ├── Member.php
  ├── Promotion.php
  └── Invoice.php
```

### Views
```
resources/views/
  ├── layouts/                  # Layout templates
  ├── admin/                    # Admin pages
  ├── pos/                      # POS pages
  ├── web/                      # Frontend pages
  └── auth/                     # Auth pages
```

### Routes
```
routes/
  ├── web.php                   # Main routes
  ├── api.php                   # API routes
  ├── admin.php                 # Admin routes
  ├── pos.php                   # POS routes
  └── web-public.php            # Public website routes
```

---

## 🔍 KEY FEATURES CHECKLIST

### Admin Features
```
☐ Dashboard dengan statistics
☐ User management (create, edit, delete)
☐ Product CRUD
☐ Member management
☐ Transaction viewing
☐ Sales report
☐ System settings
☐ Audit logs
```

### Manager Features
```
☐ Dashboard
☐ Promotion management
☐ Sales report by period
☐ Product performance
☐ Member analysis
☐ Staff management (read-only)
```

### CS (Customer Service) Features
```
☐ POS interface
☐ Quick product search
☐ Member search & selection
☐ Shopping cart management
☐ Multiple payment methods
☐ Print invoice (thermal/bluetooth/pdf)
☐ Transaction history (read-only)
```

### Member Features
```
☐ Register/Login
☐ View personal info
☐ Discount application
☐ Points balance view
☐ Transaction history
☐ Tier/status view
☐ Update profile
```

### Public Features
```
☐ Landing page
☐ Menu showcase
☐ About page
☐ Blog/News section
☐ Contact form
☐ Responsive design
```

---

## 🧪 TESTING COMMANDS

### Test Database Connection
```bash
php artisan tinker
>>> DB::connection()->getPDO()
>>> User::count()
>>> Product::count()
```

### Create Test Data
```bash
php artisan tinker

>>> User::factory(10)->create()
>>> Product::factory(50)->create()
>>> Member::factory(5)->create()
>>> Transaction::factory(20)->create()
```

### Run Tests
```bash
# All tests
php artisan test

# Specific test
php artisan test tests/Feature/TransactionTest.php

# With coverage
php artisan test --coverage
```

### Check Logs
```bash
# Real-time
tail -f storage/logs/laravel.log

# Windows
Get-Content storage\logs\laravel.log -Wait
```

---

## 🔧 CONFIGURATION TIPS

### Thermal Printer Setup
```
1. Get printer IP: netstat -an | findstr :9100
2. Update .env: THERMAL_PRINTER_IP=192.168.1.100
3. Test connection: fsockopen($ip, 9100, $errno, $errstr, 5)
```

### Email Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@brancoffee.com
```

### File Upload Configuration
```php
// config/filesystems.php
'disks' => [
    'public' => [
        'driver' => 'local',
        'path' => storage_path('app/public'),
    ],
]

// .env
FILESYSTEM_DISK=public
```

---

## 📱 MOBILE RESPONSIVENESS

### Test Breakpoints
```
Mobile: 320px - 640px
Tablet: 641px - 1024px
Desktop: 1025px+

Use: @media (max-width: 640px) {}
```

---

## 🚨 COMMON ISSUES & SOLUTIONS

### Issue: "Class not found"
```bash
Solution: composer dump-autoload
```

### Issue: "SQLSTATE[HY000]: General error"
```bash
Solution: Check .env database credentials
          php artisan migrate:refresh
```

### Issue: "The stream or file could not be opened"
```bash
Solution: chmod -R 777 storage bootstrap/cache
```

### Issue: "Vite manifest not found"
```bash
Solution: npm run build
```

### Issue: "Port 8000 already in use"
```bash
Solution: php artisan serve --port=8001
          lsof -i :8000 && kill -9 <PID>
```

---

## 📊 PERFORMANCE OPTIMIZATION

### Query Optimization
```php
// Use with() untuk eager loading
Product::with('category')->get();

// Use select() untuk specific columns
Product::select('id', 'name', 'price')->get();

// Use pagination
Product::paginate(15);
```

### Cache Setup
```php
// Cache frequently accessed data
Cache::remember('products', 60, function() {
    return Product::all();
});
```

### Asset Optimization
```bash
# Minify JS/CSS
npm run build

# Compress images
php artisan image:optimize
```

---

## 📈 SCALING TIPS

### For 1000+ Users
```
- Setup database replication
- Implement caching (Redis)
- Use CDN for static assets
- Setup load balancing
- Monitor server resources
```

### For Payment Integration
```
- Use payment gateway SDK
- Implement webhook validation
- Setup transaction logging
- Create payment reconciliation
```

### For High Traffic
```
- Setup rate limiting
- Implement queue system
- Use database connection pooling
- Setup monitoring & alerts
```

---

## 🎓 LEARNING RESOURCES

- Laravel Docs: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com
- Alpine.js: https://alpinejs.dev
- MySQL: https://dev.mysql.com/doc
- RESTful API: https://restfulapi.net

---

## 📞 SUPPORT

For issues or questions:
1. Check error logs: `storage/logs/laravel.log`
2. Review documentation
3. Check similar issues online
4. Contact development team

**Email**: dev@brancoffee.com
**Docs**: https://docs.brancoffee.com

---

**Last Updated**: 2024  
**Version**: 1.0.0
