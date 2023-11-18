<?php

/**
 * Main Model Trait
 */

// Advice when creating your table add the following column
// id, status, updated_at, created_at

Trait Model
{
    use Database;

    protected string $order_column = 'id';
    protected string $order_type = 'DESC';
    public int $limit = 10;
    public int $offset = 0;

    public array $errors = [];
    public array $success = [];

    /**
     * Summary of limit_action
     * if set to true it will only perform action to one row
     * if set to false it will perform action to multiple row
     * @var int|bool
     */
    public int|bool $limit_action = true;

    // Remove unwated data and leave the fillable once
    // Filter the data and send to the database
    private function fillableData(array $data){
        if(!empty($this->allowedData)){
            foreach($data as $key => $value){
                if(!in_array($key, $this->allowedData)){
                    unset($data[$key]);
                }
                
                $data = [$key => esc($value)];

            }

        }
        return $data;
    }

    /**
     * Summary of removeUnwantedColumns and escape data
     * Removing unwanted data or columns before sending it to database
     * filter from the allowed column class
     * @param mixed $data
     * @return void
     */


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
        $query .= " ORDER BY $this->order_column $this->order_type 
                    LIMIT $this->limit OFFSET $this->offset";

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
    public function first(array $data, array $data_not = [])
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
        $data = $this->fillableData($data);

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

        $query = "UPDATE $this->table SET ";

        $keys = array_keys($data);
        foreach($keys as $key){
            $query .= $key . " =:" . $key . ", ";
        }

        $data[$id_column] = $id;
        $query = trim($query, ", ");
        $query .= " WHERE $id_column = :$id_column limit 1";

        // show($query);
        // show($data);

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

    }


    /**
     * Summary of disable
     * this disable a field, set the status to 0
     * @param mixed $data
     * @param mixed $data_not
     * @return bool true|false
     */
    public function disable($data = null, $data_not = [])
    {
        // disable the column
        $status['status'] = 0;
        // Set limit
        $limit = ($this->limit_action)? " limit 0" : '';

        $query = "UPDATE $this->table SET ";
        $query .= " status =:status WHERE ";

        // Check if the data is integer
        if(is_int($data) && !empty($data)){
            $id = $data;
            $query .= " id =:id";

            // If data is not set to array,you will get an error
            // To fix this error, you need to make sure that the 
            // variable is an array before you use it as an array
            $data = [];
            $data['id'] = $id;

        // Check if the data is array
        }elseif(is_array($data) && !empty($data)){
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
        $query .= $limit;

        // bind the status variable  set data to array before binding
        $data['status'] = $status['status'];

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

    }


    /**
     * Summary of enable
     * this enable a field, set the status to 1
     * @param mixed $data
     * @param mixed $data_not
     * @return bool true|false
     */
    public function enable($data = null, $data_not = [])
    {
        // disable the column
        $status['status'] = 1;
        // Set limit
        $limit = ($this->limit_action)? " limit 0" : '';

        $query = "UPDATE $this->table SET ";
        $query .= " status =:status WHERE ";

        // Check if the data is integer
        if(is_int($data) && !empty($data)){
            $id = $data;
            $query .= " id =:id";

            // If data is not set to array,you will get an error
            // To fix this error, you need to make sure that the 
            // variable is an array before you use it as an array
            $data = [];
            $data['id'] = $id;

        // Check if the data is array
        }elseif(is_array($data) && !empty($data)){
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
        $query .= "$limit";


        // bind the status variable  set data to array before binding
        $data['status'] = $status['status'];

        $result =  $this->query($query, $data);
        return ($result)?  true : false;

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
     * for testing purpose
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

    public function register(array $data){
        // empty the error
        $this->errors = [];

        // hash the password
        $data['password'] = $this->hashPassword($data["password"]);
        $registered = $this->insert($data);
        if(!$registered){
            $this->error['register'] = "please try again later, something went wrong";
            return false;
        }else{
            $this->success['register'] = "registration successful";
        }
        return true;
    }

    public function login(array $data){
        // empty the error
        $this->errors = [];

        // messages to display
        $error = "incorrect login credentials";
        $success = "login successful";

        // chech database for the user email account 
        $login_email = $this->first([
            'email' => $data['email']
        ]);

        // Get user detail using email account
        if(!$login_email){
            // user does not exist
            $this->errors['login'] = $error;
            return false;
        }else{

            // validate the user email account
            if(!$this->verifyPassword($data['password'], $login_email['password'])){

                // wrong password
                $this->errors['login'] = $error;
                return false;

            }else{

                // validation successful
                $this->success['login'] = $success;

                // save the user id and email to the session
                $details = ['id', 'status', 'token'];
                foreach($login_email as $key => $value) {
                    if(!in_array($key, $details)){
                        unset( $login_email[$key] );
                    }
                }

                // save the user details to session
                Auth::Auth($login_email, 'api');
                return true;
            }

        }
 
    }

    public function logout() {
        if(!empty(Auth::$access)){
            Auth::$access = 'quest';
        }
        
        // Unset all session variables
        unset($_SESSION['user']);
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        return true;
    }

    public function hashPassword($data){
        return password_hash($data, PASSWORD_DEFAULT);
    }

    public function verifyPassword($data, $hash_data){
        return password_verify($data, $hash_data);
    }


    public function validateApiToken(array $data){
        // empty the error
        $this->errors = [];

        // messages to display
        $error = "incorrect api token";
        $success = "api token validated successfully";

        // chech database for the user email account 
        $api_token = $this->first([
            'token' => $data['token']
        ]);

        // Get api detail token
        if(!$api_token){
            // api token does not exist
            $this->errors['token'] = $error;
            return false;
        }else{

            // validate the api token
            if(!$this->verifyPassword($data['token'], $api_token['hash_token'])){

                // wrong api token
                $this->errors['token'] = $error;
                return false;

            }else{

                // validation successful
                $this->success['token'] = $success;

                // save the api id token and status to the session
                $details = ['id', 'status', 'token'];
                foreach($api_token as $key => $value) {
                    if(!in_array($key, $details)){
                        unset( $api_token[$key] );
                    }
                }

                // save the user details to session
                Auth::Auth($api_token, 'api');
                return true;
            }

        }
 
    }

}
