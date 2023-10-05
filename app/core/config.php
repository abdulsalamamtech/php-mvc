<?php

// Application Name
define('APP_NAME', 'MVC USERS');
define('APP_DESC', 'Best MVC website');
define('DEBUG', false);

if(strtolower($_SERVER["SERVER_NAME"]) == "localhost"){

    // the root directory for localhost
    define('ROOT', 'http://localhost:1234');

    // error reporting for development mode
    error_reporting(DEBUG);

    // database connection for localhost
    // database variables
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_DATABASE', 'php_basic');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');

}



