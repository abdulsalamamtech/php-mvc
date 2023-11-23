<?php


// Home Controler
class Users{

    use Controller;

    // display results
    public function index(){

        // $result = "@Index Users";
        // show($result);

        // Get information from the request
        $request_body = $_REQUEST;


        // Get the arguments pass to this function
        $arg = func_get_args()[0][1] ?? null;
        function is_arg_id($arg){
            $arg = trim($arg, "?");
            if(isset($arg) 
                && is_numeric($arg) 
                && !is_nan((int)$arg) 
                && $arg > 0)
            {
                return $arg;
            }
            return false;
        }


        // Checking the type of request pass them to their respective method
        if($this->request->method() == "POST"){
            // show("I am from store method");
            $this->store();
        }elseif($this->request->method() == "GET" && (is_arg_id($arg) || $request_body["id"] > 0)){
            // show("I am from show method");
            $id = $arg ?? $request_body["id"];
            $this->show($id);
        }elseif($this->request->method() == "UPDATE" && (is_arg_id($arg) || $request_body["id"] >= 1)){
            // show("I am from upate method");
            $id = $arg ?? $request_body["id"];
            $this->update($id);
        }elseif($this->request->method() == "DELETE" && (is_arg_id($arg) || $request_body["id"] > 0)){
            show("I am from delete method");
            $id = $arg ?? $request_body["id"];
            $this->delete($id);
        }else{

            // show("I am from find all");

            // Get data from request
            $data = $_REQUEST;

            // Get the arguments pass into the function
            $fun_arguments = func_get_args();
            $arguments = $fun_arguments[0];
            if(is_string($arguments[1])){
                // Getting the page and limit from the url for /page/1/limit/10
                if($arguments[1] == 'page' && $arguments[2] > 0)
                {
                    // for /page/1/limit/10
                    $page = (int) $arguments[2] ?? 1;
                    $limit = 10;


                    // for /page/1/limit/10
                    if($arguments[3] == 'limit' && $arguments[4] > 0)
                    {
                        $limit = (int) $arguments[4] ?? 10;

                    }

                }elseif($arguments[1] == 'limit' && $arguments[1] > 0)
                {
                    // for /limit/10
                    $limit = (int) $arguments[2] ?? 10;
                    
                }
                
            }

            $page = ($_REQUEST['page'] > 0 ) ? $_REQUEST['page'] : $page;
            $limit = ($_REQUEST['limit'] > 0 ) ? $_REQUEST['limit'] : $limit;
            $offset = paginate($page, $limit);

            // Initialize the user class
            $user = new User;
            $user->limit = $limit ?? $user->limit;
            $user->offset = $offset ?? $user->offset;
    
    
            // Get all the users
            $all_user = $user->findAll();
            if(!$all_user){
                // For faild
                $errors = $user->errors;
                $resp = $this->response->response($data, '404', $errors);
            }else{
                // For successful
                $data = $all_user;
                $resp = $this->response->response($data, '200', 'successfull');
            }
            // Display response
            echo($resp);

        }
        // End of checking type of request

    }


    // Store new data to the database
    public function store(){

        // Get the request data
        $data = $_REQUEST;
        $error = "failed, something went wrong, try again later";
        $success = "registration successful";

        // Initialize the user class
        $user = new User;
        // Remove unwanted data
        $data = $user->allowedData($data);

        // validating the user data
        if(!$user->validate($data)){

            // For validation error
            $resp = $this->response->response($user->errors, "400", 'invalid data');

        }else{

            // For registration
            $new_user = $user->register($data);
            if(!$new_user){
                // For faild registration
                $resp = $this->response->response($user->errors, '404', $error);
            }else{

                // Get the new user id
                $user_id = $user->last_insert_id();
                $data = ['id' => $user_id];

                // For successful registration
                $resp = $this->response->response($data, '200', $success);
            }

        }
        // End of validating the user data

        // Display response
        show($resp);
        
    }


    // Show the respective user details by passing the id
    public function show(int $id){

        // Get the request data
        $id = $id ?? $_REQUEST['id'];
        $data = ['id' => (int) $id];

        // Initialize the user class
        $user = new User;
        $get_user = $user->first($data, []);
        // Get user from database
        if(!$get_user){
            $resp = $this->response->response($data, '404', 'user not found');
        }else{
            $data = $user->unwantedResult($get_user);
            $resp = $this->response->response($data, '200', 'successful');
        }

        // Display response
        echo($resp);
    }


    // Update data from database by passing in the id and get the data through request
    // this class also hash the user password
    public function update($id){
        
        // Get the request data
        $data = $_REQUEST;
        $error = "update failed, something went wrong, try again later";
        $success = "update successful";

        // Get the id of data to update
        $id = $_REQUEST['id'] ?? $id;
        // Remove the id from the request data
        // unset($data['id']);
        
        // Initialize the class
        $user = new User;
        // Remove unwanted data
        $data = $user->allowedData($data);
        // Hash the user password
        $data['password'] = $user->hashPassword($data['password']);

        // Check if the user exist
        $get_user = $user->first(['id' => $id]);
        if(!$get_user){
            $resp = $this->response->response(['id' => $id], '404', 'user not found');
        }else{

            // update the user information
            $update_user = $user->update($id, $data);
            if(!$update_user){
                $resp = $this->response->response(['id' => $id], '404', $error);
            }else{
                $data = $user->unwantedResult($update_user);
                $resp = $this->response->response(['id' => $id], '200', $success);
            }
        }

        // display response
        echo($resp);

    }


    // Delete data from database by passing in the id
    public function delete(int $id){

        // Get the request data
        $data = $_REQUEST;
        $error = "delete failed, something went wrong, try again later";
        $success = "user deleted successful";

        // Remove the id from the request data
        unset($data['id']);

        // Initialize the class
        $user = new User;
        // Remove unwanted data
        $data = $user->allowedData($data);

        // Check if the user exist
        $get_user = $user->first(['id' => $id], []);
        if(!$get_user){
            $resp = $this->response->response(['id' => $id], '404', 'user not found');
        }else{

            // delete the user information
            $delete_user = $user->delete($id);
            if(!$delete_user){
                $resp = $this->response->response(['id' => $id], '404', $error);
            }else{
                $data = $user->unwantedResult($delete_user);
                $resp = $this->response->response(['id' => $id], '200', $success);
            }
        }

        // display response
        echo($resp);
    }

    // Login user
    public function login(){

        $data = $_REQUEST;

        // initialize the user class
        $user = new User;
        // Remove unwanted data
        $data = $user->allowedData($data);

        $login = $user->login([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        // Checking login
        if(!$login){
            // For faild login
            $errors = $user->errors;
            $resp = $this->response->response($data, '404', $errors);
        }else{
            // For successful login
            $success = $user->success;
            // Filter the data and send to the user
            $data = $user->unwantedResult($data);
            $resp = $this->response->response($data, '202', $success);
        }
        // End of checking login

        // Display response
        echo($resp);
        
    }


    // Logout user
    public function logout(){

        $data = $_REQUEST;

        // Initialize the user class
        $user = new User;
        // Logout the user
        if(!$user->logout()){
            $resp = $this->response->response($data, '404', '');
        }else{
            $resp = $this->response->response($data, '200', 'logout successful');
        }
        // Display response
        echo($resp);
    }


    // Delete mulitiple row from the database
    public function deletenull(){
        $data['status'] = "0";
        $user = new User;
        $deleted = $user->delete_multiple($data);
        if(!$deleted){
            $resp = $this->response->response($data, "",);
        }
        show($user::DB_STATUS());
        show($resp);
    }


}

