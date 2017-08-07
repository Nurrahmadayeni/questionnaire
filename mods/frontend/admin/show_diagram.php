<?php
	session_start();
	error_reporting(0);

	include "../../../lib/config.php";

	// var_dump($_POST);
	$judul = $mysqli->query("SELECT question FROM question WHERE id_q='$_POST[qst]'")->fetch_object()->question;
	$matkul = $mysqli->query("SELECT nama_matkul FROM mat_kul WHERE id_matkul='$_POST[id_matkul]'")->fetch_object()->nama_matkul;
	echo "
		<div class='row'>
		    <div class='col-md-12'>
		        <a><label><h5><i class='fa fa-question-circle' aria-hidden='true'></i> ". $judul."</h5></label></a>
		        <br/>
		        <a><label><h5><i class='fa fa-book' aria-hidden='true'></i> ". $matkul."</h5></label></a>
		        <hr class='title'>
		    </div>
		</div>";

	$query_r = "SELECT username FROM quest_user WHERE id_survey='$_POST[srv]' group by id_survey, username";
	$exec = $mysqli->query($query_r);
	$total_user = $exec->num_rows;
	
	// echo $total_user;


	// $query_tot = "SELECT username FROM quest_user where id_survey='$_POST[srv]' GROUP by username";
	// $data_tot = $mysqli->query($query_tot);
	// $tot = $data_tot->num_rows;	
	$q_d = " SELECT * FROM question where id_q='$_POST[qst]' GROUP BY id_q";
	$data = $mysqli->query($q_d);

	while($row = $data->fetch_assoc()) {
		if($row['id_style_ans']==1){
			$answer1;
			$profile1;

			$val = explode(', ', $row['answer_value']);
			// print_r($val);
			// echo "count ". count($val);
			for($q=0; $q<=count($val)-1; $q++){
				if($q==count($val)-1){
					$profile1.= '"'.$val[$q].'"';
					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where id_matkul='$_POST[id_matkul]' and answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[srv]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
					
    				if(isset($q_answer)){
						$answer1.= number_format((($q_answer/$total_user)*100),2);
					}else{
						$answer1.= "0";
					}							
				}else{
					$profile1.= '"'.$val[$q].'"'. ", ";

					$eu = "SELECT count(answer) as jlh FROM quest_user where id_matkul='$_POST[id_matkul]' and answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[srv]' GROUP BY id_q, id_survey";
					// echo "no last ".$eu;

					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where id_matkul='$_POST[id_matkul]' and answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[srv]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
				
    				if(isset($q_answer)){
						$answer1.= number_format((($q_answer/$total_user)*100),2).", ";
					}else{
						$answer1.= "0, ";
					}
				}
			}
			// echo "answer ".$answer1."<br/>";
			// echo "profile ".$profile1;
			echo "
				<script type='text/javascript'>
					var myData1 = [$answer1];
					var myProfile1 = [$profile1];
					// alert(myData+myProfile);
				</script>
			";
			echo "<div id='myChart'></div>";

			?>
			<script>
				var myConfig = {
				  "graphset": [{
				    "type": "line",
				    "title": {
				      "text": "Analisis (%)"
				    },
				    "plot": {
					    "aspect": "spline",
					    "tooltip": {
					      "text": "%v %",
					      "border-width": 1,
					      "border-radius": "9px",
					      "padding": "30%"							      
					    }
					  },
				    "scale-x": {
				      "labels": myProfile1
				    },
				    "series": [{
				      "values": myData1,
				      'background-color':'#81B71A',
					  'line-color': '#81B71A'
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

		}elseif($row['id_style_ans']==2){
			$answer;
			$profile;
			
			$val = explode(', ', $row['answer_value']);
			// echo "val ". count($val);

			$que_s = "SELECT answer FROM quest_user where id_matkul='$_POST[id_matkul]' and id_style_ans='2' and id_q='$row[id_q]' and id_survey='$_POST[srv]'";
			// echo $que_s;
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
					var myData = [$answer];
					var myProfile = [$profile];
					// alert(myData+myProfile);
				</script>
			";
			echo "<div id='myChart'></div>";
			?>
			<script>
				var myConfig = {
				  "graphset": [{
				    "type": "line",
				    "title": {
				      "text": "Analisis (%)"
				    },
				    "plot": {
					    "aspect": "spline",
					    "tooltip": {
					      "text": "%v %",
					      "border-width": 1,
					      "border-radius": "9px",
					      "padding": "30%"							      
					    }
					  },
				    "scale-x": {
				      "labels": myProfile
				    },
				    "series": [{
				      "values": myData,
				      'background-color':'#81B71A',
					  'line-color': '#81B71A'
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
			$q_u = "SELECT answer FROM quest_user where id_matkul='$_POST[id_matkul]' and id_q='$row[id_q]'";
			// echo $q_u;
			$data_qu = $mysqli->query($q_u);
			$jlh_user = $data_qu->num_rows;
			echo "<label>Jumlah Sampel : ".$jlh_user."</label><br/><br/>";

			$no=1;
			while ($answer_u = $data_qu->fetch_assoc()) {
				echo $no.". ". $answer_u['answer']."<br/>";
				$no++;
			}
		}
	}

	// $query = "SELECT matakuliah, skala, id_survey, title from survey where id_survey=$_POST[srv]";
	// // echo $query;
 //    $d_s = $mysqli->query($query);
 //    $mt = $d_s->fetch_assoc();

	// $q_d = " SELECT id_q, question FROM question where id_q='$_POST[qst]' GROUP BY id_q";
	// // echo $q_d."<br/>";
	// $data = $mysqli->query($q_d);

	// $answer = "";
	// $profile = "";
	// while($row = $data->fetch_assoc()) {
	// 	for($i=1; $i<= $mt['skala']; $i++){
	// 		$q_s = "SELECT COUNT(answer) as ans FROM quest_user WHERE answer=$i AND id_survey='$_POST[srv]' AND id_q='$row[id_q]' and id_matkul='$_POST[id_matkul]' GROUP BY id_survey,id_q";
	// 		// echo $q_s."<br/>";
	// 		$s = $mysqli->query($q_s);
	// 		$skala = $s->fetch_assoc();

	// 		if($i==$mt['skala']){
	// 			$profile.= '"Skala '.$i.'"';
	// 			if(isset($skala['ans'])){
	// 				$answer.= number_format((($skala['ans']/$tot)*100),2)." ";
	// 			}else{
	// 				$answer.= "0";
	// 			}
	// 		}else{
	// 			$profile.= '"Skala '.$i.'",';
	// 			// $profile.= "Skala $i".", ";
	// 			if(isset($skala['ans'])){
	// 				$answer.= number_format((($skala['ans']/$tot)*100),2).", ";
	// 			}else{
	// 				$answer.= "0".", ";
	// 			}
	// 		}
	// 	}
	// }			
	// echo "
	// 	<script type='text/javascript'>
	// 		var myData = [$answer];
	// 		var myProfile = [$profile];
	// 		// alert(myData+myProfile);
	// 	</script>
	// ";
	// echo "<div id='myChart'></div>";
?>
<script>
	// var myConfig = {
	//   "graphset": [{
	//     "type": "line",
	//     "title": {
	//       "text": "Analisis (%)"
	//     },
	//     "scale-x": {
	//       "labels": myProfile
	//     },
	//     "series": [{
	//       "values": myData
	//     }]
	//   }]
	// };

	// zingchart.render({
	//   id: 'myChart',
	//   data: myConfig,
	//   height: "99%",
	//   width: "99%"
	// });
</script>