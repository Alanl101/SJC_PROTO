<?php


trait Database {



    
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

     // Make a query to the database and protecting against SQL injections by seperating SQL command from data
    public function query($query, $data = []) {
        $con = $this->connect(); // Use $this-> to access the class Database properties and methods
        $prepared_query = $con->prepare($query);
        $check = $prepared_query->execute($data);
        if($check){
            // Return all in an array form
            $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($result) && count($result)){
                return $result;
            }
        }
        return false;
    }

    // Make a query to the database and protecting against SQL injections by seperating SQL command from data
    public function get_row($query, $data = []) {
        $con = $this->connect(); // Use $this-> to access the class Database properties and methods
        $prepared_query = $con->prepare($query);
        $check = $prepared_query->execute($data);
        if($check){
            // get all data in an array form
            $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($result) && count($result)){
                return $result[0]; // return the first row only
            }
        }
        return false;
    }

    // Get each row for Formulary info used by Model.php
    public function get_rows($query) {
        try {
            $con = $this->connect();
            $prepared_query = $con->prepare($query);
            $check = $prepared_query->execute();
    
            if ($check) {
                return $prepared_query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $errorInfo = $prepared_query->errorInfo();
                throw new Exception("Query execution failed: {$errorInfo[2]}");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    
}



