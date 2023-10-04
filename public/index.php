<?php
session_start();

include_once "../app/core/init.php";

function show($val){
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}
// show($_SERVER);

$app = new App;
$app->loadController();


$page =  "HOMING";
show($page);







?>

