<?php


// Show and display preformated value like
function show($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}
// show($_SERVER);


// Escape string
function esc($tring){
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
