<?php

/**
 * Auth Core Class
 */
class Auth{

    // public static $access = 'quest';
    // public static $access = 'user';
    public static $access = 'admin';
    
    // register all the access for quest
    public $quest = [
        'index',
        'home',
        'Home',
        'about',
        'contact',
        'services',
    ];

    // register all the access for users
    public $user = [
        'users', 
        'register',
        'login',
        'signup',
        'signin',
        'logout',
        'dashboard',
    ];

    // register all the access for admin
    public $admin = [
        'delete',
        'deletenull',
        'update',
        'show',
        'store',
        'admins',
    ];


    public function quest(){
        return $this->quest;
    }
    public function user(){
        return [...$this->quest, ...$this->user];
    }
    public function admin(){
        // return array_merge($this->quest, $this->user, $this->admin);
        return [...$this->quest, ...$this->user, ...$this->admin, 'hello'];
    }

    /**
     * Summary of check
     * checking access for quest, user and admin
     * $auth = new Auth();
     * $Auth->check('home', $Auth->admin());
     * this exit the application if user doesnot have access
     * and return access denial response
     * @param mixed $url eg 'home', 'about'
     * @param mixed $auth eg $Auth->quest(), $Auth->user(), $Auth->admin()
     * @return void
     */
    public function check($url, $auth){
        // checking if the $url is in the $auth array
        if(!in_array($url, $auth)){
            $resp = resp([], "401", "access denial for " .$url. " page, " .Auth::$access. ' is unauthorize');
            echo($resp);
            exit();
        }
    }

    public function __construct(){

    }

    public static function Auth($user, $access){
        // save the user details to session
        if(!isset($user)){
            $_SESSION["user"] = [];
            $_SESSION["user"]['access'] = 'quest';
            Auth::$access = $_SESSION["user"]['access'];
        }else{
            $_SESSION["user"] = $user;
            $_SESSION["user"]['access'] = $access;
            Auth::$access = $_SESSION["user"]['access'];
        }
    }

    public static function showAuth(){
        $user = [];
        // save the user details to session
        if(!isset($_SESSION["user"])){
            $user['access'] = Auth::$access;
        }else{
            $user = $_SESSION["user"];
        }
        $user['session_id'] = session_id();
        return $user;
    }

}
