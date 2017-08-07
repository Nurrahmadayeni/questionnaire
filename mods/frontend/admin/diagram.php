<?php
	session_start();
	error_reporting(0);

	include "../../../lib/config.php";
	// var_dump($_POST);
	$level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super" ){ 
    	$query_tot = "SELECT username FROM quest_user where id_survey='$_POST[srv]' GROUP by username";
		// echo $query_tot."<br/>";
		$data_tot = $mysqli->query($query_tot);
		$tot = $data_tot->num_rows;	
		// echo "Total user ".$tot;

    	// echo "id fak ".$id_fak;

    	$query = "SELECT matakuliah, id_survey, title from survey where id_survey='$_POST[srv]'";
    	// echo $query;
	    $d_s = $mysqli->query($query);
	    $mt = $d_s->fetch_assoc();

    	if($mt['matakuliah'] == '1'){
    		$thn = "SELECT max(thn_ajaran) as thn_ajaran from krs order by id_krs";
    		// echo $thn;
	        $r_t = $mysqli->query($thn);
	        $tahun = $r_t->fetch_assoc();

			$status = $mysqli->query("SELECT nama_unit FROM unit_kerja WHERE id_unit='$_SESSION[status]'")->fetch_object()->nama_unit;
			// echo "Status ".$status;

	    	$id_fak = $mysqli->query("SELECT id_fak FROM fakultas WHERE nama_fak='$status'")->fetch_object()->id_fak;

	    	if($level == 'unit'){
	    		$q_fak = "SELECT *from fakultas";
	    		$r_fak = $mysqli->query($q_fak);

	    		echo "<input type='hidden' name='id_survey' value='$_POST[srv]' id='id_survey'>";
				echo "<input type='hidden' name='id_q' value='$_POST[qst]' id='id_q'>";

	    		echo " <select class='form-control mb-15' id='id_fak' required=''>
	                <option value='' selected disabled>-- Pilih Fakultas --</option>";

	            while ($fak = $r_fak->fetch_assoc()) {
	                echo "<option value='$fak[id_fak]'>".$fak['nama_fak']."</option>";
	            }

	            echo "</select><div id='show_matkul'></div>";

	    	}else{
	    		$q_m = "SELECT k.id_matkul, m.nama_matkul from krs k, mat_kul m where k.thn_ajaran='$tahun[thn_ajaran]' and k.id_matkul=m.id_matkul and m.id_fak='$id_fak' group by id_matkul";
		        // echo $q_m;
		        $r_m = $mysqli->query($q_m);
		        echo "<input type='hidden' name='id_survey' value='$_POST[srv]' id='id_survey'>";
				echo "<input type='hidden' name='id_q' value='$_POST[qst]' id='id_q'>";
		        
		        echo " <select class='form-control mb-15' id='matkul_diagram' required=''>
	                <option value='' selected disabled>-- Pilih Matakuliah --</option>";

	            while ($mata = $r_m->fetch_assoc()) {
	                echo "<option value='$mata[id_matkul]'>".$mata['nama_matkul']."</option>";
	            }
	            echo "</select><div id='show_diagram'></div>";
	    	}
	        
    	}else{
    		$q_d = " SELECT * FROM question where id_q='$_POST[qst]' GROUP BY id_q";
    		// echo $q_d;
	    	$data = $mysqli->query($q_d);

	    	$judul = $mysqli->query("SELECT question FROM question WHERE id_q='$_POST[qst]'")->fetch_object()->question;

	    	echo "
	    		<div class='row'>
				    <div class='col-md-12'>
				        <a><label><h5><i class='fa fa-question-circle' aria-hidden='true'></i> ". $judul."</h5></label></a>
				        <hr class='title'>
				    </div>
				</div>";

				$query_r = "SELECT username FROM quest_user WHERE id_survey='$_POST[srv]' and id_q='$_POST[qst]' group by id_survey, username, id_q";
				$exec = $mysqli->query($query_r);
				$total_user = $exec->num_rows;

				echo "<h4 style='text-align:center; padding-top: -10px;'>Total Responden $total_user</h4>";
				
				$mhs=''; $dsn=''; $pgw='';

				$jlh_mhs = $mysqli->query("SELECT count(username) as jlh_user from quest_user where id_survey='$_POST[srv]' and id_q='$_POST[qst]' and level='mhs' GROUP by username")->fetch_object()->jlh_user;

				if(isset($jlh_mhs)){
					$mhs = $jlh_mhs;
				}else{
					$mhs=0;
				}
				
				$jlh_dsn = $mysqli->query("SELECT count(username) as jlh_user from quest_user where level='dsn' and id_survey='$_POST[srv]' and id_q='$_POST[qst]' GROUP by username")->fetch_object()->jlh_user;
				if(isset($jlh_dsn)){
					$dsn = $jlh_dsn;
				}else{
					$dsn=0;
				}

				$jlh_pgw = $mysqli->query("SELECT count(username) as jlh_user from quest_user where level='pgw' and id_survey='$_POST[srv]' and id_q='$_POST[qst]' GROUP by username")->fetch_object()->jlh_user;
				if(isset($jlh_pgw)){
					$pgw = $jlh_pgw;
				}else{
					$pgw=0;
				}
			echo "
                <div class='row'>
                    <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
                        <div class='mini-stat-type-4 bg-theme shadow'>
                            <h3>Mahasiswa</h3>
                            <h1 class='count'>$mhs</h1>
                        </div>
                    </div>
                    <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
                        <div class='mini-stat-type-4 bg-theme shadow'>
                            <h3>Dosen</h3>
                            <h1 class='count'>$dsn</h1>
                        </div>
                    </div>
                    <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
                        <div class='mini-stat-type-4 bg-theme shadow'>
                            <h3>Pegawai</h3>
                            <h1 class='count'>$pgw</h1>
                        </div>
                    </div>
                </div>";

	    	while($row = $data->fetch_assoc()) {
	    		if($row['id_style_ans']==1){
	    			$answer1='';
	    			$profile1='';

	    			$val = explode(', ', $row['answer_value']);
	    			// print_r($val);
	    			// echo "count ". count($val);
	    			for($q=0; $q<=count($val)-1; $q++){
	    				if($q==count($val)-1){
	    					$profile1.= '"'.$val[$q].'"';
	    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[srv]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
	    					
		    				if(isset($q_answer)){
								$answer1.= number_format((($q_answer/$total_user)*100),2);
							}else{
								$answer1.= "0";
							}							
	    				}else{
	    					$profile1.= '"'.$val[$q].'"'. ", ";

	    					$eu = "SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[srv]' GROUP BY id_q, id_survey";
	    					// echo "no last ".$eu;

	    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$_POST[srv]' GROUP BY id_q, id_survey")->fetch_object()->jlh;
	    				
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
 							"stacked": true,
						    "title": {
						      "text": "Analisis (%)"
						    },
						    "plot": {
							    "aspect": "spline",
							    "tooltip": {
							      "text": "%v %",
							      "border-width": 1,
							      "border-radius": "9px",
							      "padding": "10%"							      
							    },
							    "value-box": {
					            	"text": "%v%",
								    "background-color": "white",
								    "border-width": 1,
								    "border-color": "#666699",
								    "shadow": true,
								    "padding": "10%"
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
	    			$answer='';
	    			$profile='';
	    			
	    			$val = explode(', ', $row['answer_value']);
	    			// echo "val ". count($val);

	    			$que_s = "SELECT answer FROM quest_user where id_style_ans='2' and id_q='$row[id_q]' and id_survey='$_POST[srv]'";
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
							      "border-radius": "9px",
							      "padding": "10%",
							      "callout": true,
							      "line-color": "#81B71A"
							    },    
							    "value-box": {
						      		"text": "%v%",
								    "background-color": "white",
								    "border-width": 1,
								    "border-color": "#666699",
								    "shadow": true,
								    "padding": "10%"
						    	}
							  },
						    "scale-x": {
						      "labels": myProfile
						    },
						    "series": [{
						      "values": myData,
								'background-color':'#81B71A',
								'text' : '#81B71A',
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
	    			$q_u = "SELECT answer FROM quest_user where id_q='$row[id_q]' and id_style_ans!=1 and id_style_ans!=2 ";
	    			// echo $q_u;
	    			$data_qu = $mysqli->query($q_u);

	    			$no=1;
	    			while ($answer_u = $data_qu->fetch_assoc()) {
	    				echo $no.". ". $answer_u['answer']."<br/>";
	    				$no++;
	    			}
	    		}
	    	}		
    	}
?>
<?php
}else{
    echo"<script>
            document.location.href='?d=tampilan_error_pengguna_admin';
        </script>";
}
?>

<script>
$(document).ready(function () {    
	$('#matkul_diagram').change(function(){
        var id1 = $("#id_survey").val();
        var id2 = $("#id_q").val();
        var id3 = $("#matkul_diagram").val();
        // alert(id1 +" "+ id2+" " +id3);
        $.ajax({
          url: 'mods/frontend/admin/show_diagram.php',
          data: {srv :id1, qst:id2, id_matkul:id3},
          type: 'POST',
          dataType: 'html',
          success: function(result){
            $('#show_diagram').html(); 
            $('#show_diagram').html(result); 
          }
        });
    });
    $('#id_fak').change(function(){
    	var id1 = $("#id_survey").val();
        var id2 = $("#id_q").val();
        var id3 = $("#id_fak").val();
        // alert(id1 +" "+ id2+" " +id3);
        $.ajax({
          url: 'mods/frontend/admin/show_matkul.php',
          data: {srv: id1, qst: id2, id_fak :id3},
          type: 'POST',
          dataType: 'html',
          success: function(result){
            $('#show_matkul').html(); 
            $('#show_matkul').html(result); 
          }
        });
    });
});
</script>


