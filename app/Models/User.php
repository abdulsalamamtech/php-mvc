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
        'created_at',
        'updated_at',
    ];


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
        }
        
        // if(empty($this->errors){
        //     return true;
        // }

        return false;

    }

}
