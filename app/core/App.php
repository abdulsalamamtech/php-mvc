<?php

// show($_SERVER);
// show(date("U"));
// show(time());
// show(ROOT);

class App{

    private $controller = "home";
    private $method = "index";

    // Split the request uri
    private function splitUrl(){
        // get request url if empty load home
        $path = !trim($_SERVER['REQUEST_URI'], "/")
            ? "home"
            :trim($_SERVER['REQUEST_URI'], "/");
        return explode("/", $path);
    }

    // Loading Controller
    public function loadController(){

        // Split the URL int arrays
        $URL = $this->splitUrl();
        // Get the contoller file name
        $file_name = "../app/controllers/" . ucfirst($URL[0]) . ".php";

        show($URL);

        // Checking for controller as the first element in the array
        if(file_exists($file_name)){
            include_once $file_name;
            // Set the controller
            $this->controller = ucfirst($URL[0]);
            // Remove the controller from the URL array
            unset($URL[0]);
        }else{
            include_once "../app/controllers/_404.php";
            $this->controller = "_404";
        }

        // Checking for method as the secord element in the array
        if(!empty($URL[1])){
            // check if the method exist in the controller class
            if(method_exists($this->controller, $URL[1])){
                // Set the method
                $this->method = $URL[1];
                // Remove the method from the URL array
                unset($URL[1]);
            }
        }

        show($URL);
        

        // Setting and initializing the controller class
        $controller = new $this->controller;

        // Calling a callback with an array of parameters 
        // and sending the remaining variable in the URL as arguments
        // as arguments for the method
        call_user_func_array([$controller, $this->method], [$URL]);

    }

}