<?php
    // units
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://api.usu.ac.id/1.0/units');

    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result);
    print_r($obj);

    echo "<br/><br/><br/><br/>";
    print_r($obj[0]->name);
    echo "<br/><br/><br/><br/>";

    // faculties
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://api.usu.ac.id/1.0/faculties');

    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result);
    // echo $obj->access_token;
    print_r($obj);

    echo "<br/><br/><br/><br/>";

    // print_r($obj[1]->name);
    $fakultas = array();
    foreach ($obj as $key => $value) {
        array_push($fakultas,$obj[$key]->code);
    }

    print_r($fakultas);

    if (in_array("FK", $fakultas)){
        echo "ada FK";
    }else{
        echo "gakada";
    }

    echo "<br/><br/><br/><br/>";


    $ch = curl_init();
    $user = "88888";
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $url = "https://api.usu.ac.id/1.0/users/".$user;

    curl_setopt($ch, CURLOPT_URL, $url);

    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result);
    print_r($obj);

    

?>