<?php

/**
 * Contoller Trait
 */
Trait Controller{

    // The Request
    public $request;
    // The Response
    public $response;

    
    public function __construct(){
        // Initialize the Request
        $this->request = new Request();
        // Initialize the Response
        $this->response = new Response();
    }

    public function view($name, $data = []){

        // Extract the data pass into the view
        if(!empty($data)){
            extract($data);
        }

        $file_name = "../app/views/" . $name . ".view.php";
        if(file_exists($file_name)){
            include_once $file_name;
        }else{
            // Handle 404 not found
            http_response_code(404);
            include_once "../app/views/404.view.php";
            exit();

        }
    }
    
}