<?php
/**
 * App Class
 *
 * This class contains methods related to URL routing and controller loading for a web application.
 * It is responsible for splitting the URL, constructing controller filenames, and loading controllers.
 *
 */

class App
{   
    private $controller = 'Home';
    private $method = 'index';

    // Private method to split URL seperated by a '/' 
    private function splitURL(){
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }
    
    
    
    // Public method to load a controller based on the URL
    public function loadController(){
        $URL = $this->splitURL();
    
        $filename = "../app/controllers/".ucfirst(strtolower($URL[0])).".php" ;
        if(file_exists($filename)){
            require $filename;
            $this->controller = ucfirst($URL[0]);
        }else{
            $filename = "../app/controllers/_404.php" ;
            require $filename;
            $this->controller = "_404";
        }
    
        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], []);
    }


}
