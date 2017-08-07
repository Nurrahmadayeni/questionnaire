<?php
    $level = $_SESSION['level'];
    $id = base64_decode($_GET['srv']); 
    if($level=="fakultas" || $level=="unit" || $level=="super"){ 

    $query = "SELECT *from survey where id_survey='$id'";
    $result = $mysqli->query($query);
    $cek = $result->num_rows;
    if($cek>0){
?>
<div class="row">
    <div class="col-md-12">
        <a><label><h4 class="pull-left"><i class="fa fa-files-o" aria-hidden="true"></i> Salin Pertanyaan Survey</h4></label></a>
        <hr class="title">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active nav-border nav-border-top-success">
                <?php                    
                    $row = $result->fetch_assoc();
                ?>
                <a href="#tambah_srv" data-toggle="tab" class="text-center">
                    <label> Salin Pertanyaan dari Survey ( <small class="text-danger"><?=$row[title]?></small> )</label>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div id='response'></div>
        <div id='alert' class="alert alert-success col-md-4 col-md-offset-4" style=''></div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tambah_qst">
                <form id='form_copySurvey' action="#" method="post">
                    <input type="hidden" name="id_survey" value="<?=$id?>">
                    <span id="nilai_ids" style="display: none;"><?=$id?></span>
                    <span id="hasil"></span>
                    <div class="form-group">
                        <label for="name-survey" class="control-label">Judul Survey </label>
                        <input type="text" class="form-control" name="title" id='title' placeholder="Judul Survey" required="">
                    </div>
                    <div class="form-group">
                        <label for="name-survey" class="control-label">Jangka Waktu </label>
                            <?php $time = date("m/d/Y"); ?>
                            <input type="text" class="form-control date-range-picker" value="<?=$time?> - <?=$time?>" required="" name='tgl' id='tanggal' />
                    </div>
                    <?php 
                    if($_SESSION['level']=='super'){ ?>
                    <div class="form-group">
                        <label class="control-label">Pemilik Survey</label>
                        <select class="form-control select2" data-placeholder="-- Pilih Pemilik Survey --" style="width: 100%;" name='id_owner' required>
                            <option value="" disabled="" selected="">-- Pilih Pemilik Survey --</option>
                            <?php 
                                include "listUnFac.php";
                                echo "</select></div>";
                            }
                    if($_SESSION['level']=='unit' || $_SESSION['level']=='super'){ ?>
                    <div class="form-group">
                        <label class="control-label">Unit Kerja</label>
                        <select class="form-control select2" multiple="multiple" data-placeholder="-- Pilih Unit Kerja --" style="width: 100%;" required="" name='unit_kerja[]' id='unit'>
                            <option value="" disabled="">-- Pilih Unit Kerja --</option>
                            <?php 
                                include "listUnFac.php";
                                echo "</select></div>";
                            }
                           
                    if($row['matakuliah']=='0'){  ?>
                         <div class="form-group" id='sampel'>
                            <label for="name-sample" class="control-label">Sampel: </label>
                            <div class="ckbox ckbox-theme">
                                <input id="mhs" class="sampel" type="checkbox" name="sampel[]" value="mhs">
                                <label for="mhs" class="control-label">Mahasiswa</label>
                            </div>
                            <div class="ckbox ckbox-theme">
                                <input id="dsn" class="sampel" type="checkbox" name="sampel[]" value="dsn">
                                <label for="dsn" class="control-label">Dosen</label>
                            </div>
                            <div class="ckbox ckbox-theme">
                                <input id="pgw" class="sampel" type="checkbox" name="sampel[]" value="pgw">
                                <label for="pgw" class="control-label">Pegawai</label>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="modal-footer" >
                        <input type="Submit" class="btn btn-theme btn-push" value="Submit" id="submit">
                        <input type="reset" class="btn btn-danger btn-push" value="Reset">
                    </div>
                </form>
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