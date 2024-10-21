# E-commerce API (Laravel 10)

This is a simplified RESTful API for managing `Products` and `Orders` in a small e-commerce system built with Laravel 10.

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL or any other supported database
- Laravel 10

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/Abdelrahman20180315/Backend-Task-Izam-company.git
cd izam_task

2. Install dependencies
Run the following command to install the necessary dependencies:
composer install

3. Configure environment variables
Copy the .env.example file to .env and configure your database and other environment settings:
cp .env.example .env

Update the following lines in the .env file with your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=

4. Generate application key
Run this command to generate a new application key:
php artisan key:generate

5. Run database migrations
Execute the following command to create the necessary tables in your database:
php artisan migrate

6. Seed the database (optional)
If you want to create some dummy data, you can use database seeders. First, create seeders and then run:
php artisan db:seed

7. Run the development server
Run the following command to start the development server:
php artisan serve

Your application will be accessible at http://127.0.0.1:8000.

API Endpoints
Authentication
This project uses Laravel Sanctum for API authentication. After creating a user, you can obtain a token by logging in and using it to authenticate requests.

Products
GET /api/products: Retrieve a list of products (with pagination, name search, and price filtering).
Query parameters:
name: Filter products by name.
min_price: Filter products by minimum price.
max_price: Filter products by maximum price.
page: Specify the page for pagination.
Example:
GET /api/products?name=apple&min_price=100&max_price=500&page=1

Orders
POST /api/orders: Create a new order (requires authentication).

Request body:
{
  "products": [
    { "id": 1, "quantity": 2 },
    { "id": 3, "quantity": 1 }
  ]
}

GET /api/orders/{id}: Retrieve details of a specific order (requires authentication).


Events and Caching
The OrderPlaced event is triggered when an order is placed, and an email notification is sent to the admin (event simulation, no real email is sent).
The GET /products endpoint uses caching for performance optimization (caches products for 10 minutes).

Running Tests
To run the unit and feature tests, use the following command:
php artisan test


License

This project is open-sourced software licensed under the MIT license.
(https://opensource.org/licenses/MIT).
