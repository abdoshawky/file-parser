## Installation

Please follow these steps to install the projects:

- Clone the project.
- Navigate to the project directory.
- Run the following commands:
    - `cp .env.example .env` and update your database variables inside `.env` file.
    - `composer install`
    - `php artisan key:generate`.
    - `php artisan migrate --seed`.

## Demo
- Run the following command:
  - `php artisan serve`.
- Go to `localhost:8000/login`
- Use these credentials:
  - Email: `admin@email.com`
  - Password: `admin`

## Testing

Please Run the following commands to run the test cases:
- ``php artisan test``.