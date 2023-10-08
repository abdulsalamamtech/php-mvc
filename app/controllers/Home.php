<?php

// Home Controler
class Home{

    use Controller;

    public function index($a='', $b='', $c=''){

        $result = "@Index";

        show($result);
        show($a);
        show($b);
        show($c);

        $dis = new User;
        // $dis->update(10);
        // $dis->update(1, ['email'=>'amtech@gmail.com', 'password'=>'amtech@gmail.com']);
        // $dis->disable(10);
        // $dis->disable('10');
        $dis->disable(['email'=>'amtech<@gmail.com@gmail.com<>yy<>', 'password'=>'amtech@gmail.com']);

        // $this->view("index");

    }

    public function edit($a='', $b='', $c=''){

        $result = "@Edit";

        show($result);
        show($a);
        show($b);
        show($c);

        // $this->view("index");

    }

    public function users(){
        
    }

    // Testing
    public function test(){

        // 4,10
        // $user['id'] = 8;
        // $user['name'] = "Bala Muhammad";
        // $user['email'] = "balamuhammad@gmail.com";
        // $user['password'] = "1234";

        // $model = new User;
        // $result = $model->findAll();
        // $result = $model->where(['id'=> 15]);
        // $result = $model->insert($user);
        // $result = $model->delete($user);
        // $result = $model->delete(12);
        // $result = $model->update($user['email'], $user, 'email');
  
        // For error messages
        // $qs = $model->$db_status;
        // foreach($qs as $q => $s){
        //     echo "DB: " . $q . " == " . $s . "<br>";
        // }
    }

}

