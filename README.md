# EasyBill Payments System API

A RESTful API built using Laravel for managing users and transactions in a simple bill payment system.

## Features

- **Users**: Full CRUD operations for managing users.
- **Transactions**: Full CRUD operations for managing transactions linked to users.
- **Database Relationships**: Proper relationships between users and transactions using Laravel Eloquent.
- **API Responses**: API responses are handled using Laravel's Eloquent API Resources.
- **Validation**: Input data is validated for all operations.
- **Unit Testing**: Comprehensive unit tests for API endpoints.

---

## Installation and Setup

### Prerequisites

Ensure you have the following installed on your system:
- PHP >= 8.0
- Composer
- MySQL
- Laravel CLI

### Steps

1. Clone the repository:
   ```bash
   git clone <your-repository-url>
   cd easybill_test_payment_system
   ```

2. Install dependencies:
    composer install
3. Set up the .env file:
    Copy .env.example to .env
     ```bash
        cp .env.example .env
    ```

4. Update database credentials in the .env file
   ```bash
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=bill_payments
        DB_USERNAME=root
        DB_PASSWORD=your_password
    ```

5. Generate the application key:
   php artisan key:generate

6. Start the development server:
    ```bash
        php artisan serve
    ```
    The application will be available at http://127.0.0.1:8000.

## API Endpoints

### Base URL
`http://127.0.0.1:8000/api`

### Users Endpoints

| Method | Endpoint         | Description                     |
|--------|-------------------|---------------------------------|
| GET    | `/users`          | List all users                 |
| POST   | `/users`          | Create a new user              |
| GET    | `/users/{id}`     | Retrieve a specific user       |
| PUT    | `/users/{id}`     | Update a specific user         |
| DELETE | `/users/{id}`     | Delete a specific user         |

### Transactions Endpoints

| Method | Endpoint             | Description                       |
|--------|-----------------------|-----------------------------------|
| GET    | `/transactions`       | List all transactions            |
| POST   | `/transactions`       | Create a new transaction          |
| GET    | `/transactions/{id}`  | Retrieve a specific transaction   |
| PUT    | `/transactions/{id}`  | Update a specific transaction     |
| DELETE | `/transactions/{id}`  | Delete a specific transaction     |

---

## Testing

### Run Unit Tests
    To execute the unit tests for the API endpoints, run the following command in your terminal:
```bash
    php artisan test
```

Ensure that you have set up the test database in the .env file before running the tests:
```bash
    DB_DATABASE_TEST=bill_payments_test
```


## Postman Documentation
    The Postman collection for the API is available here:  https://documenter.getpostman.com/view/15714523/2sAYBSkYvJ
