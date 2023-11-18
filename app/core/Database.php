<?php

/**
 * Database Trait
 */

// Assume we have a database connection established
Trait Database
{

    // Save the status of the database query
    private static $db_status = [];

    // Return the Database status
    public static function DB_STATUS() {
        return self::$db_status;
    }


    // Save the last insert id
    private static $last_insert_id;

    // Return the last inserted id
    public function last_insert_id(){
        return self::$last_insert_id;
    }
    

    // Main connection to database
    private function connect()
    {
        $DB_STR = "mysql:host=".DB_HOST.";dbname=". DB_DATABASE;
        $DB = new PDO($DB_STR, DB_USERNAME, DB_PASSWORD);

        return $DB;
    }

    // Main query to database
    public function query($query, $data = [])
    {
        $conn = $this->connect();

        // Prepare the statement
        $stmt = $conn->prepare($query);

        // Execute the query and bind parameters if available
        $check = $stmt->execute($data);

        
        // $check->last_insert_id = $conn->lastInsertId();
        
        // Check the query
        if($check){
            
            // Get the last inserted id
            self::$last_insert_id = $conn->lastInsertId();
            // Get information from database
            $msg['query_time'] =  date('Y-M-d D i:s a');
            $msg['query_string'] =  $stmt->queryString;
            $msg['affected_row'] =  $stmt->rowCount();
            $msg['affected_id'] =  $conn->lastInsertId();
            $msg['error_code'] =  $stmt->errorCode();
            $msg['error_info'] =  $stmt->errorInfo();
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


}

