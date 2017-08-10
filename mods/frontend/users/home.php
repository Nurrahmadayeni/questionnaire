<div class="col-md-12">
	<div class="panel-body-link">        
        <a><label><h4 class="pull-left"><i class="fa fa-list" aria-hidden="true"></i> Daftar Survey</h4></a>
    </div>
    <hr class="title">
</div>
<div class="row">
	<div class="col-md-12">
	    <div class="panel rounded shadow panel-default">
	        <div class="panel-body">
	        	<div id='response'></div>
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

	                        $query="";
	                        if($_SESSION['level']=='dsn'){
	                        	$query = "SELECT s.id_survey, s.id_owner, s.title, s.start_date, s.due_date from survey s, survey_objective so where so.objective='$_SESSION[status]' AND so.survey_id=s.id_survey AND s.dsn=1 ORDER BY s.due_date ASC";
	                        }else if($_SESSION['level']=='pgw'){
	                        	$query = "SELECT s.id_survey, s.id_owner, s.title, s.start_date, s.due_date from survey s, survey_objective so where so.objective='$_SESSION[status]' AND so.survey_id=s.id_survey AND s.pgw=1 ORDER BY s.due_date ASC";
	                        }else{
	                        	$query = "mahasiswa";
	                        }

	                        // echo $query;
	                        $result = $mysqli->query($query);

	                        while ($row = $result->fetch_assoc()) {
	                        	$qst = base64_encode("tampilan_question_pengguna");
	                        	$id_survey = base64_encode($row['id_survey']);

	                        	$cek = $mysqli->query("SELECT id_survey from quest_user WHERE id_survey='$row[id_survey]' and username='$_SESSION[username]'")->fetch_object()->id_survey;

	                        	if(isset($cek)){
	                        		echo "<tr title='Survey ini sudah dijawab' data-toggle='tooltip' data-placement='top'>";
	                        	}else{
	                        		echo "<tr class='clickable-row' data-href='?d=$qst&srv=$id_survey' title='Klik untuk menjawab survey ini' data-toggle='tooltip' data-placement='top'>";
	                        	}
	                        	 echo "<td class='text-center' data-hide='phone'>".$no."</td>";
	                        		echo "<td>".$row['id_owner']."</td>";
		                           	echo "<td>".$row['title']."</td>";
		                            echo "<td class='text-center'>".$row['start_date']." s/d ".$row['due_date']."</td>";
		                            echo "</tr>";
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