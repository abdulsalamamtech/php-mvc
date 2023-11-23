<?php   

/**
 * Respose Core Class
 */

class Response{

    // Response
    public function response($data = array(), $status = 400, $message = null){

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

}


/*

$status[
    '100'=>'information',
    '101'=>'information',
    '401'=>'unauthorized',
];

*/
