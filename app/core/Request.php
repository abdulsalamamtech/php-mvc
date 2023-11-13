<?php   


class Request{

    // Request method
    public function method(){

        if(isset($_SERVER['REQUEST_METHOD']) 
            && (strtoupper($_GET['_method']) == 'PUT' 
            || strtoupper($_GET['_method']) == 'PATCH'
            || strtoupper($_GET['_method']) == 'UPDATE')
            || (strtoupper($_POST['_method']) == 'PUT' 
            || strtoupper($_POST['_method']) == 'PATCH'
            || strtoupper($_POST['_method']) == 'UPDATE')
            || (strtoupper($_SERVER['REQUEST_METHOD']) == 'PUT'
            || strtoupper($_SERVER['REQUEST_METHOD']) == 'PATCH'
            || strtoupper($_SERVER['REQUEST_METHOD']) == 'UPDATE'))
        {
            return "update";

        }
        elseif(isset($_SERVER['REQUEST_METHOD']) 
            && (strtoupper($_GET['_method']) == 'DELETE' 
            || strtoupper($_POST['_method']) == 'DELETE'
            || strtoupper($_SERVER['REQUEST_METHOD']) == 'DELETE'))
        {
            return "delete";
        }
        elseif(isset($_SERVER['REQUEST_METHOD']) 
            && (strtoupper($_GET['_method']) == 'POST'
            || strtoupper($_POST['_method']) == 'POST' 
            || strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'))
        {
            return "post";
        }
        elseif(isset($_SERVER['REQUEST_METHOD']) 
            && (strtoupper($_GET['_method']) == 'GET'
            || strtoupper($_POST['_method']) == 'GET' 
            || strtoupper($_SERVER['REQUEST_METHOD']) == 'GET'))
        {
            return "get";
        }
        else{
            return false;
        }

    }

    // Request body
    public function body(){
        return $_REQUEST;
    }

    // Request header
    public function header(){
        return;
    }

}
