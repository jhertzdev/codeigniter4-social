# CodeIgniter 4 Social Auth with HybridAuth

This is a boilerplate application built with CodeIgniter 4, featuring a complete authentication system powered by Shield and multi-provider social login integration via HybridAuth.

## Table of Contents
- [Getting Started](#getting-started)
- [Prerequisites](#prerequisites)
- [Configuration](#configuration)
- [Installation](#installation)
- [Usage](#usage)
- [License](#license)

---

## Getting Started
This project provides a boilerplate for CodeIgniter 4 applications that require robust authentication and easy social login integration.

### Prerequisites
To run this project, you will need:
- **PHP 8.2 or higher**
- **MySQL or MariaDB**
- **Composer**
- **PHP Extensions**:
    - `intl`
    - `mbstring`
    - `curl`
    - `json`
    - `mysqli` or your preferred DB driver

---

## Configuration

> [!IMPORTANT]
> You must complete the database configuration in your `.env` file before attempting to run migrations.

### 1. Database & Base URL
After creating your `.env` file from the example, configure your database settings and the `app.baseURL`:
```ini
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = your-db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 2. Social Login (OAuth)
Configure your client IDs and secrets for Google and GitHub in `app/Config/HybridAuth.php`:
```php
// app/Config/HybridAuth.php
'Google' => [
    'keys' => [
        'key'    => 'YOUR_GOOGLE_CLIENT_ID',
        'secret' => 'YOUR_GOOGLE_CLIENT_SECRET',
    ],
],
```

---

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/jhertzdev/codeigniter4-social.git
   cd codeigniter4-social
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up Environment**:
   Copy the example file to create your own `.env` file and **apply the configuration** mentioned above:
   ```bash
   cp .env.example .env
   ```

4. **Run Migrations**:
   Once your database is configured, set up the tables:
   ```bash
   php spark migrate
   ```

---

## Usage

### Run the development server
```bash
php spark serve
```

### Authentication Routes
- **Login**: `/login`
- **Registration**: `/register`
- **Google Login**: `/auth/login/google`
- **GitHub Login**: `/auth/login/github`

---

## License
Distributed under the MIT License. See `LICENSE` for more information.

## Contact
Project Link: [https://github.com/jhertzdev/codeigniter4-social](https://github.com/jhertzdev/codeigniter4-social)