<?php

echo "Register controler";
// Home Controler
class Register{

    use Controller;

    public function index(){

        $result = "From Register Index";
        show($result);


        // $data['id'] = 8;
        $data['name'] = "Munir Muhammad";
        $data['email'] = "munirmuhammad@gmail.com";
        $data['password'] = "1234";

        show($data);

        $user = new User;
        if($data = $user->validate($data)){

            $user->insert($data);
            // redirect('home');

            echo "done...";
        }

        $errors = $user->errors;
        show($errors);
        // $this->view("errors", $errors);

    }

    public function profile(){
        $user = new User;
        $res = $user->first(['id'=>23]);
        show($res);

        $this->log($res);
        

    }



    public function log($id){

        $user = new User;

        $p = $user->login([
            'email' => $id['email'],
            'password' => "1234"
        ]);
        show($p);

        $errors = $user->errors;
        show($errors);
        $success = $user->success;
        show($success);
    }
}

