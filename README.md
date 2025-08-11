# Laravel Project

This is a Laravel application. Follow the instructions below to get it installed and running on your local machine.

---

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.3
- Composer
- MySQL

---

Demo demo/20250811-1940-58.7260279.mp4

## Installation Steps

### 1. Clone the repository

```bash
https://github.com/3103arsl/lastPay-test-project.git
cd lastPay-test-project

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

php artisan key:generate

php artisan migrate

php artisan migrate
