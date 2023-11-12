<?php

Trait Controller{

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