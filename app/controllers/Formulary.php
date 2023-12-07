<?php

class Formulary{
    use Controller;
    use Model;
    
    // Get Formulary data and return it with priority
    function getDataTable() {
        $data = $this->getFormularyData();
    
        // Define the priority order
        $priorityOrder = ['donated' => 1, 'purchased' => 2, 'PAP' => 3];
    
        // Custom comparison function for sorting
        usort($data, function ($a, $b) use ($priorityOrder) {
            // Get the priority for each source type, defaulting to a high value if not found
            $aPriority = $priorityOrder[strtolower($a['sourceTypeName'])] ?? PHP_INT_MAX;
            $bPriority = $priorityOrder[strtolower($b['sourceTypeName'])] ?? PHP_INT_MAX;
    
            // Compare based on priority order
            return $aPriority - $bPriority;
        });
    
        return $data;
    }
    
    
    
    
    

    function getDataFromFile1() {

        

        return "Hello from file1!";
    }

    public function index(){

        $this->view('formulary');
    }
}