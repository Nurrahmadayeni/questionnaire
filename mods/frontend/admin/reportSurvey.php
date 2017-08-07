<?php
    $level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super" ){ 
?>

<div class="row">
    <div class="col-md-12">
        <a><label><h4 class="pull-left"><i class="fa fa-bar-chart" aria-hidden="true"></i> Laporan Survey</h4></a> 
        <hr class="title">
    </div>
</div>

<div class="row" id="form_tambah_qst">
    <div class="col-md-12">
        <div id='alert' class="alert alert-success col-md-4 col-md-offset-4" style=''></div>
        <ul class="nav nav-tabs">
            <li class="active nav-border nav-border-top-success">
                <a href="#report_srv" data-toggle="tab" class="text-center">
                   Laporan Survey
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="report_srv">
                <form id='form_report_srv' method="post">
                    <div class="form-group">
                        <div class="col-md-2">Jenis Pilihan Survey</div>
                        <div class="col-md-10">
                            <select id="style_survey" width="100%" class="form-control" placeholder="-- Pilih Jenis Pilihan Survey --" name="style_survey" required>
                                <option value='0' selected disabled >-- Pilih Jenis Pilihan Survey --</option>
                                <option value='1'>Survey Umum</option>
                                <option value='2'>Survey Matakuliah</option>
                            </select>
                        </div>
                        <br/> <br/>
                    </div>
                    <div id='result'></div>
                    
                    <div id='btn_export' class='modal-footer' style='display: none !important;'>
                        <button type="submit" class="btn btn-theme btn-push">Search</button>
                        <a href='javascript:history.back()' class="btn btn-danger btn-push">Batal</a>
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