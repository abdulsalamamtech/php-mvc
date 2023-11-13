<?php   


// Start session
session_start();

class Session{



    // Regenerate a unique session id 
    // everytme the application is refresh
    // this will improve the security of the app
    public function __construct(){
        session_regenerate_id();
    }


    /**
     * Summary of set
     * set a new session $key=$value eg set('name') = amtech
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    /**
     * Summary of get
     * get the value of a session eg get('name') return amtech
     * @param mixed $key
     * @return void
     */
    public function get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Summary of remove
     * unset and delete a value from the session remove('name')
     * @param mixed $key
     * @return void
     */
    public function remove($key){
        unset($_SESSION[$key]);
    }


}