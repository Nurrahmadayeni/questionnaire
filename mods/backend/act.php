<?php
	error_reporting(0);
	session_start();
	include('../../lib/config.php');
	include('../../lib/JWTAuth.php');
	$act=$_GET["act"];

	if($act=='login'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "SELECT username, level from users_auth where username='$username'";
		$data_admin = $mysqli->query($query);
		$jlh = $data_admin->num_rows;
		$user = $data_admin->fetch_assoc();

//		 var_dump($user);
		
		if($user['level']=='super'){
    		$cc = $mysqli->query("SELECT username FROM users_auth where username='$username' and password=md5('$password')")->fetch_object()->username;

    		if(isset($cc)){
    			$_SESSION['username_q'] = "Super Admin";
    			$_SESSION['level'] =  'super';
    			$_SESSION['status'] = 'super';
				$_SESSION['username'] = $username;

				echo "Sukses";

    		}else{
    			echo "Username atau password anda salah";
    		}
    	}else{
    		$curl = curl_init();

			// pegawai & dosen
            curl_setopt_array($curl, array(
		        CURLOPT_RETURNTRANSFER => TRUE,
		        CURLOPT_URL => 'http://api.usu.ac.id/1.0/users/auth',
		        CURLOPT_POST => 1,
		        CURLOPT_POSTFIELDS => array("nip" => $username, "password" => $password,
		        CURLOPT_HEADER => TRUE
		    )));

		    $resp = curl_exec($curl);
		    curl_close($curl);

		    $data = json_decode($resp, TRUE);
		    var_dump($data);

		    if($data['error']){
	    		echo "Username atau password anda salah";
		    }else{
				$_SESSION['username_q'] = $data['full_name'];
				
			    if($user['level']=='admin'){
		    		// faculties
				    $ch = curl_init();
				    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				    curl_setopt($ch, CURLOPT_URL, 'https://api.usu.ac.id/1.0/faculties');

				    $result = curl_exec($ch);
				    curl_close($ch);

				    $obj = json_decode($result);
				    $fakultas = array();
				    foreach ($obj as $key => $value) {
				        array_push($fakultas,$obj[$key]->code);
				    }
				    
				    if(in_array($data['work_unit'], $fakultas)){
				        $_SESSION['level'] =  'fakultas';
				    }else{
				        $_SESSION['level'] =  'unit';
				    }

					$_SESSION['status'] = $data['work_unit'];
					$_SESSION['username'] = $username;

					echo "Sukses";
			    }else{
			    	$_SESSION['username'] = $username;
			    	$_SESSION['status'] = $data['work_unit'];
			    	if($data['type']==1 || $data['type']==5){
			    		$_SESSION['level'] =  'pgw';
			    	}else{
			    		$_SESSION['level'] =  'dsn';
			    	}	
			    	// echo "user biasa";
					
					echo "Sukses";
			    }
		    }
    	}
	}
	elseif ($act=='addUser') {
		date_default_timezone_set('Asia/Jakarta');
		$date = date("Y-m-d H:i:s");
		$cek_user = $mysqli->query("SELECT username FROM users_auth where username='$_POST[username]'")->fetch_object()->username;
		if(isset($cek_user)){
			echo "<div class='alert alert-danger'>Gagal, username telah tersedia</div>";
		}else{
			$insert = "INSERT INTO users_auth (username, unit, level, created_date) 
	 				 VALUES('$_POST[username]', '$_POST[unit]', 'admin', '$date')";
		 	// echo $insert;
			$cek = $mysqli->query($insert);	
			if($cek){
				echo "<div class='alert alert-success'>User berhasil ditambah</div>";
			}else{
				echo "<div class='alert alert-danger'>Gagal, silahkan periksa inputan</div>";
			}
		}
	}
	else if($act=='addQst'){
		$username = $_POST['username'];
		$id_srv = $_POST['id_srv'];
		$id_matkul = $_POST['id_matkul'];
		$id_q = $_POST['id_q'];
		$id_style_ans = $_POST['id_style_ans'];
		$level = $_SESSION['level'];
		$unit = $_SESSION['status'] ;

		// echo "seluruh". print_r($_POST). "<br/><br/>";
		// echo "chosen ".var_dump($_POST['chosen'])."<br/>";
		// echo "id_style_ans". var_dump($_POST['id_style_ans']);
		// echo "<br/><br/>";
		if(!isset($id_matkul)){
			$data = $_POST['chosen'];
			foreach ($_POST['id_q'] as $key => $value) {
				// echo "Key ". $key." id_q ".$value. " id_style_ans ". $_POST['id_style_ans'][$key];
				$id_style = $_POST['id_style_ans'][$key];
				if($_POST['id_style_ans'][$key]=='2'){
					// echo " ".$value. " checbox ";
					$val_chosen = "";
					$i = 0;
					$l = count($data[$value]);
					// echo " length ".$l;
					foreach($data[$value] as $a => $v) {
						if($i == $l-1) {
						    $val_chosen.= $v;
						}else{
							$val_chosen.= $v.", ";
						}
						$i++;
				    }
				    // echo $val_chosen;
				    $insert = "INSERT INTO quest_user (username, level, unit, id_survey, id_q, id_style_ans, id_matkul, answer) 
				 				 VALUES('$username', '$level', '$unit', '$id_srv','$value','$id_style','$id_matkul','$val_chosen')";
				 	// echo $insert;
					$cek = $mysqli->query($insert);	

				}else{
					$answer = $_POST['answer'][$value];
					$insert = "INSERT INTO quest_user (username, level, unit, id_survey, id_q, id_style_ans, id_matkul, answer) 
				 				 VALUES('$username', '$level', '$unit', '$id_srv','$value','$id_style','$id_matkul','$answer')";
				 	$cek = $mysqli->query($insert);
					// echo " Jawabn ". $_POST['answer'][$value]. "<br/>";
				}
			}
			if($cek){
				echo "Sukses Jawab Survey";
			}else{
				echo "Gagal, Silahkan cek kembali";
			}
		}else if(isset($id_matkul)){
			$data = $_POST['chosen'];
			foreach ($_POST['id_q'] as $key => $value) {
				// echo "Key ". $key." id_q ".$value. " id_style_ans ". $_POST['id_style_ans'][$key];
				$id_style = $_POST['id_style_ans'][$key];
				if($_POST['id_style_ans'][$key]=='2'){	
					// echo " ".$value. " checbox ";
					$val_chosen = "";
					$i = 0;
					$l = count($data[$value]);
					// echo " length ".$l;
					foreach($data[$value] as $a => $v) {
						if($i == $l-1) {
						    $val_chosen.= $v;
						}else{
							$val_chosen.= $v.", ";
						}
						$i++;
				    }
				   	$insert_q = "INSERT INTO quest_user (username, level,unit, id_survey, id_q, id_style_ans, id_matkul, answer) 
				 				 VALUES('$username', '$level','$unit', '$id_srv','$value','$id_style','$id_matkul','$val_chosen')";
				 	// echo " style2 ". $insert."<br/>";
					$insert = $mysqli->query($insert_q);	
				}else{
					$answer = $_POST['answer'][$value];
					$insert_q = "INSERT INTO quest_user (username, level, unit, id_survey, id_q, id_style_ans, id_matkul, answer) 
				 				 VALUES('$username','$level','$unit', '$id_srv','$value','$id_style','$id_matkul','$answer')";
				 	// echo $insert."<br/>";
				 	$insert = $mysqli->query($insert_q);
					// echo " Jawabn ". $_POST['answer'][$value]. "<br/>";
				}
			}
			if($insert){
				$query_priode = "SELECT max(k.thn_ajaran) as 'thn_ajaran',k.semester, m.nim from krs k, mhs m where m.username='$username' and m.nim=k.nim order by id_krs DESC limit 1";
                $result_periode = $mysqli->query($query_priode);
                $p = $result_periode->fetch_assoc();

				$q_cek = "SELECT id_matkul from krs where nim ='$p[nim]' and  thn_ajaran='$p[thn_ajaran]' and semester='$p[semester]' and id_matkul NOT IN (select id_matkul from quest_user where username='$username' and id_survey='$id_srv' group by id_matkul)";

				// echo $q_cek;
				$r_cek = $mysqli->query($q_cek);

				$row_cek = $r_cek->fetch_assoc();	

				$home = base64_encode('dashboard_tampilan_home_pengguna');
				if(!isset($row_cek)){
					echo "<script type='text/javascript'>
					document.location.href='../../?d=$home';
					</script>";	
				}else{
					$qst = base64_encode("tampilan_question_mahasiswa");
	                $id_survey = base64_encode($_POST['id_srv']);

					echo "<script type='text/javascript'>
					document.location.href='../../?d=$qst&srv=$id_survey';
					</script>";	
				}
			}
		}
	}elseif($act=='addSurvey'){
		$username = $_SESSION['username_q'];
		$title = $_POST['title'];
		$id_owner = '';
		$level = $_SESSION['level'];
		if($level=='super'){
			$obj = explode('-', $_POST['id_owner']);
			$id_owner = $obj[0];
		}else{
			$id_owner = $_SESSION['status'];
		}
		
		$mat_kul = $_POST['mat_kul'];
		$unit = $_POST['unit_kerja'];

		$date = explode(' - ', $_POST['tgl']);

		$date1 = explode('/', $date[0]);
		$date2 = explode('/', $date[1]);

		$start_date = $date1[2]."-".$date1[0]."-".$date1[1];
		$due_date = $date2[2]."-".$date2[0]."-".$date2[1];

		$query_priode = "SELECT max(thn_ajaran) as 'thn_ajaran',semester from krs order by id_krs DESC limit 1";
		// echo $query_priode;
        $result_periode = $mysqli->query($query_priode);
        $p = $result_periode->fetch_assoc();

        // var_dump($_POST);
        // var_dump($_SESSION);

        $res="";

		if($level=='unit' || $level=='super'){
			// tiap unit
			if($mat_kul=='1'){
				$qu = "SELECT thn_ajaran, semester FROM survey where thn_ajaran='$p[thn_ajaran]' and semester='$p[semester]' and id_owner='$id_owner'";
				$cek = $mysqli->query($qu);
				$cek2 = $cek->num_rows;
				// echo "cek ". $cek2;

				if($cek2>0){
					$nama_unit = $mysqli->query("SELECT nama_unit FROM unit_kerja where id_unit='$value'")->fetch_object()->nama_unit;
					echo "Survey matakuliah di $nama_unit pada semester ini sudah ada <br/>";
				}else{
					$q_insert = "INSERT INTO survey (id_owner, created_by, matakuliah, title, start_date, due_date, mhs, thn_ajaran, semester) VALUES('$id_owner', '$username', '1' ,'$title', '$start_date', '$due_date','1', '$p[thn_ajaran]', '$p[semester]')";
					// echo $q_insert;
					$insert = $mysqli->query($q_insert);
					if($insert){
						$res = "Survey Berhasil Ditambah";
					}else{
						$res = "Gagal, Silahkan cek kembali data yang diinput";
					}
				}
			}else{
				$q_insert = "INSERT INTO survey (id_owner, created_by, matakuliah, title, start_date, due_date) 
					VALUES('$id_owner', '$username', '0' ,'$title', '$start_date', '$due_date')";
				// echo $q_insert;
				$insert = $mysqli->query($q_insert);
				if($insert){
					$res = "Survey Berhasil Ditambah";
				}else{
					$res = "Gagal, Silahkan cek kembali data yang diinput";
				}
			}
			
			$max = $mysqli->query("SELECT max(id_survey) as max FROM survey")->fetch_object()->max;
			foreach ($_POST['sampel'] as $key => $value) {
				$mysqli->query("UPDATE survey set $value=1 WHERE id_survey ='$max'");
			}

			foreach ($unit as $key => $value) {
				$obj = explode('-', $value);

				$q_insert = "INSERT INTO survey_objective (survey_id, objective, nama_objective) 
					VALUES($max, '$obj[0]', '$obj[1]')";
				
				$insert = $mysqli->query($q_insert);
				if($insert){
					$res = "Survey Berhasil Ditambah";
				}else{
					$res = "Gagal, Silahkan cek kembali data yang diinput";
				}
			}
			
			echo $res;
		}elseif($level=='fakultas'){
			if($mat_kul=='1'){
				$qu = "SELECT thn_ajaran, semester FROM survey where thn_ajaran='$p[thn_ajaran]' and semester='$p[semester]' and id_owner='$id_owner'";
				// echo $qu;
				$cek = $mysqli->query($qu);
				$cek2 = $cek->num_rows;

				if($cek2>0){
					echo "Survey matakuliah pada semester ini sudah ada";
				}else{
					$q_insert = "INSERT INTO survey (id_owner, created_by, matakuliah, title, start_date, due_date, mhs, thn_ajaran, semester) 
					VALUES('$id_owner', '$username', '1' ,'$title', '$start_date', '$due_date', '1', '$p[thn_ajaran]', '$p[semester]')";
					$insert = $mysqli->query($q_insert);

					if($insert){
						$res = "Survey Berhasil Ditambah";
					}else{
						$res = "Gagal, Silahkan cek kembali data yang diinput";
					}
				}
			}else{
				$insert = $mysqli->query("INSERT INTO survey (id_owner, created_by, matakuliah, title, start_date, due_date) 
						VALUES('$id_owner', '$username', '0' ,'$title', '$start_date', '$due_date')");

				if($insert){
					$res = "Survey Berhasil Ditambah";
				}else{
					$res = "Gagal, Silahkan cek kembali data yang diinput";
				}
			}

			$max = $mysqli->query("SELECT max(id_survey) as max FROM survey")->fetch_object()->max;

			foreach ($_POST['sampel'] as $key => $value) {
				$mysqli->query("UPDATE survey set $value=1 WHERE id_survey ='$max'");
			}


			$q_insert = "INSERT INTO survey_objective (survey_id, objective) 
					VALUES($max, '$id_owner')";
			// echo $q_insert;
			$insert = $mysqli->query($q_insert);
			if($insert){
				$res = "Survey Berhasil Ditambah";
			}else{
				$res = "Gagal, Silahkan cek kembali data yang diinput";
			}
			echo $res;
		}
	}elseif($act=='newQstAdd'){		
		// var_dump($_POST);

		$question = $_POST['question'];
		$style = $_POST['style'];

		$value_chosen = " ";
		// echo "<br/>$val_chosen";

		$length = count($_POST['value_style_ans']);

		for($i=0; $i<$length; $i++){
			if($i==$length-1){
				$value_chosen.=ucwords($_POST['value_style_ans'][$i]).'';
			}else{
				$value_chosen.=ucwords($_POST['value_style_ans'][$i]).', ';
			}
		}

		$hasil = '';
		foreach ($_POST['id_s'] as $key => $value) {
			if(!isset($_POST['value_style_ans'])){
				$query = "INSERT INTO question (id_survey, question, id_style_ans)
								VALUES('$value','$question' ,'$style')";
				// echo $query;
				$sql_insert = $mysqli->query($query);

				if($sql_insert){
					$hasil='sukses';
				}else{
					$hasil='gagal';
				}
			}else{
				// echo $value_chosen."<br/>";
				$query = "INSERT INTO question (id_survey, question, id_style_ans, answer_value)
									VALUES('$value','$question' ,'$style', '$value_chosen')";
				// echo $query;
				$sql_insert = $mysqli->query($query);

				if($sql_insert){
					$hasil='sukses';
				}else{
					$hasil='gagal';
				}
			}
		}

		if($hasil=='sukses'){
			echo "<div class='alert alert-success alert-dismissable fade in'>
  					<strong>Sukses!</strong> Pertanyaan berhasil ditambah
				</div>";
		}else{
			echo "<div class='alert alert-danger alert-dismissable fade in'>
  					<strong>Gagal!</strong> Periksa kembali pertanyaan yang ditambah
				</div>";
		}

		
	}elseif($act=='editSrv'){
		
		$query = "SELECT *from survey where id_survey='$_POST[srv]'";
		
        $result = $mysqli->query($query);

        $row = $result->fetch_assoc();
            echo "
                <form id='form_editSurvey' action='#' method='post'>
                    <input type='hidden' name='id_survey' value='$row[id_survey]'>
                    <div class='form-group'>
                        <label for='name-survey' class='control-label'>Judul Survey: </label>
                        <input type='text' class='form-control' name='title' required='' id='title' value='$row[title]'>
                    </div>
                    <div class='form-group'>
                        <label for='name-survey' class='control-label'>Jangka Waktu: </label>
                        <input type='text' class='form-control date-range-picker' value='$row[start_date] - $row[due_date]' required='' name='tgl' id='tanggal'>
                    </div>
                    <div class='form-group'>
                        <label for='name-survey' class='control-label'>Sampel: </label>
                        ";
                        if($row[mhs]=='1'){
                            echo "<div class='ckbox ckbox-theme'>
                                <input id='mhs' type='checkbox' name='sampel1' value='Mahasiswa' checked>
                                <label for='mhs'>Mahasiswa</label>
                            </div>";
                        }else{
                            echo "<div class='ckbox ckbox-theme'>
                                <input id='mhs' type='checkbox' name='sampel1' value='Mahasiswa'>
                                <label for='mhs'>Mahasiswa</label>
                            </div>";
                        }
                        if($row[dsn]=='1'){
                            echo "<div class='ckbox ckbox-theme'>
                                <input id='dsn' type='checkbox' name='sampel2' value='Dosen' checked>
                                <label for='dsn'>Dosen</label>
                            </div>";
                        }else{
                            echo "<div class='ckbox ckbox-theme'>
                                <input id='dsn' type='checkbox' name='sampel2' value='Dosen'>
                                <label for='dsn'>Dosen</label>
                            </div>";
                        }
                        if($row[pgw]=='1'){
                            echo "<div class='ckbox ckbox-theme'>
                                <input id='pgw' type='checkbox' name='sampel3' value='Pegawai' checked>
                                <label for='pgw'>Pegawai</label>
                            </div>";
                        }else{
                            echo "<div class='ckbox ckbox-theme'>
                                <input id='pgw' type='checkbox' name='sampel3' value='Pegawai'>
                                <label for='pgw'>Pegawai</label>
                            </div>";
                        }
                    echo "
                    </div>
                    <div class='modal-footer'>
                        <input type='Submit' class='btn btn-theme btn-push' value='Update' id='update_srv'>
                        <input type='reset' class='btn btn-danger btn-push' data-dismiss='modal' value='Cancel'>
                    </div>
                </form>
            ";
	}elseif($act=='editSrvAct'){
		$sampel1 =$_POST['sampel1'];
		$sampel2 =$_POST['sampel2']; 
		$sampel3 =$_POST['sampel3']; 
		$id_survey= $_POST['id_survey'];

		$date = explode(' - ', $_POST['tgl']);

		$date1 = explode('/', $date[0]);
		$date2 = explode('/', $date[1]);

		$start_date = $date1[2]."-".$date1[0]."-".$date1[1];
		$due_date = $date2[2]."-".$date2[0]."-".$date2[1];

		$update = $mysqli->query("UPDATE survey set title='$_POST[title]',
						start_date='$start_date', due_date='$due_date' WHERE id_survey ='$id_survey'");

		if(isset($sampel1)){
			$mysqli->query("UPDATE survey set mhs=1 WHERE id_survey ='$id_survey'");
		}else{
			$mysqli->query("UPDATE survey set mhs=0 WHERE id_survey ='$id_survey'");
		}
		if(isset($sampel2)){
			$mysqli->query("UPDATE survey set dsn=1 WHERE id_survey ='$id_survey'");
		}else{
			$mysqli->query("UPDATE survey set dsn=0 WHERE id_survey ='$id_survey'");
		}
		if(isset($sampel3)){
			$mysqli->query("UPDATE survey set pgw=1 WHERE id_survey ='$id_survey'");	
		}else{
			$mysqli->query("UPDATE survey set pgw=0 WHERE id_survey ='$id_survey'");
		}

		$listSurvey = base64_encode('list_survey_pengguna_admin');
		echo"<script>
			document.location.href='?d=$listSurvey';
		</script>";

	}elseif($act=='deleteSrv'){		
		$query_delete1 = "DELETE FROM survey WHERE id_survey='$_POST[srv]'";
		echo "$query_delete1";
		$delete1 = $mysqli->query($query_delete1);

		$query_delete2 = "DELETE FROM question WHERE id_survey='$_POST[srv]'";
		echo "$query_delete2";
		$delete2 = $mysqli->query($query_delete2);

	}elseif($act=='deleteQst'){
		$query_delete = "DELETE FROM question WHERE id_survey=$_POST[srv] and id_q=$_POST[qst]";
		$delete = $mysqli->query($query_delete);	

	}elseif($act=='deleteUser'){
		$query_delete = "DELETE FROM users_auth WHERE id=$_POST[id]";
		$delete = $mysqli->query($query_delete);	

	}elseif($act=='editQstAct'){
		$update = $mysqli->query("UPDATE question set question='$_POST[question]' WHERE id_survey ='$_POST[id_survey]' and id_q='$_POST[id_question]'");		
		echo "<script type='text/javascript'>
		window.history.back();
		</script>";		

	}elseif($act=='newProfSkala'){
		$value_p = "";
		
		$length = count($_POST['value']);

		for($i=0; $i<$length; $i++){
			if($i==$length-1){
				$value_p.=ucwords($_POST['value'][$i]).'';
			}else{
				$value_p.=ucwords($_POST['value'][$i]).', ';
			}
		}
		$insert = $mysqli->query("INSERT INTO profile (skala, profile, value) VALUES('$_POST[skala]', '$_POST[nama_profile]','$value_p')");

		if($insert){
			echo"<script>
				document.location.href='?d=addProfile';
			</script>";			
		}else{
			?>
			<script>
				$(document).ready(function () {
					$('#addProfile').modal('hide');
				});
			</script>
			<?php
		}	
	}elseif($act=='deleteProf'){
		
		$delete = $mysqli->query("DELETE FROM profile WHERE id='$_GET[id]'");
		
		echo "<script type='text/javascript'>
		window.history.back();
		</script>";		

	}elseif($act=='editProfile'){
		$id=$_POST['id'];
		$query = "SELECT *FROM profile where id='$id'";

		$data = $mysqli->query($query);
		$q = $data->fetch_assoc();

		$val = explode(', ', $q['value']);
		echo "
		<form method='post' action='mods/backend/act.php?act=editAction'>			
			<input type='hidden' name='id' class='form-control' value='$id'>
			";

			for($i=0; $i<=count($val)-1; $i++){
				$j = $i+1;
				echo "
					<div class='form-group'>
						<label for='name' class='control-label'> Value $j: </label>
						<input type='text' class='form-control' id='profile' name='value[]' value='$val[$i]' required>
		            </div>
				";
			}
		echo "
			<div class='modal-footer'>
				<input type='submit' value='Update' class='btn btn-theme btn-push' id='update'>
				<button class='btn btn-danger btn-push' data-dismiss='modal'>Cancel</button>
		  	</div>
		</form>
		";
	}elseif($act=='editQst'){
		$id_survey = $_POST['srv'];
		$id_q = $_POST['qst'];

		$query = "SELECT *FROM question where id_survey='$id_survey' and id_q='$id_q'";

		$data = $mysqli->query($query);
		$q = $data->fetch_assoc();

		echo "
		<form method='post' action='mods/backend/act.php?act=editQstAction'>			
			<input type='hidden' name='srv' class='form-control' value='$id_survey'>
			<input type='hidden' name='qst' class='form-control' value='$id_q'>
			<input type='text' class='form-control' name='question' value='$q[question]' required>
			<div class='modal-footer'>
				<input type='submit' value='Update' class='btn btn-theme btn-push' id='update'>
				<button class='btn btn-danger btn-push' data-dismiss='modal'>Cancel</button>
		  	</div>
		</form>
		";
	}elseif($act=='showObj'){
		$id_survey = $_POST['srv'];

		$query = "SELECT *FROM survey_objective where survey_id='$id_survey'";

		$data = $mysqli->query($query);

		echo "
		<form method='post' action='mods/backend/act.php?act=showObjAction'>			
			<input type='hidden' name='srv' class='form-control' value='$id_survey'>

			<select class='form-control select2' name='obj'>
			";
			while($obj = $data->fetch_assoc()){
				echo "<option value='$obj[objective]'>$obj[nama_objective]</option>";
			}
		echo "
			</select>

			<div class='modal-footer'>
				<input type='submit' value='Lihat Pertanyaan' class='btn btn-theme'>
				<button class='btn btn-danger' data-dismiss='modal'>Cancel</button>
		  	</div>
		</form>
		";
		
	}elseif($act=='showObjAction'){
		$list_quest = base64_encode("list_question_obj_pengguna_admin");
		$srvey = base64_encode($_POST['srv']);
		$obj = $_POST['obj'];
		echo "<script type='text/javascript'>
				document.location.href='../../?d=$list_quest&srv=$srvey&obj=$obj';
			</script>";
		
	}
	elseif($act=='editUser'){
		$id = $_POST['id'];

		$query = "SELECT *FROM users_auth where id='$id'";

		$data = $mysqli->query($query);
		$q = $data->fetch_assoc();

		echo "
		<form method='post' action='mods/backend/act.php?act=editUserAction'>			
			<input type='hidden' name='id' class='form-control' value='$id'>
			
			<input type='text' class='form-control' name='username' value='$q[username]' required>
			<div class='modal-footer'>
				<input type='submit' value='Update' class='btn btn-theme btn-push' id='update'>
				<button class='btn btn-danger btn-push' data-dismiss='modal'>Cancel</button>
		  	</div>
		</form>
		";
	}elseif($act=='editAction'){
		$length = count($_POST['value']);

		$value_p = "";
		for($i=0; $i<$length; $i++){
			if($i==$length-1){
				$value_p.=ucwords($_POST['value'][$i]).'';
			}else{
				$value_p.=ucwords($_POST['value'][$i]).', ';
			}
		}
		$update = $mysqli->query("UPDATE profile set value='$value_p' WHERE id ='$_POST[id]'");

		if($update){
			echo "<script type='text/javascript'>
					window.history.back();
				</script>";
		}
	}elseif($act=='editQstAction'){
		$update = $mysqli->query("UPDATE question set question='$_POST[question]' WHERE id_survey ='$_POST[srv]' and id_q='$_POST[qst]'");

		if($update){
			echo "<script type='text/javascript'>
					window.history.back();
				</script>";
		}
	}elseif($act=='editUserAction'){
		$update = $mysqli->query("UPDATE users_auth set username='$_POST[username]' WHERE id ='$_POST[id]'");

		if($update){
			echo "<script type='text/javascript'>
					window.history.back();
				</script>";
		}
	}elseif($act=='showChosen'){
		$id_survey = $_POST['srv'];
		$id_q = $_POST['qst'];

		$query = "SELECT *FROM question where id_survey='$id_survey' and id_q='$id_q'";


		$data = $mysqli->query($query);
		$q = $data->fetch_assoc();
		if($q['id_style_ans']==1){
			$val = explode(', ', $q['answer_value']);
			foreach ($val as $key => $value) {
				// echo $key." . ";
				echo "
				
                <div class='rdio radio-inline rdio-theme rounded'>
                    <input id='radioChosen$key' type='radio' name='radio'>
                    <label for='radioChosen$key'>$value</label>
                </div>
				";
			}
		}else if($q['id_style_ans']==2){
			$val = explode(', ', $q['answer_value']);
			foreach ($val as $key => $value) {
				// echo $value."<br/>";
				echo "
				<div class='ckbox ckbox-theme'>
                    <input id='chosen$key' class='sampel' type='checkbox' name='sampel[]' value='mhs'>
                    <label for='chosen$key' class='control-label'>$value</label>
                </div>
                <div class='ckbox ckbox-theme'>
                    <input id='chosen$key' class='sampel' type='checkbox' name='sampel[]' value='dsn'>
                    <label for='chosen$key' class='control-label'>$value</label>
                </div>
				";
			}
		}
	}elseif($act=='copySurvey'){
		// var_dump($_POST);
		$title = $_POST['title'];
		$level = $_SESSION['level'];

		if($level=='super'){
			$owner = explode('-', $_POST['id_owner']);
			$id_owner = $owner[0];
		}else{
			$id_owner = $_SESSION['status'];
		}
		$mat_kul = $_POST['mat_kul'];
		$unit = $_POST['unit_kerja'];

		$date = explode(' - ', $_POST['tgl']);

		$date1 = explode('/', $date[0]);
		$date2 = explode('/', $date[1]);

		$start_date = $date1[2]."-".$date1[0]."-".$date1[1];
		$due_date = $date2[2]."-".$date2[0]."-".$date2[1];

		$query_priode = "SELECT max(thn_ajaran) as 'thn_ajaran',semester from krs order by id_krs DESC limit 1";
        $result_periode = $mysqli->query($query_priode);
        $p = $result_periode->fetch_assoc();

        $res='';
		if($level=='unit' || $level=='super'){
			// tiap unit

			if($mat_kul=='1'){
				$q_insert = "INSERT INTO survey (id_owner, created_by, matakuliah, title, start_date, due_date, mhs, thn_ajaran, semester) VALUES('$id_owner', '$_SESSION[username_q]', '1' ,'$title', '$start_date', '$due_date','1', '$p[thn_ajaran]', '$p[semester]')";
				// echo $q_insert;
				$insert = $mysqli->query($q_insert);
				if($insert){
					$res = "sukses";
				}else{
					$res = "gagal";
				}
			}else{
				$q_insert = "INSERT INTO survey (id_owner, created_by, matakuliah, title, start_date, due_date) 
					VALUES('$id_owner', '$_SESSION[username_q]','0' ,'$title', '$start_date', '$due_date')";
				// echo $q_insert;
				$insert = $mysqli->query($q_insert);
				
				if($insert){
					$res = "sukses";
				}else{
					$res = "gagal";
				}

				$max = $mysqli->query("SELECT max(id_survey) as max FROM survey where created_by='$_SESSION[username_q]'")->fetch_object()->max;

				foreach ($_POST['sampel'] as $key1 => $value1) {
					$mysqli->query("UPDATE survey set $value1=1 WHERE id_survey ='$max'");
				}

				foreach ($unit as $key => $value) {
					$obj = explode('-', $value);

					$q_insert = "INSERT INTO survey_objective (survey_id, objective, nama_objective) 
						VALUES($max, '$obj[0]', '$obj[1]')";
					
					$insert = $mysqli->query($q_insert);
					if($insert){
						$res = "Survey Berhasil Ditambah";
					}else{
						$res = "Gagal, Silahkan cek kembali data yang diinput";
					}
				}
			}

			$max = $mysqli->query("SELECT max(id_survey) as max FROM survey where created_by='$_SESSION[username_q]'")->fetch_object()->max;

			if($res='sukses'){
				$result='';

				$q = "SELECT *from question where id_survey='$_POST[id_survey]'";
		        $r_n = $mysqli->query($q);

		        while($qst = $r_n->fetch_assoc()){
		        	$insert_q = "INSERT INTO question (id_survey, question, id_style_ans, answer_value)
										VALUES('$max','$qst[question]' ,'$qst[id_style_ans]', '$qst[answer_value]')";
		        	$insert_qst = $mysqli->query($insert_q);
		        	if($insert_qst){
		        		$result='Pertanyaan berhasil disalin ke survey baru';
		        	}else{
		        		$result='Gagal salin survey, silahkan cek kembali';
		        	}
		        }
		        echo $result;
			}else{
				echo "Gagal salin survey, silahkan cek kembali";
			}

		}elseif($level=='fakultas'){

			if($mat_kul=='1'){
				$q_insert = "INSERT INTO survey (id_owner, created_by,matakuliah, title, start_date, due_date, mhs, thn_ajaran, semester) VALUES('$id_owner', '$_SESSION[username_q]', '1' ,'$title', '$start_date', '$due_date','1', '$p[thn_ajaran]', '$p[semester]')";
				// echo $q_insert;
				$insert = $mysqli->query($q_insert);
				if($insert){
					$res = "sukses";
				}else{
					$res = "gagal";
				}
			}else{
				$q_insert = "INSERT INTO survey (id_owner, matakuliah, title, start_date, due_date) 
					VALUES('$id_owner','0' ,'$title', '$start_date', '$due_date'";
				$insert = $mysqli->query($q_insert);
				
				if($insert){
					$res = "sukses";
				}else{
					$res = "gagal";
				}
				$max = $mysqli->query("SELECT max(id_survey) as max FROM survey where created_by='$_SESSION[username_q]'")->fetch_object()->max;

				foreach ($_POST['sampel'] as $key => $value) {
					$mysqli->query("UPDATE survey set $value=1 WHERE id_survey ='$max'");
				}

				$q_insert = "INSERT INTO survey_objective (survey_id, objective) 
					VALUES($max, '$id_owner')";
				
				$insert = $mysqli->query($q_insert);

				if($insert){
					$res = "Survey Berhasil Ditambah";
				}else{
					$res = "Gagal, Silahkan cek kembali data yang diinput";
				}
			}

			if($res='sukses'){
				$max = $mysqli->query("SELECT max(id_survey) as max FROM survey where created_by='$_SESSION[username_q]'")->fetch_object()->max;
				
				$result='';
				$q = "SELECT *from question where id_survey='$_POST[id_survey]'";
		        $r_n = $mysqli->query($q);

		        while($qst = $r_n->fetch_assoc()){
		        	$insert_q = "INSERT INTO question (id_survey, question, id_style_ans, answer_value)
										VALUES('$max','$qst[question]' ,'$qst[id_style_ans]', '$qst[answer_value]')";
		        	$insert_qst = $mysqli->query($insert_q);
		        	if($insert_qst){
		        		$result='Pertanyaan berhasil disalin ke survey baru';
		        	}else{
		        		$result='Gagal salin survey, silahkan cek kembali';
		        	}
		        }
		        echo $result;
			}else{
				echo "Gagal salin survey, silahkan cek kembali";
			}
		}
	}elseif($act=='getMaxSrv'){
		// echo "SELECT max(id_survey) as max FROM survey where created_by='$_POST[username_q]'";
		$max = $mysqli->query("SELECT max(id_survey) as max FROM survey where created_by='$_SESSION[username_q]'")->fetch_object()->max;
		echo $max;
		// echo " Query SELECT max(id_survey) as max FROM survey where username='$_POST[username]' ";
		// var_dump($_POST);
	}elseif($act=='jlh_tanya'){
		$id_survey = $mysqli->query("SELECT id_survey FROM survey where id_survey='$_POST[id_survey]' order by id_survey desc limit 1")->fetch_object()->id_survey;

		// $id_survey = $_POST['id_survey'];

		$query_c = "SELECT question from question where id_survey='$id_survey'";
	    $data_c = $mysqli->query($query_c);
	    $total = $data_c->num_rows;
	    $pertanyaan = $total+1;

	    echo "<i>( Pertanyaan ke $pertanyaan )</i>";

	}elseif ($act=='cek_survey') {
		$id_survey = $mysqli->query("SELECT id_survey FROM quest_user where id_survey='$_POST[id_survey]'")->fetch_object()->id_survey;
		if(!isset($id_survey)){
			echo "Sampel Belum Ada";
		}else{
			echo "Laporan";
		}
	}elseif ($act=='download_pdf') {
		// var_dump($_POST);
		echo "<center><button class='btn btn-theme btn-md' onclick='print_laporan()'><i class='fa fa-file-pdf-o fa-2x' aria-hidden='true'></i> <font size='4pt'>Print Laporan </font> </button></center>";
		?>

		<script>
		    function print_laporan(){
		        <?php
		            $a = base64_encode($_POST['id_survey']);
		            $b = base64_encode($_POST['style_survey']);
		        // $download = base64_encode("mods/backend/download_pdf.php");
		        echo "window.open('download_pdf.php?ids=$a&ss=$b','_blank');";
		        ?>
		    }
		</script>
		<?php
	}
?>
