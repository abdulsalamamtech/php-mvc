<?php

// Controller Not Found
class _404{
    use Controller;

    public function index($a){

        $this->view("404");
    }
}


