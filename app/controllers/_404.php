<?php

// Default controller, when no controller has been passed
class _404 extends Controller{
    public function index($a = '', $b = '', $c = ''){
        echo "404 no controller found";
        $this->view('_404');
    }
}

