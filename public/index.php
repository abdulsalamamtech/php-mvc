<?php

// Start session
session_start();

// Include initialization file
include_once "../app/core/init.php";

// Debugging mode
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);


$app = new App;
$app->loadController();


$page =  "HOMING";
show($page);







?>

