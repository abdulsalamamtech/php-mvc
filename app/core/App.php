<?php

// show($_SERVER);
// show(date("U"));
// show(time());
// show(ROOT);

class App{

    private $controller = "home";
    private $method = "index";

    private function splitUrl(){
        // get request url if empty load home
        $path = !trim($_SERVER['REQUEST_URI'], "/")
            ? "home"
            :trim($_SERVER['REQUEST_URI'], "/");
        return explode("/", $path);
    }

    public function loadController(){

        $url = $this->splitUrl();
        $file_name = "../app/controllers/" . ucfirst($url[0]) . ".php";

        if(file_exists($file_name)){
            include_once $file_name;
            $this->controller = ucfirst($url[0]);

        }else{

            include_once "../app/controllers/_404.php";
            $this->controller = "_404";

        }

        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], [$a="..."]);
    }

}