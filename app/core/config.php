<?php



if(strtolower($_SERVER["SERVER_NAME"]) == "localhost"){

    // the root directory for localhost
    define('ROOT', 'http://localhost:1234');

    // error reporting for development mode
    error_reporting(1);

    // database connection for localhost
    // $hostName = "localhost";
    // $userName = "root";
    // $dbPassword = "";
    // $dbName = "php_basic";

    // database variables
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_DATABASE', 'php_basic');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');

}



