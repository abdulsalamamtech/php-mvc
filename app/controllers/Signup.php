<?php

// Home Controler
class Signup{

    use Controller;


    public function index(){

        $data['singnup']= $this->request->body();
        $resp = $this->response->response($data, 202);
        show($resp);


        $this->view("signup");
        
    }


}