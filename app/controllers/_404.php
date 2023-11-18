<?php

// Controller Not Found
class _404{
    use Controller;

    public function index($a){

        $resp = resp([], "404", "page not found");
        echo($resp);
        // $this->view("404");
        // exit();
    }
}


