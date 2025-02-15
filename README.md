
# Translation API

This is a Laravel-based Translation API that provides authentication and translation management features. The API supports user registration, authentication, and operations like adding, updating, retrieving, searching, and exporting translations.

## Features
- User Registration & Login
- Authentication via Laravel Passport (Token-based Auth)
- CRUD operations for translations
- Searching translations with filters
- Exporting translations
- Secure API endpoints with middleware protection

## Installation
### Prerequisites
- PHP >= 8.0
- Composer
- Laravel
- MySQL or PostgreSQL

### Setup Instructions
1. **Clone the repository**
   ```sh
   git clone https://github.com/muhammadanees011/Translations.git
   cd your-repo
   ```

2. **Install dependencies**
   ```sh
   composer install
   ```

3. **Set up environment file**
   ```sh
   cp .env.example .env
   ```
   Configure your database settings in the `.env` file.

4. **Generate application key**
   ```sh
   php artisan key:generate
   ```

5. **Run migrations and seeders**
   ```sh
   php artisan migrate --seed
   ```

6. **Install Laravel Passport**
   ```sh
   php artisan passport:install
   ```

7. **Run the application**
   ```sh
   php artisan serve
   ```

## API Endpoints

### Authentication
| Method | Endpoint   | Description          |
|--------|-----------|----------------------|
| POST   | /register | Register a new user  |
| POST   | /login    | Authenticate user    |

### Translation Management
| Method | Endpoint                  | Description                         |
|--------|---------------------------|-------------------------------------|
| POST   | /translations             | Create a new translation           |
| PUT    | /translations/{id}        | Update an existing translation     |
| GET    | /translations/{id}        | Retrieve a single translation      |
| POST   | /translations/search      | Search translations with filters   |
| GET    | /export-translations      | Export all translations            |

## Authentication
All protected routes require authentication using Laravel Passport. After login, include the token in your request headers:

```sh
Authorization: Bearer {your_token}
```
### Register
Endpoint: `POST /register`

Example request body:
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

### Login
Endpoint: `POST /login`

Example request body:
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```
Response:
```json
{
    "token": "your-token-here",
}
```
Use this token in the `Authorization` header for protected endpoints.

## API Endpoints

### Create Translation
**Endpoint:** `POST /translations`

Example request body:
```json
{
    "locale": "en",
    "key": "Bye",
    "content": "Bye",
    "context": "web"
}
```

### Get Translation by ID
**Endpoint:** `GET /translations/{id}`

Example:
```sh
GET /translations/1
```

### Search Translations
**Endpoint:** `POST /translations/search`

Example request body:
```json
{
    "key": "Bye"
}
```

### Update Translation
**Endpoint:** `PUT /translations/{id}`

Example request body:
```json
{
    "key": "Bye",
    "content": "Bye"
}
```

### Export Translations
**Endpoint:** `GET /export-translations`

## License
This project is open-source and available under the MIT License.

