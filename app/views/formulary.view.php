<?php

    require_once '../app/controllers/Formulary.php';

    $location = isset($_POST['location']) ? $_POST['location'] : 'LocationLongName';
    $drugCat = isset($_POST['drugCat']) ? $_POST['drugCat'] : 'DrugCategoryName';
    $drugSrc = isset($_POST['drugSrc']) ? $_POST['drugSrc'] : 'sourceTypeName';
    $seachDrug = isset($_POST['search']) ? $_POST['search'] : '';


    if (isset($_POST['reset'])) {
        $location = "LocationLongName";
        $drugCat = "DrugCategoryName";
        $drugSrc = "sourceTypeName";
        $seachDrug = "";
    }
    
    

    $result = $this->getdatatable();
    $rowNumber = 0;


    /*  ---------- Test data output --------------
    if ($result !== null) {
        foreach ($result as $row) {
            echo "row " . $rowNumber . '<br>' ;
            echo "Location Short Name: " . $row['LocationLongName'] . '<br>';
            echo "Drug Category Name: " . $row['DrugCategoryName'] . '<br>';
            echo "Source ID: " . $row['sourceTypeName'] . '<br>';
            echo "Package Size: " . $row['PkgSize'] . '<br>';
            echo "Medication Name: " . $row['MedicationName'] . '<br>';
            echo "Strength: " . $row['Strength'] . '<br>';
            echo "On Hand Count: " . $row['OnHandCount'] . '<br>';
            $rowNumber++;
        }
    } else {
        echo "Error fetching formulary data.";
    }
    */

    $drugCategories = ['Alpha-/Beta Agonist','Analgesic','Analgesics','Anti - infective','Anti-Allergies','Antibiotic','Antibiotic Ophthalmic','Anticonvulsant','antidepressant','Anti-diarrheal','Antiemetic','Antigout','Antihistamine','Antihistamines','Antihypertensive','Anti-infective','Anti-infective Penicillin','Antimalarial','Antimetabolite','Antipsychotic','Antirheumatics-arthritis','Antitibubercular Agent','Asthma/Allergy','Asthma\Allergy','Cardiovascular','Cardiovascular Agent','CNS Agent','Dental','Dermatological','Dermatological Agent','Endocrine','Endocrine - Diabetes','Endocrine - Hormone','Endocrine - Thyroid','Endocrine- Diabetes','Endocrine-Diabetes','Endocrine-Hormone','Endocrine-Thyroid','Endrocrine-Hormone','Eye drops','Eye Wash','Gastrointestinal','Genitourinary','Harmone','Hematological','Immunosuppressive','Levonogestrel/Ethinyl Estradiol','Miscellaneous','Musculoskeletal','Musculoskeletal Skeletal/Muscle Relaxants','Neurological','Ophthalmic','Ophthalmologic Agent','Opthalmic','Psychotropic','Respiratory','Vitamin Supplement'];

    $filteredResult = [];
    

    foreach ($result as $row) {
    
        if ($location === $row['LocationLongName'] && $drugCat === $row['DrugCategoryName'] && $drugSrc === $row['sourceTypeName']) {
            $filteredResult[] = $row;
        }elseif($location === $row['LocationLongName'] && $drugCat === $row['DrugCategoryName'] && $drugSrc === 'sourceTypeName' ){
            $filteredResult[] = $row;
        }elseif($location === $row['LocationLongName'] && $drugCat === 'DrugCategoryName' && $drugSrc === $row['sourceTypeName'] ){
            $filteredResult[] = $row;
        }elseif($location === 'LocationLongName' && $drugCat === $row['DrugCategoryName'] && $drugSrc === $row['sourceTypeName'] ){
            $filteredResult[] = $row;
        }elseif($location === $row['LocationLongName'] && $drugCat === 'DrugCategoryName' && $drugSrc === 'sourceTypeName' ){
            $filteredResult[] = $row;
        }elseif($location === 'LocationLongName' && $drugCat === $row['DrugCategoryName'] && $drugSrc === 'sourceTypeName' ){
            $filteredResult[] = $row;
        }elseif($location === 'LocationLongName' && $drugCat === 'DrugCategoryName' && $drugSrc === $row['sourceTypeName'] ){
            $filteredResult[] = $row;
        }
    }

    $searchResult = [];
    //search for drug strings matching in filters results 
    if($filteredResult !== [] && $seachDrug !== ""){
        //search for drug strings matching in filters results 
        foreach($filteredResult as $row){

            if(strpos(strtolower($row['MedicationName']), strtolower($seachDrug)) === 0) {
                $searchResult[] = $row;
            }
            
        }

    }// search for drug string matching in results if there are no filters
    elseif($filteredResult === []){
        foreach($result as $row){
            $lcDrugName = strtolower($row['MedicationName']);
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
            <select id="<?php 
                echo $location === 'LocationLongName' ? 'default-filter' : 'applied-filter'; ?>" name="location">
                <?php
                
                    if ($location === 'LocationLongName') {
                       echo '<option value="" disabled selected hidden>Location</option>';
                    }
                    elseif ($location !== 'LocationLongNameon') {
                        echo '<option value="' . $location . '">' . $location . '</option>';
                    }
                    if ($location !== 'Midtown') {
                        echo '<option value="Midtown" class="filter-items">Midtown</option>';
                    }
                    if ($location !== 'Fort Bend') {
                        echo '<option value="Fort Bend" class="filter-items">Fort Bend</option>';
                    }
                ?>
            </select>

            <select id="<?php echo $drugCat === 'DrugCategoryName' ? 'default-filter' : 'applied-filter'; ?>" name="drugCat">
                <?php
                    
                    
                    

                    if ($drugCat === 'DrugCategoryName') {
                       echo '<option value="" disabled selected hidden>Drug Category</option>';
                    }
                    elseif ($drugCat !== 'Drug Category') {
                        echo '<option value="' . $drugCat . '">' . $drugCat . '</option>';
                    }
                    foreach ($drugCategories as $name) {
                        if ($drugCat !== $name) {
                            echo '<option value="' . $name . '" class="filter-items">' . $name . '</option>';
                        }
                    }
                ?>
            </select>

            <select id="<?php echo $drugSrc === 'sourceTypeName' ? 'default-filter' : 'applied-filter'; ?>" name="drugSrc">
                <?php
                    
                    if ($drugSrc === 'sourceTypeName') {
                        echo '<option value="" disabled selected hidden>Drug Source</option>';
                    }
                    elseif ($drugSrc !== 'Drug Source') {
                        echo '<option value="' . $drugSrc . '" >' . $drugSrc . '</option>';
                    }
                    if ($drugSrc !== 'Donated') {
                        echo '<option value="Donated" class="filter-items">Donated</option>';
                    }
                    if ($drugSrc !== 'Purchased') {
                        echo '<option value="Purchased" class="filter-items">Purchased</option>';
                    }
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
            <input type="text" id="search" name="search" placeholder="Search Drug Name">
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
                        <td><?php echo $row['LocationLongName']; ?></td>
                        <td><?php echo $row['DrugCategoryName']; ?></td>
                        <td><?php echo $row['sourceTypeName']; ?></td>
                        <td><?php echo $row['PkgSize']; ?></td>
                        <td><?php echo $row['MedicationName']; ?></td>
                        <td><?php echo $row['Strength']; ?></td>
                        <td><?php echo $row['OnHandCount']; ?></td>
                    </tr>
                    <?php endforeach;
                }
                elseif($filteredResult){
                    foreach ($filteredResult as $row) : ?>
                    <tr>
                        <td><?php echo $row['LocationLongName']; ?></td>
                        <td><?php echo $row['DrugCategoryName']; ?></td>
                        <td><?php echo $row['sourceTypeName']; ?></td>
                        <td><?php echo $row['PkgSize']; ?></td>
                        <td><?php echo $row['MedicationName']; ?></td>
                        <td><?php echo $row['Strength']; ?></td>
                        <td><?php echo $row['OnHandCount']; ?></td>
                    </tr>
                    <?php endforeach;
                }else{
                    foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo $row['LocationLongName']; ?></td>
                            <td><?php echo $row['DrugCategoryName']; ?></td>
                            <td><?php echo $row['sourceTypeName']; ?></td>
                            <td><?php echo $row['PkgSize']; ?></td>
                            <td><?php echo $row['MedicationName']; ?></td>
                            <td><?php echo $row['Strength']; ?></td>
                            <td><?php echo $row['OnHandCount']; ?></td>
                        </tr>
                        <?php endforeach;
                }
            ?>


        </tbody>
    </table>
</body>
</html>
