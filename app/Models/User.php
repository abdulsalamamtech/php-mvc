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

    protected $unwantedResult = [
        'created_at',
        'updated_at',
    ];

}
