<?php


// Show and display preformated value like
function show($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}
// show($_SERVER);

// Escape string
function esc($string){
    return htmlspecialchars($string);
}

// Return json formatted array
function json($value){
    return json_encode($value, JSON_PRETTY_PRINT);
}

// Return array formatted json
function html($value){
    return json_decode($value);
}

// Redirect function
function redirect($path){
    header('Location:' . ROOT . '/' . $path);
    die();
}

// Load Binary Image
function binToImage($file){
    $base64 = base64_encode($file);
    return ('data:'.'image/png'.';base64,'.$base64);
}

// Load Binary Video
function binToVideo($file){
    $base64 = base64_encode($file);
    return ('data:'.'video/mp4'.';base64,'.$base64);
}
