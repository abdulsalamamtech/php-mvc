<?php

// Start session
session_start();


// Include initialization file
include_once "../app/core/init.php";
// End of initialization


// Header 
include "layouts/header.php";
// End of header


// Initialize the app and load controller
$app = new App;
$app->loadController();


?>







<!-- Footer -->
<?php
    include "layouts/footer.php";
?>
<!-- End of footer -->