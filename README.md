# 🛒 Laravel 12 API: Orders, Categories, Products

This is a Laravel 12 API backend for managing users, orders, categories, and products.  
It uses **PostgreSQL** as the database and includes basic **authentication via Laravel Sanctum**.

---

## 🚀 Features

- Laravel 12 (PHP 8.4+)
- PostgreSQL database
- User registration & login via API
- Token-based authentication with Laravel Sanctum
- Orders: Create and view your own orders
- Seeders for categories, products, and test user
- Ready-to-use **Postman Collection**

---

## 📦 Requirements

- PHP >= 8.4
- Composer
- PostgreSQL

---

## ⚙️ Installation Steps

1. **Clone the project**

```bash
git clone <repo-url>
cd <project-directory>
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Set up environment file**

```bash
cp .env.example .env
```
Edit ```.env``` and set your PostgreSQL database settings:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. **Generate app key**

```bash
php artisan key:generate
```


5. **Run migrations and seeders**

```bash
php artisan migrate --seed
```

This will run the following seeders:

- CategorySeeder – seeds product categories

- ProductSeeder – seeds products

- UserSeeder – creates a test user:

- Mobile: +79006554129

- Password: 123456

6. **Running Tests**

```bash
php artisan test
```

## Postman Collection
A Postman collection is included in the project directory:
```postman_collection.json```

