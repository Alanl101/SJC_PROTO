<?php

class Model extends Database{


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