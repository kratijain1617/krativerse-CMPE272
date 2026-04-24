# Lab: User Creation and Search (MySQL)

## What Was Added
- `users.php` - Users section page with links to forms
- `user_create.php` - Create user form
- `user_search.php` - Search users form (name/email/phones)
- `includes/mysql_users_db.php` - MySQL PDO connection
- `config/mysql_config.php` - DB credentials
- `sql/users_schema_seed.sql` - schema + 20 seeded users

## Step-by-Step Setup

1. Install and start MySQL (XAMPP/WAMP/MySQL Server).
2. Open MySQL client and run:
   - `SOURCE c:/Users/krati/Downloads/SJSU/Courses-SEM1/CMPE-272/krativerse-CMPE272/sql/users_schema_seed.sql;`
3. Update DB credentials in `config/mysql_config.php`.
4. Start PHP server from project root:
   - `php -S localhost:8000`
5. Open:
   - `http://localhost:8000/users.php`
   - `http://localhost:8000/user_create.php`
   - `http://localhost:8000/user_search.php`

## Submission Items
- Company website link
- PHP files:
  - `users.php`
  - `user_create.php`
  - `user_search.php`
  - `includes/mysql_users_db.php`
  - `config/mysql_config.php`
- SQL file:
  - `sql/users_schema_seed.sql`

