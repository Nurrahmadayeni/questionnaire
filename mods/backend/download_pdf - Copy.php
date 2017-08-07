<!-- <link rel="stylesheet" href="../../assets/plugins/bootstrap/dist/css/bootstrap.min.css">     -->
<?php 
	error_reporting(0);
	session_start();
	include('../../lib/config.php');

	$level = $_SESSION['level'];
	if($level=="fakultas" || $level=="unit" || $level=="super"){ 
		if($_POST['style_survey']==1){
			$jdl = $mysqli->query("SELECT title from survey where id_survey='$_POST[id_survey]'")->fetch_object()->title;

			echo "<h4>Judul Survey : <font style='color:red'>".$jdl. "</h4></font></br>";
			echo "<table class='table table-theme'>";
				echo "<thead>
						<tr>
							<th>NO</th>
							<th>PERTANYAAN</th>
							<th>JENIS PILIHAN JAWABAN</th>
							<th>HASIL SURVEY</th>
						</tr>
				</thead>";

				echo "<tbody>";

				$q_d = " SELECT * FROM question where id_survey='$_POST[id_survey]' group by id_q";
				// echo $q_d;
			    $data = $mysqli->query($q_d);
				$no=1;

				while($row = $data->fetch_assoc()) {
					echo "<tr>";
					echo "<td> $no </td>";
					echo "<td> $row[question] </td>";
					
					$style_ans = $mysqli->query("SELECT style_ans FROM style_ans where id_style_ans='$row[id_style_ans]'")->fetch_object()->style_ans;
					echo "<td>$style_ans</td>";

					if($row['id_style_ans']==1){
		    			$jawab="";

						$val = explode(', ', $row['answer_value']);
						
						for($q=0; $q<=count($val)-1; $q++){
							if($q==count($val)-1){
		    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[id_survey]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
		    					
		    					$answer="";
			    				if(isset($q_answer)){
									$answer = $q_answer;
								}else{
									$answer = "0";
								}	
								$jawab.= $val[$q]. " : ". $answer;
							}else{							
		    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[id_survey]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
		    					$answer="";
			    				if(isset($q_answer)){
									$answer = $q_answer;
								}else{
									$answer = "0";
								}	
								$jawab.= $val[$q]. " : ". $answer. ", ";
							}
						}
						echo "<td>$jawab</td>";
						// $content.= "\t" . $jawab;
					}else if($row['id_style_ans']==2){
						$jawab="";

						$que_s = "SELECT answer FROM quest_user where id_style_ans='2' and id_q='$row[id_q]' and id_survey='$_POST[id_survey]'";
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

						for($i=0; $i<=count($val)-1; $i++){
		    				if($i==count($val)-1){
		    					$answer="";
		    					$counts = array_count_values($nilai);
		    					if(isset($counts[$val[$i]])){
		    						$value = $counts[$val[$i]];
		    						$answer = $value;
		    					}else{
		    						$answer = '0';
		    					}

		    					$jawab.= $val[$i]. " : ". $answer;
		    				}else{
		    					$answer="";

		    					$counts = array_count_values($nilai);
		    					if(isset($counts[$val[$i]])){
		    						$value = $counts[$val[$i]];
		    						$answer = $value;
		    					}else{
		    						$answer = '0';
		    					}
		    					$jawab.= $val[$i]. " : ". $answer. ", ";
		    				}
		    			}

						// $content.= "\t" . $jawab;
						echo "<td>$jawab</td>";
					}else{
						$q_u = "SELECT answer FROM quest_user where id_q='$row[id_q]' and id_survey='$_POST[id_survey]' ";
		    			$data_qu = $mysqli->query($q_u);
		    			$answer_u = $data_qu->fetch_assoc();

		    			$content.= "\t" . $answer_u['answer'];
		    			echo "<td>$answer_u[answer]</td>";
					}
					echo "</tr>";
					$no++;
				}

				echo "
				</tbody>
				";

			echo "</table>";
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