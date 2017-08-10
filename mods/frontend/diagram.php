<?php
    $level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super" ){ 

	error_reporting(0);
	include "../../../lib/config.php";
	$query_tot = "SELECT COUNT(id_user) FROM quest_user GROUP by id_user";
	
	$data_tot = $mysqli->query($query_tot);
		$tot = $data_tot->num_rows;	
	
	$judul = $mysqli->query("SELECT question FROM question WHERE id_q='$_POST[qst]'")->fetch_object()->question;
	echo "<label class='control-label'>".$judul."</label>";

	$j1=$j2=$j3=$j4=$j5=0;

	$ans1 = $mysqli->query("SELECT COUNT(answer) as ans FROM quest_user WHERE answer=1 AND id_survey='$_POST[srv]' AND id_q='$_POST[qst]' GROUP BY id_survey,id_q")->fetch_object()->ans;
	if(isset($ans1)){ $j1=($ans1/$tot)*100; }else{ $j1=0; }

	$ans2 = $mysqli->query("SELECT COUNT(answer) as ans FROM quest_user WHERE answer=2 AND id_survey='$_POST[srv]' AND id_q='$_POST[qst]' GROUP BY id_survey,id_q")->fetch_object()->ans;
	if(isset($ans2)){ $j2=($ans2/$tot)*100; }else{ $j2=0; }

	$ans3 = $mysqli->query("SELECT COUNT(answer) as ans FROM quest_user WHERE answer=3 AND id_survey='$_POST[srv]' AND id_q='$_POST[qst]' GROUP BY id_survey,id_q")->fetch_object()->ans;
	if(isset($ans3)){ $j3=($ans3/$tot)*100; }else{ $j3=0; }

	$ans4 = $mysqli->query("SELECT COUNT(answer) as ans FROM quest_user WHERE answer=4 AND id_survey='$_POST[srv]' AND id_q='$_POST[qst]' GROUP BY id_survey,id_q")->fetch_object()->ans;
	if(isset($ans4)){ $j4=($ans4/$tot)*100; }else{ $j4=0; }

	$ans5 = $mysqli->query("SELECT COUNT(answer) as ans FROM quest_user WHERE answer=5 AND id_survey='$_POST[srv]' AND id_q='$_POST[qst]' GROUP BY id_survey,id_q")->fetch_object()->ans;
	if(isset($ans5)){ $j5=($ans5/$tot)*100; }else{ $j5=0; }

	// var_dump($_POST);

	echo "<script>var myData = [$j1, $j2, $j3, $j4, $j5]</script>";

?>

<div id='myChart'></div>
<script>
	var myConfig = {
	  "graphset": [{
	    "type": "line",
	    "title": {
	      "text": "Analisis (%)"
	    },
	    "scale-x": {
	      "labels": ["Sangat Buruk", "Buruk", "Sedang", "Bagus", "Sangat Bagus"]
	    },
	    "series": [{
	      "values": myData
	    }]
	  }]
	};

	zingchart.render({
	  id: 'myChart',
	  data: myConfig,
	  height: "99%",
	  width: "99%"
	});
</script>
<?php
    }else{
        echo"<script>
                document.location.href='?d=error';
            </script>";
    }
?>


