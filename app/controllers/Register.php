<?php

echo "Register controler";
// Home Controler
class Register{

    use Controller;

    public function index(){

        $result = "From Register Index";
        show($result);


        // $data['id'] = 8;
        $data['name'] = "Bala Muhammad";
        // $data['email'] = "balamuhammad@gmail.com";
        $data['password'] = "1234";

        show($data);

        $user = new User;
        if($user->validate($data)){

            $user->insert($data);
            redirect('home');
        }

        $errors = $user->errors;
        show($errors);
        $this->view("errors", $errors);

    }


}

