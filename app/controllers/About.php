<?php

// Home Controler
class About{

    use Controller;

    public function index($a='', $b='', $c=''){

        $result = "From Index";

        show($result);
        $this->view("about");

    }

    public function edit($a='', $b='', $c=''){

        $result = "From Edit";

        show($result);
        $this->view("about");

    }


}

