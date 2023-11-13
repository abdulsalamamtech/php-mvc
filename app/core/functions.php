<?php


// Show and display preformated value like
function show($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}
// show($_SERVER);


// Display result
function display($value){
    print_r($value);
}

// Pagination
function paginate($page=1, $limit= 10){
    $current_page = (int) isset($page)? $page : 1;
    $offset = (int) ($current_page -1) * (int) $limit;
    $offset = ceil(abs($offset));
    return $offset;
}


// Escape string
function esc($string){
    return htmlspecialchars($string);
}

// Return json formatted array
function toJson($value){
    return json_encode($value, JSON_PRETTY_PRINT);
}

// Return array formatted json
function toArray($value){
    return json_decode($value, true);
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
