<?php

    $location = isset($_POST['location']) ? $_POST['location'] : 'Location';
    $drugCat = isset($_POST['drugCat']) ? $_POST['drugCat'] : 'Drug Category';
    $drugSrc = isset($_POST['drugSrc']) ? $_POST['drugSrc'] : 'Drug Source';
    $seachDrug = isset($_POST['search']) ? $_POST['search'] : '';


    if (isset($_POST['reset'])) {
        $location = "Location";
        $drugCat = "Drug Category";
        $drugSrc = "Drug Source";
        $seachDrug = "";
    }


    $result = [
        ['Location' => 'Milwaukee', 'Drug Category' => 'Over-the-Counter', 'Drug Source' => 'Purchased', 'Drug Packet Size' => '10 tablets', 'Drug Name' => 'Aspirin', 'Strength' => '325 mg', 'Inventory' => 1000],
        ['Location' => 'Houston', 'Drug Category' => 'Prescription', 'Drug Source' => 'PAP', 'Drug Packet Size' => '20 capsules', 'Drug Name' => 'Amoxicillin', 'Strength' => '500 mg', 'Inventory' => 500],
        ['Location' => 'Houston', 'Drug Category' => 'Prescription', 'Drug Source' => 'PAP', 'Drug Packet Size' => '30 tablets', 'Drug Name' => 'Advil', 'Strength' => '10 mg', 'Inventory' => 750],
        ['Location' => 'Houston', 'Drug Category' => 'Over-the-Counter', 'Drug Source' => 'Donated', 'Drug Packet Size' => '50 tablets', 'Drug Name' => 'Atorvastatin', 'Strength' => '325 mg', 'Inventory' => 1000],
        ['Location' => 'Houston', 'Drug Category' => 'Prescription', 'Drug Source' => 'Purchased', 'Drug Packet Size' => '60 capsules', 'Drug Name' => 'Albuterol', 'Strength' => '20 mg', 'Inventory' => 300],
        ['Location' => 'Houston', 'Drug Category' => 'Prescription', 'Drug Source' => 'PAP', 'Drug Packet Size' => '30 tablets', 'Drug Name' => 'Lisinopril', 'Strength' => '10 mg', 'Inventory' => 750],
        ['Location' => 'Milwaukee', 'Drug Category' => 'Prescription', 'Drug Source' => 'Donated', 'Drug Packet Size' => '30 tablets', 'Drug Name' => 'Ibuprofen', 'Strength' => '200 mg', 'Inventory' => 800],
        ['Location' => 'Dallas', 'Drug Category' => 'Over-the-Counter', 'Drug Source' => 'Donated', 'Drug Packet Size' => '30 tablets', 'Drug Name' => 'Ibuprofen', 'Strength' => '200 mg', 'Inventory' => 800],
        ['Location' => 'Milwaukee', 'Drug Category' => 'Over-the-Counter', 'Drug Source' => 'Phurchased', 'Drug Packet Size' => '10 tablets', 'Drug Name' => 'Aspirin', 'Strength' => '325 mg', 'Inventory' => 1000]
    ];

    $drugs = ['Aspirin', 'Ibuprofen', 'Acetaminophen', 'Amoxicillin', 'Ciprofloxacin', 'Lisinopril', 'Atorvastatin', 'Metformin', 'Simvastatin', 'Prednisone', 'Albuterol', 'Doxycycline', 'Omeprazole', 'Hydrochlorothiazide', 'Warfarin', 'Gabapentin', 'Losartan', 'Sertraline', 'Trazodone', 'Amlodipine'];

    $filteredResult = [];

    
    foreach ($result as $row) {
    
        if ($location === $row['Location'] && $drugCat === $row['Drug Category'] && $drugSrc === $row['Drug Source']) {
            $filteredResult[] = $row;
        }elseif($location === $row['Location'] && $drugCat === $row['Drug Category'] && $drugSrc === 'Drug Source' ){
            $filteredResult[] = $row;
        }elseif($location === $row['Location'] && $drugCat === 'Drug Category' && $drugSrc === $row['Drug Source'] ){
            $filteredResult[] = $row;
        }elseif($location === 'Location' && $drugCat === $row['Drug Category'] && $drugSrc === $row['Drug Source'] ){
            $filteredResult[] = $row;
        }elseif($location === $row['Location'] && $drugCat === 'Drug Category' && $drugSrc === 'Drug Source' ){
            $filteredResult[] = $row;
        }elseif($location === 'Location' && $drugCat === $row['Drug Category'] && $drugSrc === 'Drug Source' ){
            $filteredResult[] = $row;
        }elseif($location === 'Location' && $drugCat === 'Drug Category' && $drugSrc === $row['Drug Source'] ){
            $filteredResult[] = $row;
        }
    }

    $searchResult = [];
    //search for drug strings matching in filters results 
    if($filteredResult !== [] && $seachDrug !== ""){
        //search for drug strings matching in filters results 
        foreach($filteredResult as $row){

            if(strpos(strtolower($row['Drug Name']), strtolower($seachDrug)) === 0) {
                $searchResult[] = $row;
            }
            
        }

    }// search for drug string matching in results if there are no filters
    elseif($filteredResult === []){
        foreach($result as $row){
            $lcDrugName = strtolower($row['Drug Name']);
            $lcSeachDrug = strtolower($seachDrug);
            
            if(strpos($lcDrugName, $lcSeachDrug) === 0){
                $searchResult[] = $row;
            }
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../public/assets/css/formulary.css">
    
</head>
<body>
    <!-- Header for page -->
    <div id='row1'>
        <!-- Form 1 - Dropdown Menu Filters -->
        <form id='filters-search' method="post">
            <select id="<?php echo $location === 'Location' ? 'default-filter' : 'applied-filter'; ?>" name="location">
                <?php
                
                    if ($location === 'Location') {
                        echo '<option value="" disabled selected hidden>Location</option>';
                    }
                    if ($location !== 'Location') {
                        echo '<option value="' . $location . '" class="filter-items" > ' . $location . '</option>';
                    }
                    // Add an if condition to avoid showing the selected value as an option
                    if ($location !== 'Milwaukee') {
                        echo '<option value="Milwaukee" class="filter-items">Milwaukee</option>';
                    }
                    // Add an if condition to avoid showing the selected value as an option
                    if ($location !== 'Houston') {
                        echo '<option value="Houston" class="filter-items">Houston</option>';
                    }
                ?>
            </select>

            <select id="<?php echo $drugCat === 'Drug Category' ? 'default-filter' : 'applied-filter'; ?>" name="drugCat">
                <?php
                    
                    if ($drugCat === 'Drug Category') {
                        echo '<option value="" disabled selected hidden>Drug Category</option>';
                    }
                    if ($drugCat !== 'Drug Category') {
                        echo '<option value="' . $drugCat . '">' . $drugCat . '</option>';
                    }
                    // Add an if condition to avoid showing the selected value as an option
                    if ($drugCat !== 'Over-the-Counter') {
                        echo '<option value="Over-the-Counter" class="filter-items">Over-the-Counter</option>';
                    }
                    // Add an if condition to avoid showing the selected value as an option
                    if ($drugCat !== 'Prescription') {
                        echo '<option value="Prescription" class="filter-items">Prescription</option>';
                    }
                ?>
            </select>

            <select id="<?php echo $drugSrc === 'Drug Source' ? 'default-filter' : 'applied-filter'; ?>" name="drugSrc">
                <?php
                    
                    if ($drugSrc === 'Drug Source') {
                        echo '<option value="" disabled selected hidden>Drug Source</option>';
                    }
                    if ($drugSrc !== 'Drug Source') {
                        echo '<option value="' . $drugSrc . '" >' . $drugSrc . '</option>';
                    }
                    // Add an if condition to avoid showing the selected value as an option
                    if ($drugSrc !== 'Donated') {
                        echo '<option value="Donated" class="filter-items">Donated</option>';
                    }
                    // Add an if condition to avoid showing the selected value as an option
                    if ($drugSrc !== 'Purchased') {
                        echo '<option value="Purchased" class="filter-items">Purchased</option>';
                    }
                    // Add an if condition to avoid showing the selected value as an option
                    if ($drugSrc !== 'PAP') {
                        echo '<option value="PAP" class="filter-items">PAP</option>';
                    }
                ?>
            </select>
            
            <button type="submit" name="submit" value="Submit">Apply</button>
            <button type="submit" name="reset" value="Reset">Reset</button>

        </form>

        <!-- Form 2 - Search Bar -->
        <form id='header-search' method="post">
            <input type="text" id="search" name="search" placeholder="search">
            <input type="hidden" name="location" value="<?= $location ?>">
            <input type="hidden" name="drugCat" value="<?= $drugCat ?>">
            <input type="hidden" name="drugSrc" value="<?= $drugSrc ?>">
            


            <button type="submit">Search</button>
            
        </form>
    </div>


    <table>
        <thead>
            <tr>
                <th>Location</th>
                <th>Drug Category</th>
                <th>Drug Source</th>
                <th>Drug Packet Size</th>
                <th>Drug Name</th>
                <th>Strength</th>
                <th>Inventory</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
                if($searchResult){
                    foreach ($searchResult as $row) : ?>
                    <tr>
                        <td><?php echo $row['Location']; ?></td>
                        <td><?php echo $row['Drug Category']; ?></td>
                        <td><?php echo $row['Drug Source']; ?></td>
                        <td><?php echo $row['Drug Packet Size']; ?></td>
                        <td><?php echo $row['Drug Name']; ?></td>
                        <td><?php echo $row['Strength']; ?></td>
                        <td><?php echo $row['Inventory']; ?></td>
                    </tr>
                    <?php endforeach;
                }
                elseif($filteredResult){
                    foreach ($filteredResult as $row) : ?>
                    <tr>
                        <td><?php echo $row['Location']; ?></td>
                        <td><?php echo $row['Drug Category']; ?></td>
                        <td><?php echo $row['Drug Source']; ?></td>
                        <td><?php echo $row['Drug Packet Size']; ?></td>
                        <td><?php echo $row['Drug Name']; ?></td>
                        <td><?php echo $row['Strength']; ?></td>
                        <td><?php echo $row['Inventory']; ?></td>
                    </tr>
                    <?php endforeach;
                }else{
                    foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo $row['Location']; ?></td>
                            <td><?php echo $row['Drug Category']; ?></td>
                            <td><?php echo $row['Drug Source']; ?></td>
                            <td><?php echo $row['Drug Packet Size']; ?></td>
                            <td><?php echo $row['Drug Name']; ?></td>
                            <td><?php echo $row['Strength']; ?></td>
                            <td><?php echo $row['Inventory']; ?></td>
                        </tr>
                        <?php endforeach;
                }
            ?>


        </tbody>
    </table>
</body>
</html>
