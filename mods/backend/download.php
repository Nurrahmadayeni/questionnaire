
<?php
	error_reporting(0);
	session_start();
	include('../../lib/config.php');

	// var_dump($_POST);
	// var_dump($_SESSION);

	$level = $_SESSION['level'];

	if($level=="fakultas" || $level=="unit" || $level=="super"){ 
		if($_POST['style_survey']==1){
			$jdl = $mysqli->query("SELECT title from survey where id_survey='$_POST[id_survey]'")->fetch_object()->title;

			$title = "Judul Survey : $jdl\n\n";
	    	$header = "NO \t PERTANYAAN \t JENIS PILIHAN JAWABAN \t HASIL SURVEY";

			$header.= "\n";
			// echo $header;
			$content="";

			$q_d = " SELECT * FROM question where id_survey='$_POST[id_survey]' group by id_q";
			// echo $q_d;
		    $data = $mysqli->query($q_d);
			$no=1;

			while($row = $data->fetch_assoc()) {
				$content .= $no." \t ".$row['question']." ";

				$style_ans = $mysqli->query("SELECT style_ans FROM style_ans where id_style_ans='$row[id_style_ans]'")->fetch_object()->style_ans;

				$content.= "\t" . $style_ans;

				$result="";
				$total_user = $mysqli->query("SELECT count(id_user) as jlh_user FROM quest_user WHERE id_survey='$_POST[id_survey]' group by id_q, id_survey")->fetch_object()->jlh_user;

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

					$content.= "\t" . $jawab;
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

					$content.= "\t" . $jawab;
				}else{
					$q_u = "SELECT answer FROM quest_user where id_q='$row[id_q]' and id_survey='$_POST[id_survey]'";
	    			$data_qu = $mysqli->query($q_u);
	    			
	    			$cek = $data_qu->num_rows;
	    			// echo "cek ".$cek;
	    			$answer="";
	    			$no=1;

	    			while($answer_u = $data_qu->fetch_assoc()){
	    				if($no==$cek){
	    					$answer.= $answer_u['answer'];
	    				}else{
	    					$answer.= $answer_u['answer'].", ";
	    				}
	    				$no++;
	    			}

	    			$content.= "\t" . $answer;
				}

				$content.= "\n";
				$no++;
			}

			$output = $title.$header.$content;
			$filename ="DataSurvey.xls";
			header('Content-type: application/ms-excel');
			header('Content-Disposition: attachment; filename='.$filename);
			echo $output;
		}
	}else{
		echo"<script>
                document.location.href='?d=tampilan_error_pengguna_admin';
            </script>";
	}

 //    if($level=="fakultas" || $level=="unit" || $level=="super"){ 
	// 	include('../../lib/config.php');
		// $query = "SELECT matakuliah, skala, id_survey, title from survey where id_survey='$_POST[id_survey]' and id_owner='$_SESSION[status]'";
		// // echo $query;
	 //    $data = $mysqli->query($query);
	 //    $mt = $data->fetch_assoc();

	//     if($mt['matakuliah'] == '1'){
	//     	$title = "Judul Survey : $mt[title]\n\n";
	//     	echo $title;

	//     	$thn = "SELECT max(thn_ajaran) as thn_ajaran from krs order by id_krs";
	//         $r_t = $mysqli->query($thn);
	//         $tahun = $r_t->fetch_assoc();

	//         $status = $mysqli->query("SELECT nama_unit FROM unit_kerja WHERE id_unit='$_SESSION[status]'")->fetch_object()->nama_unit;
	// 		// echo "Status ".$status;

	//     	$id_fak = $mysqli->query("SELECT id_fak FROM fakultas WHERE nama_fak='$status'")->fetch_object()->id_fak;

	//         $q_m = "SELECT k.id_matkul, m.nama_matkul from krs k, mat_kul m where k.thn_ajaran='$tahun[thn_ajaran]' and k.id_matkul=m.id_matkul and m.id_fak='$id_fak' group by id_matkul";
	//         $r_m = $mysqli->query($q_m);
	        
	//         while($mata = $r_m->fetch_assoc()){
	//         	$q_qu = "SELECT id_matkul from quest_user where id_matkul='$mata[id_matkul]' and id_survey='$_POST[id_survey]' ";
	//         	// echo $q_qu.'';
	//         	$r_qu = $mysqli->query($q_qu);
	//         	$cek_v = $r_qu->fetch_assoc();        	

	//         	if(isset($cek_v)){
	//         		while($qu_id = $r_qu->fetch_assoc()){
	//         			$matakuliah = "Matakuliah : ". $mata['nama_matkul']."\n";
	//         			$header = "NO \t PERTANYAAN ";

	//         			for($i=1; $i<= $mt['skala']; $i++){
	// 						$header.= "\tSkala $i ";
	// 					}
	// 					$header.="\n";
	// 					echo $matakuliah.$header;

	// 					$q_q = " SELECT id_q, question FROM question where id_survey='$mt[id_survey]' group by id_q";
	// 					// echo $q_q.'<br/>';
	// 				    $q_qq = $mysqli->query($q_q);
	// 				    $no=1; 
	// 					while($row = $q_qq->fetch_assoc()) {	
	// 						$content = $no." \t ".$row['question'];					
	// 						for($i=1; $i<= $mt['skala']; $i++){
	// 							$q_s = "SELECT COUNT(answer) as ans FROM quest_user WHERE answer=$i AND id_survey='$_POST[id_survey]' AND id_q='$row[id_q]' and id_matkul='$qu_id[id_matkul]' GROUP BY id_survey,id_q, id_matkul";
	// 							// echo $q_s.'<br/>';
	// 							$s = $mysqli->query($q_s);
	// 							$skala = $s->fetch_assoc();

	// 							if(isset($skala['ans'])){
	// 								$content.= "\t ".$skala['ans'];
	// 							}else{
	// 								$content.= "\t 0";
	// 							}
	// 						}
	// 						$content.="\n";
	// 						echo $content;
	// 						$no++;
	// 					}
	// 					echo "\n";

				        
	//         		}	
	//         	}else{
	//         		$matakuliah = "Belum Ada User Menjawab Survey pada Matakuliah $mata[nama_matkul]\n ";
	//         		echo $matakuliah;
	//         	}
	//         	$filename ="DataSurvey.xls";
	// 			header('Content-type: application/ms-excel');
	// 			header('Content-Disposition: attachment; filename='.$filename);
	//         }
	//     }else{
	//     	$title = "Judul Survey : $mt[title]\n\n";
	//     	$header = "NO \t PERTANYAAN ";

	// 		for($i=1; $i<= $mt['skala']; $i++){
	// 			$header.= "\tSkala $i ";
	// 		}

	// 		$header.= "\n";

	// 		$q_d = " SELECT id_q, question FROM question where id_survey='$_POST[id_survey]' group by id_q";
	// 	    $data = $mysqli->query($q_d);
	// 		$no=1;

	// 		while($row = $data->fetch_assoc()) {
	// 			$content .= $no." \t ".$row['question']." ";
	// 			for($i=1; $i<= $mt['skala']; $i++){
	// 				$q_s = "SELECT COUNT(answer) as ans FROM quest_user WHERE answer=$i AND id_survey='$_POST[id_survey]' AND id_q='$row[id_q]' GROUP BY id_survey,id_q";
	// 				$s = $mysqli->query($q_s);
	// 				$skala = $s->fetch_assoc();

	// 				if(isset($skala['ans'])){
	// 					$content.= "\t ".$skala['ans'];
	// 				}else{
	// 					$content.= "\t 0";
	// 				}
	// 			}
	// 			$content.= "\n";
	// 			$no++;
	// 		}

	// 		$output = $title.$header.$content;
	// 		$filename ="DataSurvey.xls";
	// 		header('Content-type: application/ms-excel');
	// 		header('Content-Disposition: attachment; filename='.$filename);
	// 		echo $output;
	//     }
	// }else{
	// 	echo"<script>
 //                document.location.href='?d=error';
 //            </script>";
	// }
?>