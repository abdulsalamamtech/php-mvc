<?php

class Home extends Controller{
    public function index($a){
        // 4,10
        // $user['id'] = 8;
        $user['name'] = "Bala Muhammad";
        $user['email'] = "balamuhammad@gmail.com";
        $user['password'] = "1234";

        $model = new User;
        // $result = $model->where(['name'=> 'Abdulsalam Abdulrahman'], ['email'=> 'abdulsalam@gmail.com']);
        $result = $model->insert($user);
        // $result = $model->delete($user);
        // $result = $model->delete(12);
        // $result = $model->update($user['email'], $user, 'email');
        if($result){
            echo "Query sucessfull";
        }
        show($result);


        // For error messages
        $qs = $model->$db_status;
        foreach($qs as $q => $s){
            echo "DB: " . $q . " == " . $s . "<br>";
        }

        echo "Home controller";

        $this->view("index");
    }
}
