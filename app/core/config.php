<?php

//create a constant value that can be accessed by file

if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('DBNAME', 'my_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBRIVER', '');

    define('ROOT', 'http://localhost/prototype/public');
}