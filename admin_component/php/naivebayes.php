<?php

 function totalData($tableName) {
    global $connect;
    $query = "SELECT * FROM $tableName";
    $get_totalData = $connect->prepare($query);
    $get_totalData->execute();
    $total_data = $get_totalData->rowCount();

    return (float) $total_data;
}


function jumlahDataPerCandidate($tableName) {
    global $connect;

    $getDataYES = $connect->query("SELECT * FROM $tableName WHERE willvote = 'Y'");
    $jumlahDataSurvei['Yes'] = (float) $getDataYES->rowCount();

    return $jumlahDataSurvei;
}

function priorProbability($tableName) {
    $P_X['Yes'] = jumlahDataPerCandidate($tableName)['Yes'] / totalData($tableName);

    return $P_X;
}

function conditionalProbability($table, $nama_kolom, $candidate)
{
    global $connect;

    $query = "SELECT $nama_kolom FROM $table WHERE willvote = 'Y' AND $nama_kolom = :candidate";
    $getData = $connect->prepare($query);
    $getData->bindParam(':candidate', $candidate);
    $getData->execute();
    $getDataCount = $getData->rowCount();

    $P_XY[$candidate] = (float)$getDataCount / jumlahDataPerCandidate($table)['Yes'];

    return $P_XY;
}

function getCandidateNames($table)
{
    global $connect;

    $query = "SELECT DISTINCT pendidikan FROM $table";
    $result = $connect->query($query);
    $candidates = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $candidates[] = $row['pendidikan'];
    }

    return $candidates;
}

function posteriorProbability($table, $candidates)
{
    global $connect;

    // Get the list of columns from the table
    $query = "SHOW COLUMNS FROM $table ";
    $result = $connect->query($query);
    $columns = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $columns[] = $row['Field'];
    }

    unset($columns[0]);
    unset($columns[8]);
    unset($columns[9]);


    $probabilities = array();
    $A = array();


    foreach ($candidates as $candidate) {
        $probabilitas = floatval(1);
        foreach ($columns as $attribute) {
            $A[$attribute][$candidate] = conditionalProbability($table, $attribute, $candidate);
            $A[$attribute][$candidate] = implode($A[$attribute][$candidate]);
            $probabilitas *= $A[$attribute][$candidate];
        }
        
        $probabilitas *= priorProbability($table)['Yes'];
        $probabilities[$candidate] = $probabilitas;
    }

    return $probabilities;
}

        // $kandidat = getCandidateNames("prevote_presurvei");
        // $hasil = posteriorProbability("prevote_presurvei", $kandidat);

        // foreach($hasil as $key => $value){
            
        //         echo $key . " : " . $value . "<br>";
            
        // }






?>