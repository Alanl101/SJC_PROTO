<?php


class Database {

    // Connect to the database
    private function connect() {
        // To connect to a server, a client needs to know where it is.
        // We provide this information in the form of a DSN (data source name)
        $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        
        try {
            $con = new PDO($dsn, DBUSER, DBPASS);
            return $con;
        } catch (Exception $e) {
            // Handle the exception, such as logging the error or displaying a user-friendly message.
            // You should also consider re-throwing the exception or exiting the script gracefully.
            echo "Connection failed: " . $e->getMessage();
        }
    }

    

    
}



