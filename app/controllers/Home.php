<?php

// Home Controler
class Home{

    use Controller;

    public function index(){

        $result = "@Index Home";
        show($result);

        // Get the arguments pass into the function
        $fun_arguments = func_get_args();
        $arguments = $fun_arguments[0];
        
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

        show(__LINE__ ." " .$arguments. " page " .$page. " limit " .$limit);

        $model = new User;
        $model->limit = $limit;
        $model->offset = paginate($page, $limit);

        $res = $model->findAll();
        if(!is_array($res)){
            echo "No result <br>";
            $r = resp($res);
            show($r);
        }else{
            echo "Your result <br>";
            $r = resp($res);
            show($r);
        }


        // $this->view("index");

    }


}

