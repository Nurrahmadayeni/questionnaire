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
        <a><label><h4 class="pull-left"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah Survey</h4></label></a>
        <hr class="title">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel rounded shadow panel-default">
            <div id='response'></div>
            <div class="panel-body">
                <?php
                    $query = "SELECT *from survey where id_survey='$id_survey'";
                    $result = $mysqli->query($query);

                    $row = $result->fetch_assoc();
                        echo "
                            <form id='form_editSurvey' action='#' method='post'>
                                <input type='hidden' name='id_survey' value='$row[id_survey]'>
                                <div class='form-group'>
                                    <label for='name-survey' class='control-label'>Judul Survey: </label>
                                    <input type='text' class='form-control' name='title' required='' id='title' value='$row[title]'>
                                </div>";
                                $date_s = explode('-', $row['start_date']);
                                $date_d = explode('-', $row['due_date']);

                                $start_date = $date_s[1]."/".$date_s[2]."/".$date_s[0];
                                $due_date = $date_d[1]."/".$date_d[2]."/".$date_d[0];
                        echo " <div class='form-group'>
                                    <label for='name-survey' class='control-label'>Jangka Waktu: </label>
                                    <input type='text' class='form-control date-range-picker' value='$start_date - $due_date' required='' name='tgl' id='tanggal'>
                                </div>";
                        if($row['matakuliah']==1){
                            echo "";
                        }else{
                            echo "
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
                            </div>";
                        }
                       
                        echo "
                            <div class='modal-footer'>
                                <input type='Submit' class='btn btn-theme btn-push' value='Update' id='btnUpdate'>
                                <a href='javascript:history.back()' class='btn btn-danger btn-push' value='Cancel'> Cancel </a>
                            </div>
                            </form>
                        ";
                ?>

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
