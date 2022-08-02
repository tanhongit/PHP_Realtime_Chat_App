# Welcome to PHP Realtime Chat App MVC Model by TanHongIT
Create a Chat Application using PHP MVC model with MySQL & JavaScript.

## This source structure is cloned from project: [`yl-mvc-structure`](https://github.com/TanHongIT/yl-mvc-structure)

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

# 6. Install and using ssl certificate
Using mkcert to create ssl certificate

### For Ubuntu

```shell
sudo apt install libnss3-tools

sudo wget https://github.com/FiloSottile/mkcert/releases/download/v1.4.3/mkcert-v1.4.3-linux-amd64 && \
sudo mv mkcert-v1.4.3-linux-amd64 mkcert && \
sudo chmod +x mkcert && \
sudo cp mkcert /usr/local/bin/
```

Now that the mkcert utility is installed, run the command below to generate and install your local CA:

```shell
mkcert -install
```

### Create ssl certificate for this project

Run:

```shell
cd /var/www/certs
mkcert local.php_realtime_chat_app.com
```

And then change **local.PHP_Realtime_Chat_App.com.conf** file (/apache2/sites-available/ to this)

```
<VirtualHost *:80>
	ServerAdmin localserver@localhost
	ServerName local.PHP_Realtime_Chat_App.com
	ServerAlias www.PHP_Realtime_Chat_App.vdx.com
	DocumentRoot /var/www/PHP_Realtime_Chat_App
	ErrorLog /var/www/logs/error-PHP_Realtime_Chat_App.log
    CustomLog /var/www/logs/access-PHP_Realtime_Chat_App.log combined
</VirtualHost>

<VirtualHost *:443>
    ServerAdmin localserver@localhost
    ServerName local.PHP_Realtime_Chat_App.com
    ServerAlias www.local.PHP_Realtime_Chat_App.com
    DocumentRoot /var/www/PHP_Realtime_Chat_App

    ErrorLog /var/www/logs/error-PHP_Realtime_Chat_App.log
    CustomLog /var/www/logs/access-PHP_Realtime_Chat_App.log combined

    SSLEngine on
	SSLCertificateFile /var/www/certs/local.PHP_Realtime_Chat_App.com.pem
	SSLCertificateKeyFile /var/www/certs/local.PHP_Realtime_Chat_App.com-key.pem

    <Directory /var/www/PHP_Realtime_Chat_App>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

# 7. Demo

<p align="center">
     <img src="https://user-images.githubusercontent.com/35853002/177470807-57f9b578-efcb-4e2d-8510-8942bc06f297.png" alt="license">
</p>

Demo account:

```
Email: test4@exam.com.vn
Pass: 123456
```

<p align="center">
     <img src="https://img.shields.io/packagist/l/doctrine/orm.svg" data-origin="https://img.shields.io/packagist/l/doctrine/orm.svg" alt="license">
</p>
