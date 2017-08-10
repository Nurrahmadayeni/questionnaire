<?php
	$id_survey = base64_decode($_GET['srv']);
    
    $level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super" ){

        $query = "SELECT *from survey where id_survey='$id_survey'";
        $result = $mysqli->query($query);
        $cek = $result->num_rows;
        if($cek>0){ 
?>
<div class="row">
    <div class="col-md-12">
        <a><label><h4 class="pull-left"><i class="fa fa-list" aria-hidden="true"></i> Daftar Pertanyaan</h4></label></a>
        <hr class="title">
    </div>
</div>
<div class="row">
	<div class="col-md-12">
	    <div class="panel rounded shadow panel-default">
            <div class="panel-heading">
               <?php
                    $query = "SELECT *from survey where id_survey='$id_survey'";
                    $result = $mysqli->query($query);

                    $row = $result->fetch_assoc();
                        $c = $mysqli->query("SELECT username FROM quest_user WHERE id_survey = $id_survey")->fetch_object()->username;

                        $enable="";
                        $title='';
                        if(isset($c)){
                            if($_SESSION['level']=='super'){
                                $enable = '';
                                $title= 'Tambah pertanyaan(sampel sudah ada)';    
                            }else{
                                $enable = 'disabled';
                                $title='Pertanyaan tidak bisa ditambah karena sampel sudah ada';
                            }
                            
                        }else{
                            $enable="";
                            $title='Tambah Pertanyaan';
                        }
                        echo "
                            <div class='row'>
                                <div class='col-md-2'><label for='title-survey' class='control-label'>Judul Survey</label></div>
                                <div class='col-md-7'><label for='title-survey' class='control-label'>: $row[title]</label></div>
                                <div class='col-md-3' style='text-align:right'>
                                    <a href='?d=".base64_encode('tambah_question_pengguna_admin')."&srv=".$_GET['srv']."' title='$title' data-toggle='tooltip' data-placement='top' $enable>
                                    <button class='btn btn-theme btn-push btn-sm' $enable><i class='fa fa-plus-circle'></i> Tambah Pertanyaan</button> </a>
                                </div>
                            </div>

                            <div class='row'>
                            <div class='col-md-2'><label for='title-survey' class='control-label'>Jangka Waktu</label></div>
                            <div class='col-md-10'><label for='title-survey' class='control-label'>: $row[start_date] s/d $row[due_date]</label></div>
                            </div>
                            <div class='row'>
                            <div class='col-md-2'><label for='title-survey' class='control-label'>Sampel</label></div>
                            <div class='col-md-10'><label for='title-survey' class='control-label'>: ";
                            if($row[mhs]=='1'){
                                echo "Mahasiswa ";
                            }
                            if($row[dsn]=='1'){
                                echo "Dosen ";
                            }
                            if($row[pgw]=='1'){
                                echo "Pegawai ";
                            }
                        echo "
                            </label></div>
                            </div>

                            <div class='row'>
                            <div class='col-md-2'><label for='title-survey' class='control-label'>Jumlah Sampel</label></div>";
                            $query_tot = "SELECT username FROM quest_user WHERE id_survey='$id_survey' GROUP by username";
                                
                            $data_tot = $mysqli->query($query_tot);
                                $tot = $data_tot->num_rows; 
                            $total;
                            if($tot==0){
                                $total = '0';
                            }else{
                                $total = $tot;
                            }

                            echo "
                            <div class='col-md-10'><label for='title-survey' class='control-label'>: $total</label></div>
                            </div><br/>
                        ";
                ?>
            </div>
	        <div class="panel-body">
	            <table id="data" class="table table-responsive table-theme table-hover">
	                <thead>
	                    <tr class="text-center">
	                        <th class="text-center" width="12px">No</th>
	                        <th class="text-center">Pertanyaan</th>
	                        <th class="text-center">Jenis Pilihan Jawaban</th>
	                        <th class="text-center">Nilai Pilihan Jawaban</th>
	                        <th class="text-center">Analisis</th>
	                        <th class="text-center" data-hide="phone,tablet">Aksi</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php
	                        $no=1;
	                        $query = "SELECT q.id_q, q.question, q.id_style_ans, q. id_survey, q.answer_value, s.style_ans from question q, style_ans s where q.id_style_ans=s.id_style_ans and q.id_survey='$id_survey' order by q.id_q";
                            
	                        $result = $mysqli->query($query);

	                        while ($row = $result->fetch_assoc()) {
	                            echo "<tr>";
	                            echo "<td class='text-center' data-hide='phone'>".$no."</td>";
	                            echo "<td>".$row['question']."</td>";
	                            echo "<td>".$row['style_ans']."</td>";
	                            if($row['id_style_ans']==1 || $row['id_style_ans']==2){
	                            	echo "<td>".$row['answer_value']."</td>";
                                }else{
                                	echo "<td class='text-center'>-</td>";
                                }
	                            echo "<td class='text-center'><a href='#diagram' data-toggle='modal' class='diagram btn btn-info btn-xs' data-id='$row[id_survey]' data-id2='$row[id_q]'><span data-toggle='tooltip' data-placement='top' title='Persentase' ><i class='fa fa-bar-chart'></i></<span></a></td>";
	                           	
	                            echo "
	                                <td class='text-center' data-hide='phone,tablet'>";	                            
                                if(isset($c)){
                                    if($_SESSION['level']=='super'){
                                    echo "
                                        <a href='#editQst' class='editQst btn btn-success btn-xs' title='Ubah(sampel sudah ada)' data-id='$row[id_survey]' data-id2='$row[id_q]'data-toggle='tooltip' data-placement='top'><i class='fa fa-pencil'></i></a>
                                        <a href='#confirm-delete' class='delete btn btn-danger btn-xs' data-toggle='modal' data-placement='top' data-id='$row[id_q]' data-id2='$row[id_survey]'><span data-toggle='tooltip' data-placement='top' title='Hapus Pertanyaan(sampel sudah ada)'><i class='fa fa-trash'></i></span> </a>
                                    ";
                                    }else{
                                        echo "
                                            <a href='#' class='btn btn-success btn-xs' title='Pertanyaan tidak bisa diubah karena sampel sudah ada' data-toggle='tooltip' data-placement='top'><i class='fa fa-pencil'></i></a>
                                            <a href='#' class='btn btn-danger btn-xs'><span data-toggle='tooltip' data-placement='top' title='Pertanyaan tidak bisa dihapus karena sampel sudah ada'><i class='fa fa-trash'></i></span> </a>
                                        ";
                                    }
                                }else{
                                     echo "
                                        <a href='#editQst' class='editQst btn btn-success btn-xs' title='Ubah Pertanyaan' data-id='$row[id_survey]' data-id2='$row[id_q]'data-toggle='tooltip' data-placement='top'><i class='fa fa-pencil'></i></a>
                                        <a href='#confirm-delete' class='delete btn btn-danger btn-xs' data-toggle='modal' data-placement='top' data-id='$row[id_q]' data-id2='$row[id_survey]'><span data-toggle='tooltip' data-placement='top' title='Hapus Pertanyaan'><i class='fa fa-trash'></i></span> </a>
                                    ";
                                }
	                            echo "</td></tr>";
	                            $no++;
	                        }
	                    ?>
	                    
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>

<?php
}else{
    echo"<script>
            document.location.href='?d=tampilan_error_pengguna_admin';
        </script>";
}
}else{
    echo"<script>
            document.location.href='?d=tampilan_error_pengguna_admin';
        </script>";
}
?>