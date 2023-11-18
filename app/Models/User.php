<?php


/**
 * User Model Class
 */

class User{

    use Model;
    protected $table = 'users';

    protected $allowedColumn = [
        'name',
        'email',
        'password',
    ];

    protected $unwantedResult = [
        'password',
        'date',
        'created_at',
        'updated_at',
    ];

    public function allowedData($data){
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

        // Name Validation
        if(empty($data['name'])){
            $this->errors['name'] = "name is required";
        }

        // Email Validation
        if(empty($data['email'])){
            $this->errors['email'] = "email is required";
        }else
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "email is not valid";
        }
        
        // Password Validation
        if(empty($data['password'])){
            $this->errors['password'] = "password is required";
        }elseif(strlen($data['password']) < 8){
            $this->errors['password'] = "password is too weak, it must be 8 character long";
        }
        
        if(empty($this->errors)){

            return $data;
        }

        return false;

    }

}
