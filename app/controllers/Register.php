<?php

echo "Register controler";
// Home Controler
class Register{

    use Controller;

    public function index($a='', $b='', $c=''){

        $result = "From Register Index";

        // $data['id'] = 8;
        // $data['name'] = "Bala Muhammad";
        // $data['email'] = "balamuhammad@gmail.com";
        $data['email'] = "balamuhammad";
        $data['password'] = "1234";

        show($data);

        $user = new User;
        if($user->validate($data)){

            $user->insert($data);
            redirect('home');
        }

        $errors = $user->errors;
        show($errors);
        show($result);
        $this->view("about");

    }


}

