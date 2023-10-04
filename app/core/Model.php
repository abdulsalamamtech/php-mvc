<?php

/**
 * Main Model Trait
 */

Trait Model
{
    use Database;
    protected $limit = 10;
    protected $offset = 0;


    // Get specific data from database
    public function where($data, $data_not = []) 
    {
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

        return $this->query($query, $data);

    }

    // Get the first row in database
    public function first($data, $data_not)
    {
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
        return ($result)?  $result[0] : false;

    }

    // Insert data into database
    public function insert($data)
    {

        $keys = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $this->table ($keys) VALUES ($values)";

        $result =  $this->query($query, $data);

        return ($result)?  true : false;

    }

    // Updating a row in database
    // update(1, ['email'=> 'abdulsalamamtech@gmail.com']);
    // UPDATE users SET name =:name, email =:email WHERE id = :id
    // update('amtech digital', ['email'=> 'abdulsalamamtech@gmail.com'], 'name');
    // UPDATE users SET name =:name, email =:email WHERE name = :name
    public function update($id, $data, $id_column = 'id')
    {

        $query = "UPDATE $this->table SET ";

        $keys = array_keys($data);
        foreach($keys as $key){
            $query .= $key . " =:" . $key . ", ";
        }

        $data[$id_column] = $id;
        $query = trim($query, ", ");
        $query .= " WHERE $id_column = :$id_column limit 1";

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

    }

    // This query delete only a single row by satisfying one condition
    public function delete(int|string $id, string $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column limit 1";

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

    }

    // This satisfy all condition before deleting any row
    // DELETE FROM users WHERE name =:name && email =:email && password =:password
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

    public function get_row($query, $data = [])
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
            if (is_array($result) && count($result)) {
                return $result;
            }
        }

        return false;
    }

     
}
