<!DOCTYPE HTML>
<html>
    <head>
        <title>PORTAL SURVEY USU</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../../img/logo.png" />
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
        <script src="../../assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="../../assets/plugins/bootstrap/js/zingchart.min.js"></script>
	</head>
<?php 
	error_reporting(0);
	session_start();
	include('../../lib/config.php');
	$id_survey = base64_decode("$_GET[ids]");
	$ss = base64_decode("$_GET[ss]");
	
	$level = $_SESSION['level'];
	if($level=="fakultas" || $level=="unit" || $level=="super"){ 
		if($ss==1){
			$jdl = $mysqli->query("SELECT title from survey where id_survey='$id_survey'")->fetch_object()->title;

			echo "<h4>Judul Survey : <font style='color:red'>".$jdl. "</h4></font></br>";

				$q_d = " SELECT * FROM question where id_survey='$id_survey' group by id_q";
				// echo $q_d;
			    $data = $mysqli->query($q_d);

				$no=1;

				$total_user = $mysqli->query("SELECT count(id_user) as jlh_user FROM quest_user WHERE id_survey='$id_survey' group by id_q, id_survey")->fetch_object()->jlh_user;

				while($row = $data->fetch_assoc()) {
					echo $no.". ";
					echo $row['question']."<br/>";

					if($row['id_style_ans']==1){

					}else if($row['id_style_ans']==2){
						$answer='';
		    			$profile='';
		    			
		    			$val = explode(', ', $row['answer_value']);
		    			// echo "val ". count($val);

		    			$que_s = "SELECT answer FROM quest_user where id_style_ans='2' and id_q='$row[id_q]' and id_survey='$id_survey'";
						$style2 = $mysqli->query($que_s);

						$nilai = array();
						while($data_s = $style2->fetch_assoc()){
							// echo $data_s['answer']."<br/>";
							$e = explode(', ', $data_s['answer']);
							for($o=0; $o<=count($e)-1; $o++){
								// $val_e = '"'.$e[$o].'"';
								array_push($nilai, $e[$o]);
							}
						}
						// print_r(array_count_values($nilai));

		    			for($i=0; $i<=count($val)-1; $i++){
		    				if($i==count($val)-1){
		    					$profile.= '"'.$val[$i].'"';

		    					$counts = array_count_values($nilai);
		    					if(isset($counts[$val[$i]])){
		    						$value = $counts[$val[$i]];

		    						$answer.= number_format((($value/$total_user)*100),2);
		    					}else{
		    						$answer.= '0';
		    					}
		    				}else{
		    					$profile.= '"'.$val[$i].'"'. ", ";

		    					$counts = array_count_values($nilai);
		    					if(isset($counts[$val[$i]])){
		    						$value = $counts[$val[$i]];

		    						$answer.= number_format((($value/$total_user)*100),2).", ";
		    					}else{
		    						$answer.= '0, ';
		    					}

		    				}
		    			}
		    			// echo $profile;
		    			echo "
							<script type='text/javascript'>
								var myData2 = [$answer];
								var myProfile2 = [$profile];
								// alert(myData2+myProfile2);
							</script>
						";
						echo "<div id='myChart2'></div>";
						?>
						<script>
							var myConfig2 = {
							  "graphset": [{
							    "type": "line",
							    "title": {
							      "text": "Analisis (%)"
							    },
							    "scale-x": {
							      "labels": myProfile2
							    },
							    "series": [{
							      "values": myData2
							    }]
							  }]
							};

							zingchart.render({
							  id: 'myChart2',
							  data: myConfig2,
							  height: "40%",
							  width: "40%"
							});
						</script>
						<?php
					}else{
						$q_u = "SELECT answer FROM quest_user where id_q='$row[id_q]'";
		    			// echo $q_u;
		    			$data_qu = $mysqli->query($q_u);
		    			$jlh_user = $data_qu->num_rows;

		    			echo "<ul>";
		    			while ($answer_u = $data_qu->fetch_assoc()) {
		    				echo "<li>". $answer_u['answer']."</li>";
		    			}
		    			echo "</ul>";
					}
					$no++;
				}
		}
	}
	else{
		echo"<script>
                document.location.href='?d=tampilan_error_pengguna_admin';
            </script>";
	}

?>
<script>
	window.load = print_d();
	function print_d(){
		window.print();
	}
</script>