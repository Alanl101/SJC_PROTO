<?php

class Model extends Database{

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
}