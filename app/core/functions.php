<?php

/**
 * Function Core File
 */

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
function paginate($page = 1, $limit= 10){
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


// Response
function resp($data = array(), $status = 400, $message = null){

    $success = "false";

    if($status < 100){
        $message = $message ?? 'unknown errro';
    }
    elseif($status <= 199){
        $message = $message ?? 'processing information';
    }
    elseif($status <= 299){
        $message = $message ?? 'successfull';
        $success = "true";
    }
    elseif($status <= 399){
        $message = $message ?? 'redirecting';
    }elseif($status <= 499){
        $message = $message ?? 'not found';
    }elseif($status <= 599){
        $message = $message ?? 'server error';
    }else{
        $message = 'error';
    }

    http_response_code($status);
    $response['status'] = $status;
    $response['success'] = $success;
    $response['message'] = $message;
    $response['data'] = $data ?? [];
    return toJson($response);
}
