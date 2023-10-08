<?php

// http://localhost:1234/storage/images/index.php?image=app-flutterwave-plan.jpeg

// Get the binary image data
$image_data = file_get_contents('../../../storage/images/'. $_GET['image']);


// Set the new image name
$new_image_name = 'new-image.png';

// Set the image header
header('Content-type: image/png');
header('Content-disposition: inline; filename=' . $new_image_name);


    // Display the image
    echo $image_data;

?>