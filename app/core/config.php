<?php

/**
 * Config Core File
 */

// Application Name
define('APP_NAME', 'MVC USERS');

// Application Description
define('APP_DESC', 'Best MVC website');

// Website Origin 
define('APP_ORIGIN', 'https://bit.ly/abdulsalamamtech');

// Debugging Mode
define('DEBUG', false);

// Local Development Configurations
if(strtolower($_SERVER["SERVER_NAME"]) == "localhost"){

    // the root directory for localhost
    define('ROOT', 'http://localhost:1234');
    
    // Debugging mode
    DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

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
