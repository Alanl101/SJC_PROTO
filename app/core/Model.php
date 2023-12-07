<?php

trait Model{

    use Database;

    // login by calling the 
    public function login($username, $password, $table) {

        $queryString = "SELECT * FROM $table WHERE username = :username";
        $user = $this->get_row($queryString, ['username' => $username]);
    
        // Debug: Output the result of the query
        var_dump($user);
        // Check if a user was found and if the password matches
        if ($user && $password === $user['password']) {
            echo "login was a success passwords match";
            return $user; // Return the user data if the login is successful
        }
        echo "Error Password didn't match";
    
        return false; // Return false if the login fails
    }


    public function getFormularyData(){
        // select columns from multiple tables returned as an array
        $query = "SELECT 
            `location`.`LocationLongName`, 
            `drugcategory`.`DrugCategoryName`, 
            `sourcetype`.`sourceTypeName`, 
            `medications`.`PkgSize`, 
            `medications`.`MedicationName`, 
            `medications`.`Strength`, 
            `inventory`.`OnHandCount`
        FROM 
            `location`
        LEFT JOIN 
            (
                `inventory` 
                LEFT JOIN 
                `medications` ON `inventory`.`MedicationID` = `medications`.`MedicationID`
            ) ON `inventory`.`LocationID` = `location`.`LocationID`
        LEFT JOIN 
            `drugcategory` ON `medications`.`DrugCategoryID` = `drugcategory`.`DrugCategoryID`
        LEFT JOIN 
            `sourcetype` ON `medications`.`SourceTypeID` = `sourcetype`.`SourceTypeID`";
        
        $formularyData = $this->get_rows($query);
        if($formularyData){
            return $formularyData;
        }else{
            echo "Formulary data error";
        }
    }
    


    public function where($data, $data_not){
        // :id tells PDO that id is a variable
        $keys = array_keys($data);
        
        $str="";

        foreach ($keys as $key){
            $str = $key . "=:" . $key . " && ";
        }


        $query = "select  * $this->table users where id = :id";
        $this->query($query, ['id'=>23]);
    }

    public function first($data){

    }
    public function insert($data){

    }
    public function update($id, $data, $id_column = 'id' ){

    }

    public function delete($id, $id_column = 'id'){

    }
}