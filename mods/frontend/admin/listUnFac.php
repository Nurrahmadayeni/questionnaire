<?php 
    // units
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://api.usu.ac.id/1.0/units');

    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result);
    foreach ($obj as $key => $value) {
        array_push($fakultas,$obj[$key]->code);
        echo "<option value='".$obj[$key]->code.'-'.$obj[$key]->name."'>".$obj[$key]->name."</option>";
    }

    // faculties
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://api.usu.ac.id/1.0/faculties');
    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result);

    foreach ($obj as $key => $value) {
        array_push($fakultas,$obj[$key]->code);
        echo "<option value='".$obj[$key]->code.'-'.$obj[$key]->name."'>".$obj[$key]->name."</option>";
    }
?>