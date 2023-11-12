<?php

// Home Controler
class Home{

    use Controller;

    public function index(){

        $result = "@Index";
        show($result);

        // Get the arguments pass into the function
        $fun_arguments = func_get_args();
        $arguments = $fun_arguments[0];

        // Convert the first argument to string
        // check the result of the id in database
        if($arguments[1] !== 'page' && $arguments > 0){
            // Process and show the result of the id
            $result = $this->show((int) $arguments[1]);
            show($result);
            exit;
        }

        if(is_string($arguments[1])){
            // Getting the page and limit from the url for /page/1/limit/10
            if($arguments[1] == 'page' && $arguments[2] > 0)
            {
                // for /page/1/limit/10
                $page = (int) $arguments[2] ?? 1;

                // for /page/1/limit/10
                if($arguments[3] == 'limit' && $arguments[4] > 0)
                {
                    $limit = (int) $arguments[4] ?? 10;

                }

            }elseif($arguments[1] == 'limit' && $arguments[1] > 0)
            {
                // for /limit/10
                $limit = (int) $arguments[2] ?? 10;

            }

        }
        
        $model = new User;
        $model->limit = $limit;
        $model->offset = paginate($page, $limit);

        $res = $model->findAll();
        if(!is_array($res)){
            echo "No result <br>";
            $r = response($res);
            show($r);
        }else{
            echo "Your result <br>";
            $r = response($res);
            show($r);
        }

        $ss = new Session;
        $ss->set("user", $r);
        show($ss->get("user"));

        // $this->view("index");

    }


    // Reading and geting a data from batabase
    public function show(int $id){
       $model = new User;
       $result = $model->first(['id'=> $id]);
       return $result;
    }

    public function edit($a='', $b='', $c=''){

        $result = "@Edit";

        show($result);
        show($a);
        show($b);
        show($c);

        // $this->view("index");

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

