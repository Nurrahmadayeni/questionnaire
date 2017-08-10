<?php
	error_reporting(0);
	include('../../lib/config.php');
	$id_survey = $_POST['id_survey'];
	$query_c = "SELECT question from question where id_survey='$id_survey'";
    $data_c = $mysqli->query($query_c);
    $total = $data_c->num_rows;
    $pertanyaan = $total+1;

    echo "<i>( Pertanyaan ke $pertanyaan )</i>";
?>