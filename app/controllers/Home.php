<?php

// Default controller, when no controller has been passed
class Home{
    use Controller;

    public function index($a = '', $b = '', $c = ''){
        echo "this is my home controller running requesting for view";
        $this->view('home');
    }
}

