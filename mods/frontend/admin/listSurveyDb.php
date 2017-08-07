<?php  
    if($_SESSION['level']=='super'){ ?>

<table class='table table-theme hover' id="data">
    <thead>
        <tr class="text-center">
            <th class="text-center" width="5%">No</th>
            <th class="text-center">Judul Survey</th>
            <th class='text-center'>Owner</th>
            <th class='text-center'>Dibuat oleh</th>
            <th class='text-center'>Objective</th>
            <th class="text-center">Sampel</th>
            <th class="text-center">Jumlah Sampel</th>
            <th class="text-center" data-hide="phone,tablet">Jangka Waktu</th>
            <th class="text-center" data-hide="phone,tablet">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // var_dump($_SESSION);
            $no=1;
            $query = "SELECT *from survey ORDER BY due_date DESC";
            $result = $mysqli->query($query);

            while ($row = $result->fetch_assoc()) {
                $list_quest = base64_encode("list_question_pengguna_admin");
                $srvey = base64_encode($row['id_survey']);

                $mt = "";
                if($row['matakuliah']==1){
                    $mt = '(Matakuliah)';
                }
                echo "<tr>";
                echo "<td class='text-center' data-hide='phone'>".$no."</td>";
                echo "<td>".$row['title']. $mt."</td>";
            
                echo "<td>$row[id_owner]</td>";
                echo "<td>$row[created_by]</td>";
                echo "<td>$row[objective]</td>";

                $sampel='';

                if($row[mhs]=='1'){
                    $sampel = 'Mahasiswa ';
                }
                if($row[dsn]=='1'){
                    $sampel.= "Dosen ";
                }
                if($row[pgw]=='1'){
                    $sampel.='Pegawai ';
                }

                echo "<td>$sampel</td>";
                
                $query_tot = "SELECT username FROM quest_user WHERE id_survey='$row[id_survey]' GROUP by username";
                
                $data_tot = $mysqli->query($query_tot);
                    $tot = $data_tot->num_rows; 

                if($tot==0){
                     echo "<td class=text-center> <span class='label label-success'>0</span></td>";
                }else{
                     echo "<td class=text-center> <span class='label label-success'>$tot</span></td>";
                }
               
                echo "<td>".$row['start_date']. " s/d ".$row['due_date']. "</td>";              
                echo "
                    <td class='text-center' data-hide='phone,tablet'>
                    <a href='?d=$list_quest&srv=$srvey' title='Lihat Pertanyaan' data-toggle='tooltip' data-placement='top' class='btn btn-primary btn-xs '><i class='fa fa-eye'></i></a>";
                    
                    $c = $mysqli->query("SELECT username FROM quest_user WHERE id_survey = $row[id_survey]")->fetch_object()->username;

                    $enable="";
                    
                // <a href="#editSurvey" class="editSurvey btn btn-sm brn-xs btn-primary btn-xs btn-push" data-toggle="modal" title="edit" data-id='$row['id_survey']'><i class='fa fa-pencil'></i> Edit </a>
                    $quest = base64_encode("tambah_question_pengguna_admin");
                    $edit_srv = base64_encode("edit_survey_pengguna_admin");
                    $copy_srv = base64_encode("copy_survey_pengguna_admin");
                
                    if(isset($c)){
                        echo "
                            <a href='?d=$quest&srv=$srvey' title='Tambah Pertanyaan(sampel sudah ada)' data-toggle='tooltip' data-placement='top' class='btn btn-info btn-xs '><i class='fa fa-plus'></i></a>
                            <a href='?d=$copy_srv&srv=$srvey'><span data-toggle='tooltip' data-placement='top' title='Salin Pertanyaan dari Survey Ini' class='btn btn-success btn-xs '><i class='fa fa-files-o'></i> </span></a>
                            <a href='?d=$edit_srv&srv=$srvey' title='Ubah Survey(sampel sudah ada)' data-toggle='tooltip' data-placement='top' class='btn btn-xs btn-warning '><i class='fa fa-pencil'></i></a>
                            <a href='#confirm-delete-survey' class='delete-survey btn btn-xs btn-danger ' data-id='$row[id_survey]' data-toggle='modal'><span data-toggle='tooltip' data-placement='top' title='Hapus Survey(sampel sudah ada)' ><i class='fa fa-trash'></i> </span></a>";
                    }else{
                        echo "
                            <a href='?d=$quest&srv=$srvey' title='Tambah Pertanyaan' data-toggle='tooltip' data-placement='top' class='btn btn-info btn-xs '><i class='fa fa-plus'></i></a>
                            <a href='?d=$copy_srv&srv=$srvey'><span data-toggle='tooltip' data-placement='top' title='Salin Pertanyaan dari Survey Ini' class='btn btn-xs btn-success '><i class='fa fa-files-o'></i> </span></a>
                            <a href='?d=$edit_srv&srv=$srvey' title='Ubah Survey' data-toggle='tooltip' data-placement='top' class='btn btn-xs btn-warning '><i class='fa fa-pencil'></i></a>
                            <a href='#confirm-delete-survey' class='delete-survey btn btn-xs btn-danger ' data-id='$row[id_survey]' data-toggle='modal'><span data-toggle='tooltip' data-placement='top' title='Hapus Survey' ><i class='fa fa-trash'></i> </span></a>";
                    }
                     // <a href='mods/backend/act.php?act=deleteSrv&id_survey=$row[id_survey]' title='Hapus Survey' onclick='return confirm_delete()'><button class='btn btn-sm btn-danger btn-xs btn-push' $enable> <i class='fa fa-trash'></i> Delete</button></a>
                
                echo "</td></tr>";
                $no++;
            }
        ?>
        
    </tbody>
</table>

    <?php
    }elseif($_SESSION['level']=='unit' || $_SESSION['level']=='fakultas'){

?>
<table class='table table-theme hover' id="data">
    <thead>
        <tr class="text-center">
            <th class="text-center" width="5%">No</th>
            <th class="text-center">Judul Survey</th>
            <?php 
            	if($_SESSION['level']!="fakultas"){ 
            		echo "<th class='text-center'>Objective</th>";
            	}
            ?>
            <th class='text-center'>Dibuat oleh</th>
            <th class="text-center">Sampel</th>
            <th class="text-center">Jumlah Sampel</th>
            <th class="text-center" data-hide="phone,tablet">Jangka Waktu</th>
            <th class="text-center" data-hide="phone,tablet">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // var_dump($_SESSION);
            $no=1;
            $query = "SELECT *from survey where id_owner='$_SESSION[status]' ORDER BY due_date DESC";
            $result = $mysqli->query($query);

            while ($row = $result->fetch_assoc()) {
            	$list_quest = base64_encode("list_question_pengguna_admin");
             	$srvey = base64_encode($row['id_survey']);

                echo "<tr>";
                echo "<td class='text-center' data-hide='phone'>".$no."</td>";
                echo "<td>".$row['title']."</td>";
                // echo "<td></td>";
                $mt = "";
                if($row['matakuliah']==1){
                	$mt = '(Matakuliah)';
                }

            	if($_SESSION['level']=='unit'){ 

                    echo "<td>$row[objective] $mt</td>";
            	}
            	$sampel='';
                echo "<td>".$row['created_by']."</td>";
                if($row[mhs]=='1'){
                    $sampel = 'Mahasiswa ';
                }
                if($row[dsn]=='1'){
                    $sampel.= "Dosen ";
                }
                if($row[pgw]=='1'){
                    $sampel.='Pegawai ';
                }

                echo "<td>$sampel</td>";
                
                $query_tot = "SELECT username FROM quest_user WHERE id_survey='$row[id_survey]' GROUP by username";
				
				$data_tot = $mysqli->query($query_tot);
					$tot = $data_tot->num_rows;	

                if($tot==0){
                	 echo "<td class=text-center> <span class='label label-success'>0</span></td>";
                }else{
                	 echo "<td class=text-center> <span class='label label-success'>$tot</span></td>";
                }
               
                echo "<td>".$row['start_date']. " s/d ".$row['due_date']. "</td>";             	
                echo "
                    <td class='text-center' data-hide='phone,tablet'>
                    <a href='?d=$list_quest&srv=$srvey' title='Lihat Pertanyaan' data-toggle='tooltip' data-placement='top' class='btn btn-primary btn-xs '><i class='fa fa-eye'></i></a>";
                    
                    $c = $mysqli->query("SELECT username FROM quest_user WHERE id_survey = $row[id_survey]")->fetch_object()->username;

                   	$enable="";
                   	
                // <a href="#editSurvey" class="editSurvey btn btn-sm brn-xs btn-primary btn-xs btn-push" data-toggle="modal" title="edit" data-id='$row['id_survey']'><i class='fa fa-pencil'></i> Edit </a>
                   	$quest = base64_encode("tambah_question_pengguna_admin");
					$edit_srv = base64_encode("edit_survey_pengguna_admin");
					$copy_srv = base64_encode("copy_survey_pengguna_admin");
				
                    if(isset($c)){
                        echo "
                            <a href='#' title='Pertanyaan tidak bisa ditambah karena sampel sudah ada' data-toggle='tooltip' data-placement='top' class='btn btn-info btn-xs '><i class='fa fa-plus'></i></a>
                            <a href='?d=$copy_srv&srv=$srvey'><span data-toggle='tooltip' data-placement='top' title='Salin Pertanyaan dari Survey Ini' class='btn btn-success btn-xs '><i class='fa fa-files-o'></i> </span></a>
                            <a href='#' title='Survey tidak bisa diubah karena sampel sudah ada' data-toggle='tooltip' data-placement='top' class='btn btn-xs btn-warning '><i class='fa fa-pencil'></i></a>
                            <a href='#'><span data-toggle='tooltip' data-placement='top' title='Survey tidak bisa dihapus karena sampel sudah ada' class='btn btn-xs btn-danger' ><i class='fa fa-trash'></i> </span></a>";
                    }else{
                        echo "
                            <a href='?d=$quest&srv=$srvey' title='Tambah Pertanyaan' data-toggle='tooltip' data-placement='top' class='btn btn-info btn-xs '><i class='fa fa-plus'></i></a>
                            <a href='?d=$copy_srv&srv=$srvey'><span data-toggle='tooltip' data-placement='top' title='Salin Pertanyaan dari Survey Ini' class='btn btn-xs btn-success '><i class='fa fa-files-o'></i> </span></a>
                            <a href='?d=$edit_srv&srv=$srvey' title='Ubah Survey' data-toggle='tooltip' data-placement='top' class='btn btn-xs btn-warning '><i class='fa fa-pencil'></i></a>
                            <a href='#confirm-delete-survey' class='delete-survey btn btn-xs btn-danger ' data-id='$row[id_survey]' data-toggle='modal'><span data-toggle='tooltip' data-placement='top' title='Hapus Survey' ><i class='fa fa-trash'></i> </span></a>";
                    }
                     // <a href='mods/backend/act.php?act=deleteSrv&id_survey=$row[id_survey]' title='Hapus Survey' onclick='return confirm_delete()'><button class='btn btn-sm btn-danger btn-xs btn-push' $enable> <i class='fa fa-trash'></i> Delete</button></a>
                
                echo "</td></tr>";
                $no++;
            }
        ?>
        
    </tbody>
</table>
<?php } ?>