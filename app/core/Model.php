<?php

/**
 * Main Model Trait
 */

// Advice when creating your table add the following column
// id, status, updated_at created_at

Trait Model
{
    use Database;

    protected string $order_column = 'id';
    protected string $order_type = 'DESC';
    protected int $limit = 10;
    protected int $offset = 0;

    public array $errors = [];

    /**
     * Summary of removeUnwantedColumns
     * Removing unwanted data or columns before sending it to database
     * filter from the allowed column class
     * @param mixed $data
     * @return void
     */
    protected function removeUnwantedColumns($data){

        if(!empty($this->allowedColumn)){
            foreach($data as $key => $value){
                if(!in_array($key, $this->allowedColumn)){
                    unset($data[$key]);
                }
                
                $data = [$key => esc($value)];
            }
        }
    }


    /**
     * Summary of findAll
     * Get all data from database
     * @return array|bool
     */
    public function findAll()
    {
        // Select all the data from database
        $query = "SELECT * FROM $this->table";        
        $query = trim($query, " && ");
        // ORDER BY id DESC LIMIT 10 OFFSET 0
        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        return $this->query($query);

    }


    /**
     * Get the first row in database
     * Select all data from database where data ='' and != ''
     * @param array $data
     * @param array $data_not
     * @return mixed
     * return the first data from the result
     */
    public function first(array $data, array $data_not)
    {
        // Select all data from database where data ='' and != ''
        $query = "SELECT * FROM $this->table WHERE ";

        $keys = array_keys($data);
        foreach($keys as $key){
            $query .= $key . " =:" . $key . " && ";
        }
         
        $keys_not = array_keys($data_not);
        foreach($keys_not as $key){
            $query .= $key . " !=:" . $key . " && ";
        }
        
        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        $result =  $this->query($query, $data);
        // return the first data from the result
        return ($result)?  $result[0] : false;

    }


    /**
     * Get specific data from database
     * Select all data from database where data ='' and != ''
     * @param array $data
     * @param array $data_not
     * @return array|bool
     */
    public function where(array $data, array $data_not = []) 
    {
        // Select all data from database where data ='' and != ''
        $query = "SELECT * FROM $this->table WHERE ";


        $keys = array_keys($data);
        foreach($keys as $key){
            $query .= $key . " =:" . $key . " && ";
        }
         
        $keys_not = array_keys($data_not);
        foreach($keys_not as $key){
            $query .= $key . " !=:" . $key . " && ";
        }
        
        $query = trim($query, " && ");
        // ORDER BY id DESC LIMIT 10 OFFSET 0
        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);

    }


    /**
     * Insert data into database
     * Removes unwanted data before sending it to database
     * @param array $data
     * @return bool true|false
     */
    public function insert(array $data)
    {

        // Removing unwanted data before sending it to database
        $this->removeUnwantedColumns($data);

        $keys = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $this->table ($keys) VALUES ($values)";

        $result =  $this->query($query, $data);

        return ($result)?  true : false;

    }


    /**
     * Summary of update
     * Updating a row in database
     * update(1, ['name'=> 'abdulsalam','email'=> 'abdulsalamamtech@gmail.com']);
     * UPDATE users SET name =:name, email =:email WHERE id = :id
     * update('abdulsalam', ['email'=> 'abdulsalamamtech@gmail.com'], 'name');
     * UPDATE users SET email =:email WHERE name = :name
     * @param int $id
     * @param array $data
     * @param string $id_column
     * @return bool true|false
     */
    public function update(int $id, array $data, string $id_column = 'id')
    {

        // Removing unwanted data before sending it to database
        $this->removeUnwantedColumns($data);

        $query = "UPDATE $this->table SET ";

        $keys = array_keys($data);
        foreach($keys as $key){
            $query .= $key . " =:" . $key . ", ";
        }

        $data[$id_column] = $id;
        $query = trim($query, ", ");
        $query .= " WHERE $id_column = :$id_column limit 1";

        show($query);
        show($data);

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

    }


    public function disable($data = null, $data_not = [])
    {
        // disable the column
        $status['status'] = 0;

        // Removing unwanted data before sending it to database
        $this->removeUnwantedColumns($data);
        echo __LINE__ . show($data);


        $query = "UPDATE $this->table SET ";
        $query .= " status =:status WHERE ";

        // Check if the data is integer
        if(is_int($data) && !empty($data)){
            echo "<br> is int and not empty <br>";
            $query .= " id =:id";

        // Check if the data is array
        }elseif(is_array($data) && !empty($data)){
            echo "<br> is array and not empty <br>";
            $keys = array_keys($data);
            foreach($keys as $key){
                $query .= $key . " =:" . $key . " && ";
            }

            $keys_not = array_keys($data_not);
            foreach($keys_not as $key){
                $query .= $key . " !=:" . $key . " && ";
            }

        }else{
            return false;
        }
        
        $query = trim($query, " && ");
        $query .= " limit 1";

        // bind the status variable
        $data['status'] = $status['status'];


        show($query);
        show($data);

        // $result =  $this->query($query, $data);
        // return ($result)?  true : false;

    }


    /**
     * Summary of delete
     * This query delete only a single row by satisfying one condition
     * @param int|string $id
     * @param string $id_column if they is alternate name for the column
     * @return bool true|false
     */
    public function delete(int|string $id, string $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column limit 1";

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

    }

    
    
    /**
     * Summary of delete_multiple
     * This satisfy all condition before deleting any row
     * DELETE FROM users WHERE name =:name && email =:email && password =:password
     * @param array $data
     * @param array $data_not
     * @return bool true|false
     */
    public function delete_multiple(array $data, array $data_not = [])
    {
        $query = "DELETE FROM $this->table WHERE ";

        $keys = array_keys($data);
        foreach($keys as $key){
            $query .= $key . " =:" . $key . " && ";
        }
         
        $keys_not = array_keys($data_not);
        foreach($keys_not as $key){
            $query .= $key . " !=:" . $key . " && ";
        }
        
        $query = trim($query, " && ");
        $data = array_merge($data, $data_not);

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

    }


    /**
     * Summary of get_row
     * You can pass in your query and data directly
     * SELECT * FROM users WHERE id = :user_id
     * @param string $query
     * @param array $data
     * @return array|bool
     */
    public function get_row(string $query, array $data = [])
    {

        $conn = $this->connect(); 

        // Prepare the statement
        // $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt = $conn->prepare($query);

        // Bind parameters
        // $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        // Execute the query
        $check = $stmt->execute($data);

        // Check the query
        if($check){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($result) && count($result) > 0) {
                return $result;
            }
        }

        return false;
    }

     
}
