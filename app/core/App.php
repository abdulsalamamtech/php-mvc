<?php

/**
 * App Core Class
 */
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

        // checking for the access for the quest, user and admin
        function URL_ACCESS($url){
            // if the url is not for api call
            if($url != 'api'){
                $Auth = new Auth();
                if(Auth::$access == 'quest'){
                    $Auth->check($url, $Auth->quest());
                }elseif(Auth::$access == 'user'){
                    $Auth->check($url, $Auth->user());
                }elseif(Auth::$access == 'admin'){
                    $Auth->check($url, $Auth->admin());
                }else{
                    Auth::$access = 'quest';
                }
            }
        }

        // Split the URL into arrays
        $URL = $this->splitUrl();
        // Get the contoller file name
        $file_name = "../app/controllers/" . ucfirst($URL[0]) . ".php";

        // Uncomment to check the url
        // show($URL);

        
        // Checking for controller as the first element in the array
        if(file_exists($file_name)){

            // check if the user can access the controller page
            URL_ACCESS($URL[0]);

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
                
                // check if the user can access the controller page
                URL_ACCESS($URL[1]);

                // Set the method
                $this->method = $URL[1];
                // Remove the method from the URL array
                unset($URL[1]);
            }
        }

        // Uncomment to check the url
        // show($URL);

        // Setting and initializing the controller class
        $controller = new $this->controller;

        // Calling a callback with an array of parameters 
        // and sending the remaining variable in the URL as arguments
        // as arguments for the method
        call_user_func_array([$controller, $this->method], [$URL]);

    }

}