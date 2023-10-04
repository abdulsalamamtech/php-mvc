<?php

/**
 * Database Trait
 */

// Assume we have a database connection established
Trait Database
{

    public static $db_status = [];

    // Main connection to database
    private function connect()
    {
        $db_str = "mysql:host=".DB_HOST.";dbname=". DB_DATABASE;
        $db = new PDO($db_str, DB_USERNAME, DB_PASSWORD);

        return $db;
    }

    // Main query to database
    public function query($query, $data = [])
    {
        $conn = $this->connect(); 

        // Prepare the statement
        $stmt = $conn->prepare($query);

        // Execute the query and bind parameters if available
        $check = $stmt->execute($data); 

        
        // Check the query
        if($check){

            $msg = [];
            $msg['affected_row'] =  $stmt->rowCount();
            $msg['query_string'] =  $stmt->queryString;
            $msg['error_code'] =  $stmt->errorCode();
            $msg['error_info'] =  $stmt->errorInfo();
            $msg['query_time'] =  date('Y-M-D i:s a');
            self::$db_status = $msg;

            if($result = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                if (is_array($result) && count($result)) {
                    return $result;
                }
            }

            return true;

        }
        return false;
    }

    // Testing query
    public function test()
    {

        $query = "SELECT * FROM users";
        $users = $this->query($query);
        show($users);
    }

}

