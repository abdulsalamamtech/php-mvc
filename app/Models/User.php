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
    ];

}
