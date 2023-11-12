<?php

// Home Controler
class Home{

    use Controller;

    // Geting all the data from database
    public function index($page='page', $page_no='1', $limit='', $limit_no='10'){

        // users/page/2/limit/10
        // $page page variable
        // $page_no page number
        // $limit limit variable
        // $limit_no limit number

        $model = new User;
        $ml = $model->limit;
        echo($ml);
        $res = $model->findAll();
        show($res);

        // $this->view("index");

    }

    // Creating and saving data to batabase
    public function create(){
        
        
    }

    // Reading and geting a data from batabase
    public function show(){


    }

    // Updating and editing data in batabase
    public function update(){


    }

    // Deleting data to batabase
    public function delete(){


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

