<?php
	session_start();
	error_reporting(0);

	include "../../../lib/config.php";

	$thn = "SELECT max(thn_ajaran) as thn_ajaran from krs order by id_krs";
    $r_t = $mysqli->query($thn);
    $tahun = $r_t->fetch_assoc();

	$status = $mysqli->query("SELECT nama_unit FROM unit_kerja WHERE id_unit='$_SESSION[status]'")->fetch_object()->nama_unit;

	$q_m = "SELECT k.id_matkul, m.nama_matkul from krs k, mat_kul m where k.thn_ajaran='$tahun[thn_ajaran]' and k.id_matkul=m.id_matkul and m.id_fak='$_POST[id_fak]' group by id_matkul";
    // echo $q_m;
    $r_m = $mysqli->query($q_m);

    $cek = $r_m->num_rows;
    if($cek>0){
    	 echo "<input type='hidden' name='id_survey' value='$_POST[srv]' id='id_survey'>";
		echo "<input type='hidden' name='id_q' value='$_POST[qst]' id='id_q'>";
	    
	    echo " <select class='form-control mb-15' id='matkul_diagram' required='' placeholder='-- Pilih Matakuliah --'>
	        <option value='' selected disabled>-- Pilih Matakuliah --</option>";

	    while ($mata = $r_m->fetch_assoc()) {
	        echo "<option value='$mata[id_matkul]'>".$mata['nama_matkul']."</option>";
	    }
	    echo "</select><div id='show_diagram'></div>";
    }else{
    	echo "Belum ada matakuliah di database pada fakultas ini";
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
    });
</script>