<div class="col-md-12">
	<div class="panel-body-link">        
        <a><label><h4 class="pull-left"><i class="fa fa-list" aria-hidden="true"></i>Daftar Survey</h4></a>
    </div>
    <hr class="title">
</div>
<div class="row">
	<div class="col-md-12">
	    <div class="panel rounded shadow panel-default">
	        <div class="panel-body">
	            <table class='table table-responsive table-hover table-theme' id="data">
	            	<thead>
	                    <tr class="text-center">
	                        <th class="text-center" width="5%">No</th>
	                        <th class="text-center">Survey</th>
	                        <th class="text-center">Judul Survey</th>
	                        <th class="text-center" data-hide="phone,tablet">Jangka Waktu</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php
	                        $no=1;
	                        $query_f = "SELECT f.nama_fak, m.nim from fakultas f,mhs m where m.id_user='$_SESSION[id_user]' and f.id_fak=m.id_fak";
	                        $result_f = $mysqli->query($query_f);
	                        $mhs = $result_f->fetch_assoc();

	                        $query_unit = "SELECT id_unit from unit_kerja where nama_unit='".$mhs['nama_fak']."'";
	                        $result_unit = $mysqli->query($query_unit);
	                        $unit = $result_unit->fetch_assoc();	

	                        $_SESSION['id_unit'] = $unit['id_unit']; 
	                        
	                        $query = "SELECT *from survey where objective='$unit[id_unit]' AND mhs=1 ORDER BY due_date ASC";
	                        $result = $mysqli->query($query);

	                        while ($row = $result->fetch_assoc()) {
	                        	$qst = base64_encode("tampilan_question_mahasiswa");
	                        	$id_survey = base64_encode($row['id_survey']);

	                        	if($row[matakuliah]==0){
	                        		$q_cek1 = "SELECT id_survey from quest_user where id_survey='$row[id_survey]' and id_user='$_SESSION[id_user]'";	                        		
	                        		$r_cek = $mysqli->query($q_cek1);
	                        		$row_cek = $r_cek->num_rows;		                        		

	                        		if($row_cek==0){
	                        			echo "<tr class='clickable-row' data-href='?d=$qst&srv=$id_survey'>";
			                            echo "<td class='text-center' data-hide='phone'>".$no."</td>";

			                            $query2 = "SELECT nama_unit from unit_kerja where id_unit='$row[id_owner]'";
		                        		$result2 = $mysqli->query($query2);
		                        		$unit = $result2->fetch_assoc();

		                        		echo "<td>".$unit['nama_unit']."</td>";

		                        		echo "<td>".$row['title']."</td>";
			                            echo "<td class='text-center'>".$row['start_date']." s/d ".$row['due_date']."</td>";
			                            echo "</tr>";
	                        		}else{
	                        			$no--;
	                        		}
	                        	}elseif($row['matakuliah']==1){
	                        		$query_priode = "SELECT max(k.thn_ajaran) as 'thn_ajaran',k.semester, m.nim from krs k, mhs m where m.id_user='$_SESSION[id_user]' and m.nim=k.nim order by id_krs DESC limit 1";
	                                $result_periode = $mysqli->query($query_priode);
	                                $p = $result_periode->fetch_assoc();

	                        		$q_cek2 = "SELECT id_matkul from krs where nim ='$mhs[nim]' and  thn_ajaran='$p[thn_ajaran]' and semester='$p[semester]' and id_matkul NOT IN (select id_matkul from quest_user where id_user='$_SESSION[id_user]' and id_survey='$row[id_survey]' group by id_matkul)";
	                        		// echo $q_cek2;
		                    		$r_cek2 = $mysqli->query($q_cek2);
		                    		$row_cek2 = $r_cek2->num_rows;		                    		

	                        		if($row_cek2>0){
	                        			echo "<tr class='clickable-row' data-href='?d=$qst&srv=$id_survey'>";
			                            echo "<td class='text-center' data-hide='phone'>".$no."</td>";

			                            $query2 = "SELECT nama_unit from unit_kerja where id_unit='$row[id_owner]'";
		                        		$result2 = $mysqli->query($query2);
		                        		$unit = $result2->fetch_assoc();

		                        		echo "<td>".$unit['nama_unit']." ( Matakuliah ) </td>";

		                        		echo "<td>".$row['title']."</td>";
			                            echo "<td class='text-center'>".$row['start_date']." s/d ".$row['due_date']."</td>";
			                            echo "</tr>";
	                        		}else{
	                        			$no--;
	                        		}
	                        	}

	                            $no++;
	                        }
	                    ?>
	                </tbody>
	                <tfoot>
	                    <tr>
	                        <th data-class="expand" class="text-center">No</th>
	                        <th data-hide="phone" class="text-center">Survey</th>
	                        <th data-hide="phone" class="text-center">Judul Survey</th>
	                        <th data-hide="phone,tablet" class="text-center">Jangka Waktu</th>
	                    </tr>
	                </tfoot>
	            </table>
	        </div>
	    </div>
	</div>
</div>