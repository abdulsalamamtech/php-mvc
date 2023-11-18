<?php


/**
 * Api Model Class
 */

class ApiAccess{

    use Model;
    protected $table = 'api_token';

    protected $allowedColumn = [
        // 'admin_id',
        // 'token',
    ];

    protected $unwantedResult = [
        'hash_token',
        'created_at',
        'updated_at'
    ];

    public function allowedColumn($data){
        foreach($data as $key => $value){
            if(!in_array($key, $this->allowedColumn)){
                unset($data[$key]);
            }
        }
        return $data;
    }

    public function unwantedResult($data){
        foreach($data as $key => $value){
            if(in_array($key, $this->unwantedResult)){
                unset($data[$key]);
            }
        }
        return $data;
    }


    public function validate($data){
        $this->errors = [];

        // Admin_id Validation
        if(empty($data['admin_id'])){
            $this->errors['admin_id'] = "admin_id is required";
        }


        // you can remove this later
        // Token Validation
        if(empty($data['token'])){
            $this->errors['token'] = "token is required";
        }
        
        if(empty($this->errors)){

            return $data;
        }

        return false;

    }


}
