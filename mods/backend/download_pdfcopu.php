<!-- <script src="../../assets/plugins/bootstrap/js/zingchart.min.js"></script> -->
<?php 
	error_reporting(0);
	session_start();
	include('../../lib/config.php');

	$level = $_SESSION['level'];
	if($level=="fakultas" || $level=="unit" || $level=="super"){ 
		if($_POST['style_survey']==1){
			$jdl = $mysqli->query("SELECT title from survey where id_survey='$_POST[id_survey]'")->fetch_object()->title;

			echo "<h4>Judul Survey : <font style='color:red'>".$jdl. "</h4></font></br>";

				$q_d = " SELECT * FROM question where id_survey='$_POST[id_survey]' group by id_q";
				// echo $q_d;
			    $data = $mysqli->query($q_d);

				$no=1;

				$total_user = $mysqli->query("SELECT count(id_user) as jlh_user FROM quest_user WHERE id_survey='$_POST[id_survey]' group by id_q, id_survey")->fetch_object()->jlh_user;

				while($row = $data->fetch_assoc()) {
					echo $no.". ";
					echo $row['question']."<br/>";

					if($row['id_style_ans']==1){
		    			$answer1='';
		    			$profile1='';

		    			$val = explode(', ', $row['answer_value']);
		    			// print_r($val);
		    			// echo "count ". count($val);
		    			for($q=0; $q<=count($val)-1; $q++){
		    				if($q==count($val)-1){
		    					$profile1.= '"'.$val[$q].'"';
		    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[id_survey]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
		    					
			    				if(isset($q_answer)){
									$answer1.= number_format((($q_answer/$total_user)*100),2);
								}else{
									$answer1.= "0";
								}							
		    				}else{
		    					$profile1.= '"'.$val[$q].'"'. ", ";

		    					$eu = "SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[id_survey]' GROUP BY id_q, id_survey";
		    					// echo "no last ".$eu;

		    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[id_survey]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
		    				
			    				if(isset($q_answer)){
									$answer1.= number_format((($q_answer/$total_user)*100),2).", ";
								}else{
									$answer1.= "0, ";
								}
		    				}
		    			}
		    			echo "answer ".$answer1."<br/>";
		    			echo "profile ".$profile1;
		    			echo "
							<script type='text/javascript'>
								var myData1 = [$answer1];
								var myProfile1 = [$profile1];
								// alert(myData1+myProfile1);
							</script>
						";
						echo "<div id='myChart$no'></div>";

						?>
						<script>
							var myConfig = {
							  "graphset": [{
							    "type": "line",
							    "title": {
							      "text": "Analisis (%)"
							    },
							    "scale-x": {
							      "labels": myProfile1
							    },
							    "series": [{
							      "values": myData1
							    }]
							  }]
							};
						</script>
						<?php
							echo"
							<script>
								zingchart.render({
								  id: 'myChart$no',
								  data: myConfig,
								  height: '99%',
								  width: '99%'
								});
							</script>
							";
					}else if($row['id_style_ans']==2){
						echo "checbox";
						// $answer='';
		    // 			$profile='';
		    			
		    // 			$val = explode(', ', $row['answer_value']);
		    // 			// echo "val ". count($val);

		    // 			$que_s = "SELECT answer FROM quest_user where id_style_ans='2' and id_q='$row[id_q]' and id_survey='$_POST[id_survey]'";
						// $style2 = $mysqli->query($que_s);

						// $nilai = array();
						// while($data_s = $style2->fetch_assoc()){
						// 	// echo $data_s['answer']."<br/>";
						// 	$e = explode(', ', $data_s['answer']);
						// 	for($o=0; $o<=count($e)-1; $o++){
						// 		// $val_e = '"'.$e[$o].'"';
						// 		array_push($nilai, $e[$o]);
						// 	}
						// }
						// // print_r(array_count_values($nilai));

		    // 			for($i=0; $i<=count($val)-1; $i++){
		    // 				if($i==count($val)-1){
		    // 					$profile.= '"'.$val[$i].'"';

		    // 					$counts = array_count_values($nilai);
		    // 					if(isset($counts[$val[$i]])){
		    // 						$value = $counts[$val[$i]];

		    // 						$answer.= number_format((($value/$total_user)*100),2);
		    // 					}else{
		    // 						$answer.= '0';
		    // 					}
		    // 				}else{
		    // 					$profile.= '"'.$val[$i].'"'. ", ";

		    // 					$counts = array_count_values($nilai);
		    // 					if(isset($counts[$val[$i]])){
		    // 						$value = $counts[$val[$i]];

		    // 						$answer.= number_format((($value/$total_user)*100),2).", ";
		    // 					}else{
		    // 						$answer.= '0, ';
		    // 					}

		    // 				}
		    // 			}
		    // 			echo $profile."<br/>". $answer;
		    // 			echo "
						// 	<script type='text/javascript'>
						// 		var myData = [$answer];
						// 		var myProfile = [$profile];
						// 		// alert(myData+myProfile);
						// 	</script>
						// ";
						// echo "<div id='myChart$no'></div>";
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
						</script>
						<?php
							// echo"
							// <script>
							// 	zingchart.render({
							// 	  id: 'myChart$no',
							// 	  data: myConfig,
							// 	  height: '99%',
							// 	  width: '99%'
							// 	});
							// </script>
							// ";
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
	}else{
		echo"<script>
                document.location.href='?d=tampilan_error_pengguna_admin';
            </script>";
	}

?>
<!-- <script>
	window.load = print_d();
	function print_d(){
		window.print();
	}
</script> -->