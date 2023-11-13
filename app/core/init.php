<?php

// Autoload class, pass in any variable to the function to serve as the class name
spl_autoload_register(function($classname){
    $filename = "../app/models/" . ucfirst($classname) . ".php";
    if(file_exists($filename)){
        require $filename;
    }
});

// Reguire all necessry file acording to hierarchy
require "config.php";
require "Session.php";
require "functions.php";
require "Request.php";
require "Response.php";
require "Database.php";
require "Model.php";
require "Controller.php";
require "App.php";

