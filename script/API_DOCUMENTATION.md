# 📡 API DOCUMENTATION - BRAN COFFEE POS

## Base URL
```
Development: http://localhost:8000
Production: https://api.brancoffee.com
API Version: v1
```

---

## 🔐 Authentication

### Login
```
POST /api/auth/login
Content-Type: application/json

Request:
{
    "email": "admin@brancoffee.com",
    "password": "password"
}

Response:
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "user": {
            "id": 1,
            "name": "Admin",
            "email": "admin@brancoffee.com",
            "role": "admin",
            "is_active": true
        },
        "access_token": "1|laravel_sanctum_token_here",
        "token_type": "Bearer"
    }
}
```

### Logout
```
POST /api/auth/logout
Headers:
    Authorization: Bearer {access_token}

Response:
{
    "success": true,
    "message": "Logout berhasil"
}
```

### Get Current User
```
GET /api/auth/user
Headers:
    Authorization: Bearer {access_token}

Response:
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Admin",
        "email": "admin@brancoffee.com",
        "role": "admin"
    }
}
```

---

## 📦 Products API

### Get All Products
```
GET /api/products?page=1&limit=15&search=kopi&category_id=1
Headers:
    Authorization: Bearer {access_token}

Query Parameters:
    - page: integer (default: 1)
    - limit: integer (default: 15)
    - search: string
    - category_id: integer
    - sort: string (name, price, stock)

Response:
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "category_id": 1,
                "name": "Espresso",
                "sku": "PROD-001",
                "sell_price": 25000,
                "stock": 50,
                "image": "products/espresso.jpg",
                "is_active": true,
                "category": {
                    "id": 1,
                    "name": "Coffee"
                }
            }
        ],
        "total": 50,
        "per_page": 15,
        "last_page": 4
    }
}
```

### Get Single Product
```
GET /api/products/{id}

Response:
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Espresso",
        "description": "Espresso premium blend",
        "sku": "PROD-001",
        "purchase_price": 15000,
        "sell_price": 25000,
        "stock": 50,
        "min_stock": 5,
        "profit_margin": 66.67,
        "category": {...}
    }
}
```

### Create Product (Admin Only)
```
POST /api/products
Headers:
    Authorization: Bearer {access_token}
    Content-Type: application/json

Request:
{
    "category_id": 1,
    "name": "Cappuccino",
    "description": "Cappuccino with milk foam",
    "sku": "PROD-002",
    "purchase_price": 10000,
    "sell_price": 30000,
    "stock": 100,
    "min_stock": 10,
    "image": "file_upload" // Base64 or multipart
}

Response:
{
    "success": true,
    "message": "Produk berhasil ditambahkan",
    "data": {...}
}
```

### Update Product (Admin Only)
```
PUT /api/products/{id}
Headers:
    Authorization: Bearer {access_token}

Request:
{
    "name": "Cappuccino Premium",
    "sell_price": 35000,
    "stock": 120
}

Response:
{
    "success": true,
    "message": "Produk berhasil diperbarui"
}
```

### Delete Product (Admin Only)
```
DELETE /api/products/{id}
Headers:
    Authorization: Bearer {access_token}

Response:
{
    "success": true,
    "message": "Produk berhasil dihapus"
}
```

---

## 💳 Transactions API

### Create Transaction
```
POST /api/transactions
Headers:
    Authorization: Bearer {access_token}
    Content-Type: application/json

Request:
{
    "items": [
        {
            "product_id": 1,
            "quantity": 2,
            "notes": "Extra hot"
        },
        {
            "product_id": 2,
            "quantity": 1
        }
    ],
    "member_id": 5,
    "promotion_code": "PROMO123",
    "payment_method": "cash",
    "notes": "Customer order"
}

Response:
{
    "success": true,
    "message": "Transaksi berhasil dibuat",
    "data": {
        "id": 1,
        "transaction_code": "TRX-20240101-00001",
        "subtotal": 85000,
        "discount_amount": 8500,
        "discount_percentage": 10,
        "tax_amount": 7650,
        "total_amount": 84150,
        "payment_method": "cash",
        "payment_status": "pending",
        "created_at": "2024-01-01 10:30:00",
        "details": [
            {
                "product_id": 1,
                "quantity": 2,
                "unit_price": 25000,
                "subtotal": 50000
            }
        ]
    }
}
```

### Get Transaction List
```
GET /api/transactions?page=1&status=completed&member_id=5&date_from=2024-01-01&date_to=2024-01-31

Query Parameters:
    - page: integer
    - status: pending|completed|cancelled
    - payment_method: cash|card|e-wallet|qris
    - member_id: integer
    - date_from: YYYY-MM-DD
    - date_to: YYYY-MM-DD

Response:
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "transaction_code": "TRX-20240101-00001",
                "member": {
                    "id": 5,
                    "member_code": "MEM-001",
                    "member_name": "John Doe"
                },
                "total_amount": 84150,
                "payment_status": "completed",
                "payment_method": "cash",
                "created_at": "2024-01-01 10:30:00"
            }
        ],
        "total": 45,
        "per_page": 20
    }
}
```

### Get Transaction Details
```
GET /api/transactions/{id}

Response:
{
    "success": true,
    "data": {
        "id": 1,
        "transaction_code": "TRX-20240101-00001",
        "subtotal": 85000,
        "discount_amount": 8500,
        "tax_amount": 7650,
        "total_amount": 84150,
        "payment_method": "cash",
        "payment_status": "completed",
        "payment_date": "2024-01-01 10:35:00",
        "details": [
            {
                "id": 1,
                "product": {
                    "id": 1,
                    "name": "Espresso",
                    "sku": "PROD-001"
                },
                "quantity": 2,
                "unit_price": 25000,
                "subtotal": 50000,
                "notes": "Extra hot"
            }
        ],
        "member": {
            "id": 5,
            "member_code": "MEM-001",
            "member_name": "John Doe",
            "discount_percentage": 10
        },
        "user": {
            "id": 10,
            "name": "CS Name"
        }
    }
}
```

### Process Payment
```
PUT /api/transactions/{id}/payment
Headers:
    Authorization: Bearer {access_token}
    Content-Type: application/json

Request:
{
    "payment_method": "cash",
    "payment_reference": "TRX123456" // optional for e-wallet/card
}

Response:
{
    "success": true,
    "message": "Pembayaran berhasil diproses",
    "data": {
        "id": 1,
        "payment_status": "completed",
        "payment_date": "2024-01-01 10:35:00"
    }
}
```

### Cancel Transaction
```
POST /api/transactions/{id}/cancel
Headers:
    Authorization: Bearer {access_token}

Response:
{
    "success": true,
    "message": "Transaksi berhasil dibatalkan",
    "data": {
        "id": 1,
        "payment_status": "cancelled"
    }
}
```

---

## 👥 Members API

### Search Members
```
POST /api/members/search
Headers:
    Authorization: Bearer {access_token}

Request:
{
    "q": "John" // search by name, phone, or member code
}

Response:
{
    "success": true,
    "data": [
        {
            "id": 5,
            "name": "John Doe",
            "code": "MEM-001",
            "phone": "08123456789",
            "discount": 10,
            "tier": "Silver"
        }
    ]
}
```

### Get Member Details
```
GET /api/members/{id}

Response:
{
    "success": true,
    "data": {
        "id": 5,
        "user_id": 3,
        "member_code": "MEM-001",
        "member_name": "John Doe",
        "member_phone": "08123456789",
        "member_email": "john@example.com",
        "discount_percentage": 10,
        "points_balance": 1500,
        "total_spent": 2500000,
        "member_tier": "Silver",
        "is_active": true,
        "created_at": "2024-01-01"
    }
}
```

### Get Member Transactions
```
GET /api/members/{id}/transactions?page=1

Response:
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "transaction_code": "TRX-20240101-00001",
                "total_amount": 84150,
                "payment_status": "completed",
                "created_at": "2024-01-01 10:30:00"
            }
        ],
        "total": 10,
        "per_page": 10
    }
}
```

### Register Member
```
POST /api/members
Headers:
    Authorization: Bearer {access_token}

Request:
{
    "user_id": 3,
    "member_phone": "08123456789",
    "member_email": "john@example.com"
}

Response:
{
    "success": true,
    "message": "Member berhasil didaftarkan",
    "data": {
        "id": 5,
        "member_code": "MEM-001",
        "member_name": "John Doe"
    }
}
```

---

## 🎁 Promotions API

### Get Active Promotions
```
GET /api/promotions

Response:
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Diskon Tahun Baru",
            "code": "NEWYEAR2024",
            "description": "Diskon 20% untuk semua produk",
            "discount_type": "percentage",
            "discount_value": 20,
            "min_purchase": 50000,
            "usage_limit": 100,
            "usage_count": 45,
            "start_date": "2024-01-01",
            "end_date": "2024-01-31",
            "is_active": true
        }
    ]
}
```

### Validate Promotion Code
```
POST /api/promotions/validate
Headers:
    Authorization: Bearer {access_token}

Request:
{
    "code": "NEWYEAR2024",
    "amount": 100000 // total purchase amount
}

Response:
{
    "success": true,
    "message": "Kode promosi valid",
    "data": {
        "code": "NEWYEAR2024",
        "name": "Diskon Tahun Baru",
        "discount": 20000,
        "discount_type": "percentage"
    }
}
```

---

## 🖨️ Print API

### Print Thermal
```
POST /api/transactions/{id}/print-thermal
Headers:
    Authorization: Bearer {access_token}

Response:
{
    "success": true,
    "message": "Invoice berhasil dicetak ke printer thermal"
}
```

### Print Bluetooth
```
POST /api/transactions/{id}/print-bluetooth
Headers:
    Authorization: Bearer {access_token}

Response:
{
    "success": true,
    "message": "Invoice siap untuk dicetak via Bluetooth",
    "print_data": "base64_encoded_print_data"
}
```

### Download PDF
```
GET /api/transactions/{id}/download-pdf
Headers:
    Authorization: Bearer {access_token}

Response:
    File download: application/pdf
```

---

## 📊 Reports API

### Dashboard Report
```
GET /api/reports/dashboard?period=today|week|month|year

Response:
{
    "success": true,
    "data": {
        "total_sales": 5000000,
        "total_transactions": 50,
        "total_items_sold": 200,
        "average_transaction": 100000,
        "payment_methods": {
            "cash": 30,
            "card": 15,
            "e-wallet": 5
        },
        "top_products": [
            {
                "id": 1,
                "name": "Espresso",
                "total_sold": 45,
                "revenue": 1125000
            }
        ]
    }
}
```

### Sales Report
```
GET /api/reports/sales?date_from=2024-01-01&date_to=2024-01-31&group_by=day|product|method

Response:
{
    "success": true,
    "data": {
        "total_sales": 5000000,
        "total_transactions": 50,
        "breakdown": [
            {
                "date": "2024-01-01",
                "sales": 150000,
                "transactions": 3,
                "items": 10
            }
        ]
    }
}
```

---

## ❌ Error Responses

### 400 Bad Request
```json
{
    "success": false,
    "message": "Validasi gagal",
    "errors": {
        "email": ["Email sudah terdaftar"],
        "password": ["Password minimal 8 karakter"]
    }
}
```

### 401 Unauthorized
```json
{
    "success": false,
    "message": "Unauthorized - Token tidak valid atau expired"
}
```

### 403 Forbidden
```json
{
    "success": false,
    "message": "Forbidden - Anda tidak memiliki akses"
}
```

### 404 Not Found
```json
{
    "success": false,
    "message": "Resource tidak ditemukan"
}
```

### 500 Server Error
```json
{
    "success": false,
    "message": "Server error - Hubungi administrator"
}
```

---

## 🔄 Rate Limiting

- **Limit**: 100 requests per minute per API key
- **Header**: `X-RateLimit-Remaining`, `X-RateLimit-Reset`
- **Status**: 429 Too Many Requests

---

## 📝 Pagination

### Default Format
```json
{
    "current_page": 1,
    "data": [...],
    "total": 100,
    "per_page": 15,
    "last_page": 7,
    "from": 1,
    "to": 15
}
```

### Query Parameters
```
?page=1&per_page=20
```

---

## 🔑 API Key Authentication (Alternative)

```
GET /api/products
Headers:
    X-API-Key: your_api_key_here
```

---

## 📚 Testing dengan Postman

1. Download Postman
2. Import collection: `postman/BranCoffee-API.postman_collection.json`
3. Set environment variable:
   ```
   - base_url: http://localhost:8000
   - api_token: your_bearer_token
   ```
4. Run requests

---

**Last Updated**: 2024  
**API Version**: 1.0.0
