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
	                    	// var_dump($_SESSION);
	                        $no=1;
	                        $query = "SELECT *from survey where objective='$_SESSION[status]' AND dsn=1 and id_survey NOT IN (SELECT id_survey from quest_user WHERE username='$_SESSION[username]') ORDER BY due_date ASC";
	                        // echo $query;
	                        $result = $mysqli->query($query);

	                        while ($row = $result->fetch_assoc()) {
	                        	$qst = base64_encode("tampilan_question_dosen");
	                        	$id_survey = base64_encode($row['id_survey']);

	                            echo "<tr class='clickable-row' data-href='?d=$qst&srv=$id_survey'>";
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