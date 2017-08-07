<?php
    $level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super" ){ 
?>
<div style="padding-top:2%;">    
    <div class="text-center">
        <img src='img/logo_usu.png' style='width:35%;margin-bottom:2%'>
    </div>
    <div class="row text-center">
        <div class='col-md-2 col-sm-2'></div>
        
        <div class='col-md-2 col-sm-2'>
            <div id="panel" class="panel panel-theme text-center rounded" style="opacity:1;top:0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Survey</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-body-ico text-center">
                        <a href="?d=<?=base64_encode("tambah_survey_pengguna_admin")?>">
                            <span class="fa fa-plus-circle" style="font-size: 6em"></span>
                        </a>
                    </div>
                    <div class="panel-body-link">
                        <a href="?d=<?=base64_encode("tambah_survey_pengguna_admin")?>">Tambah Survey Baru</a>
                    </div>
                </div>
            </div>
        </div>
                
        <div class='col-md-2 col-sm-2'>
            <div id="panel" class="panel panel-theme panel-clickable text-center rounded" style="opacity:1;top:0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Survey</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-body-ico">
                        <a href="?d=<?= base64_encode("list_survey_pengguna_admin"); ?>">
                            <span class="fa fa-list" style="font-size: 6em">
                            </span>
                        </a>
                    </div>
                    <div class="panel-body-link">
                        <a href="?d=<?= base64_encode("list_survey_pengguna_admin"); ?>">Daftar Survey</a>
                    </div>
                </div>
            </div>
        </div>
        <?php  
        if($_SESSION['level']=='super'){
            ?>
        <div class='col-md-2 col-sm-2'>
            <div id="panel" class="panel panel-theme panel-clickable text-center rounded" style="opacity:1;top:0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar User Admin</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-body-ico">
                        <a href="?d=<?= base64_encode("daftar_user_admin_superuser"); ?>">
                            <span class="fa fa-list" style="font-size: 6em">
                            </span>
                        </a>
                    </div>
                    <div class="panel-body-link">
                        <a href="?d=<?= base64_encode("daftar_user_admin_superuser"); ?>">Daftar User Admin</a>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }else{
        ?>
        <div class='col-md-2 col-sm-2'>
            <div id="panel" class="panel panel-theme text-center rounded" style="opacity:1;top:0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Jawab Survey</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-body-ico text-center">
                        <a href="?d=<?=base64_encode("jawab_survey_pengguna_admin")?>">
                            <span class="fa fa-check-square-o" style="font-size: 6em"></span>
                        </a>
                    </div>
                    <div class="panel-body-link">
                        <a href="?d=<?=base64_encode("jawab_survey_pengguna_admin")?>">Jawab Survey</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class='col-md-2 col-sm-2'>
            <div id="panel" class="panel panel-theme text-center rounded" style="opacity:1;top:0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Laporan Survey</h3>
                </div>
                <div class="panel-body">
                    <div class="panel-body-ico text-center">
                        <a href="?d=<?=base64_encode("report_survey_pengguna_admin")?>">
                            <span class="fa fa-bar-chart" style="font-size: 6em"></span>
                        </a>
                    </div>
                    <div class="panel-body-link">
                        <a href="?d=<?=base64_encode("report_survey_pengguna_admin")?>">Laporan Survey</a>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-2 col-sm-2'></div>
    </div>

    <div class="panel-body-link" style='padding-top: 2%;'>        
        <a><h3 class='text-center'>Daftar Survey</h3></a>
    </div>
    <hr class="style">
    <?php include('mods/frontend/admin/listSurveyDb.php'); ?>
</div>

<?php

    }else{
        echo"<script>
                document.location.href='?d=tampilan_error_pengguna_admin';
            </script>";
    }
?>
<script>
    $('.panel').each(function(index) {
        setTimeout(function(el) {
            el.fadeIn('slow');
        }, index * 700, $(this));            
    });
</script>