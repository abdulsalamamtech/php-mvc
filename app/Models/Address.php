<?php


/**
 * User Model Class
 */

class Address{

    use Model;
    protected $table = 'address';

    protected $allowedColumn = [
        'street_no',
        'lga',
        'state',
        'country',
    ];

    protected $unwantedResult = [
        'created_at',
        'updated_at',
    ];

}
