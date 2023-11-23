<?php


// show($_SERVER);
// show(date("U"));
// show(time());
// show(ROOT);


// Include initialization files
include_once "../app/core/init.php";
// End of initialization


// #1# Display the auth user
show(Auth::showAuth());

// Header 
// include "layouts/header.php";
// End of header
echo "<br>##########################################################<br>";

// Initialize the app and load controller
$app = new App;
$app->loadController();
// End of Initialize the app and load controller

echo "<br>##########################################################<br>";
// Footer
// include "layouts/footer.php";
// End of Footer



// #2# Display the auth user
show(Auth::showAuth());



?>

