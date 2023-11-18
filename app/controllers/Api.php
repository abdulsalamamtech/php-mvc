<?php



/**
 * Api Controller Class
 */
class Api{

    use Controller;

    // Api Index method
    public function index(){

        // set token to null
        $token = null;
        // get the request header
        $headers = getallheaders();
        // get the request body
        $request_body = $_REQUEST;

        // Checking for the Authorization header and the token from the request
        if (!isset($headers['Authorization']) && !isset($request_body['token'])){

                $resp = resp([], "401", "unauthorized, authorization token is missing");
                echo($resp);
                exit();

        }else{

            // Get the Authorization header
            $authorizationHeader = $headers['Authorization'];
            // Remove 'Bearer ' prefix
            $token = (strlen(substr($authorizationHeader, 7)) >= 4)
                ? substr($authorizationHeader, 7)
                : $request_body['token'];

            // Checking for the Authorization token
            if(!isset($token)){
                $resp = resp([], "401", "unauthorized access, provide your api token");
                echo($resp);
                exit();
            }else{

                // Initialize the api class
                $api_token = new ApiAccess();
                // Validating the api token
                if(!$api_token->validateApiToken(['token' => $token])){
                    $resp = resp([], "404", $api_token->errors);
                    echo($resp);
                    exit();
                }else{

                    // Initialize the api and load controller
                    $api = new ApiCall;
                    $api->loadController();
                    // End of Initialize the api and load controller

                }
                // End of Validating the api token
                
            }
            // End of Checking for the Authorization token

        }


    }
    // End of Api Index method

}


// ApiCall Class
// this is the same class as the core/App file
// with some little chages so it can work for api url
class ApiCall{

    private $controller = "home";
    private $method = "index";



    // Split the API request uri
    private function splitApiUrl(){
        // get request url if empty load home
        $path = !trim($_SERVER['REQUEST_URI'], "/api")
            ? "home"
            :trim($_SERVER['REQUEST_URI'], "/api");
    
        return explode("/", $path);
    }

    // Loading Controller
    public function loadController(){

        // Split the API URL into arrays
        $URL = $this->splitApiUrl();
        // Get the contoller file name
        $file_name = "../app/controllers/" . ucfirst($URL[0]) . ".php";

        // Uncomment to check the url
        // show($URL);
        
        // Checking for controller as the first element in the array
        if(file_exists($file_name)){

            include_once $file_name;
            // Set the controller
            $this->controller = ucfirst($URL[0]);
            // Remove the controller from the URL array
            unset($URL[0]);

        }else{
            include_once "../app/controllers/_404.php";
            $this->controller = "_404";
        }

        // Checking for method as the secord element in the array
        if(!empty($URL[1])){
            // check if the method exist in the controller class
            if(method_exists($this->controller, $URL[1])){

                // Set the method
                $this->method = $URL[1];
                // Remove the method from the URL array
                unset($URL[1]);
            }
        }

        // Uncomment to check the url
        // show($URL);

        // Setting and initializing the controller class
        $controller = new $this->controller;

        // Calling a callback with an array of parameters 
        // and sending the remaining variable in the URL as arguments
        // as arguments for the method
        call_user_func_array([$controller, $this->method], [$URL]);

    }

}




// echo "@api error";
// show($api_token->errors);
// echo "@api success";
// show($api_token->success);
// echo "@api user";
// show($_SESSION["user"]);
// echo "@api auth access";
// show(Auth::$access);


// $a = new Auth();
// $a->check('index', $a->user());


// $RI = random_int(0,2);
// if($RI == 1){
    // Auth::$access = "admin";
// }elseif($RI == 2){
//     Auth::$access = "user";
// }else{
//         Auth::$access = "quest";
// }
// show($RI);


// show(" Line no. " . __LINE__ ." Data " .$data);
