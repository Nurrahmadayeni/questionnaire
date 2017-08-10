<?php
    $level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super"){ 
?>
<div class="row">
    <div class="col-md-12">
        <a><label><h4 class="pull-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Survey Baru</h4></label></a>
        <hr class="title">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active nav-border nav-border-top-success">
                <a href="#tambah_srv" data-toggle="tab" class="text-center">
                    <label> Tambah Survey</label>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
        <div id='response'></div>
        <div id='alert' class="alert alert-success col-md-4 col-md-offset-4"></div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tambah_qst">
                <form id='form_addSurvey' action="#" method="post">
                    <div class="form-group">
                        <label for="name-survey" class="control-label">Judul Survey </label>
                        <input type="text" class="form-control" name="title" id='title' placeholder="Judul Survey" required="">
                    </div>
                    <input type='hidden' id='url' value='<?=base64_encode("tambah_new_question_pengguna_admin");?>'>
                    <input type='hidden' id='level' value='<?=$_SESSION['level']?>'>
                    <input type='hidden' id='username' value='<?=$_SESSION['username']?>'>
                    <div class="form-group">
                        <label for="name-survey" class="control-label">Jangka Waktu </label>
                            <?php $time = date("m/d/Y"); ?>
                            <input type="text" class="form-control date-range-picker" value="<?=$time?> - <?=$time?>" required="" name='tgl' id='tanggal' />
                    </div>
                    <?php 
                    if($_SESSION['level']=='super'){ ?>
                    <div class="form-group">
                        <label class="control-label">Pemilik Survey</label>
                        <select class="form-control select2" data-placeholder="-- Pilih Pemilik Survey --" style="width: 100%;" name='id_owner' id='id_owner' required>
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
                            ?>
                    <div class="form-group">
                        <label for="name-survey" class="control-label">Apakah survey matakuliah ? </label>
                            <div>
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input type='radio' class='radio-inline' id='radio-type-rounded1' required  value='1' name="mat_kul">
                                    <label class='mat_kul' for='radio-type-rounded1'>YA</label>
                                </div>
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input type='radio' class='radio-inline' id='radio-type-rounded2' required  value='0' name="mat_kul">
                                    <label class='mat_kul' for='radio-type-rounded2'>TIDAK</label>
                                </div>
                            </div>
                    </div>
                    <div class="form-group" id='sampel' style='display: none !important;'>
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
?>