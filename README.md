# Welcome to PHP Realtime Chat App MVC Model
Create a Chat Application using PHP MVC model with MySQL & JavaScript.

## This source structure is cloned from project: [`php-mvc-structure`](https://github.com/TanHongIT/php-mvc-structure)

# 1. Configuration requirements

    - Version PHP 7.2 and above
    - OpenSSL PHP Extension

# 2. Technology
- Pure PHP language
- Using MVC model
- Javascript

# 3. Setup assets folder

This Project is using webpack in order to compile Javascript modules and compile Sass/SCSS files to css. Run the following commands in the project's asset directory:

Run:

```shell
cd public/frontend/assets
npm install
npm run build
```

# 4. Download Database

This is the path to the database file for you to download: [`/database/***.sql`](https://github.com/TanHongIT/PHP_Realtime_Chat_App/tree/main/database)

Create a new database on **PHPMyAdmin** at your server (or any other database connection tool), then import the .sql file that you just downloaded.

# 5. Edit Connect Database

You need to change the connection information to the database after you have cloned my repository so that the website can work.

Path: [`/config/database.php`](https://github.com/TanHongIT/PHP_Realtime_Chat_App/tree/main/config)

This is the path to the database file for you to download: [`/database/***.sql`](https://github.com/TanHongIT/PHP_Realtime_Chat_App/tree/main/database)

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'chatapp-php');
```

And then run to import database

```shell
 mysql -u root -p chatapp-php < YOUR-PATH/PHP_Realtime_Chat_App/database/chatapp-php.sql 
```
Please change **YOUR-PATH** to your project's path.

<p align="center">
     <img src="https://img.shields.io/packagist/l/doctrine/orm.svg" data-origin="https://img.shields.io/packagist/l/doctrine/orm.svg" alt="license">
</p>
