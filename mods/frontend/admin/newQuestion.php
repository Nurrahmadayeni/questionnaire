<?php
    $limit = $_GET['l'];

    $level = $_SESSION['level'];
    if($level=="unit" || $level=="super"){ 
?>

<div class="row">
    <div class="col-md-12">
        <a><label><h4 class="pull-left"><i class="fa fa-file-text" aria-hidden="true"></i> Deskripsi Survey</h4></label></a>
        <hr class="title">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel rounded shadow panel-default">
            <div id='response_add'></div>
            <div class="panel-body">
                <?php
                    $query='';
                    if($level=='super'){
                        $query = "SELECT *from survey where id_owner='$_GET[o]' order by id_survey desc limit 1";
                    }else{
                        $query = "SELECT *from survey where id_owner='$_SESSION[status]' order by id_survey desc limit 1";
                    }
                    
                    // echo $query;
                    $result = $mysqli->query($query);

                    $row = $result->fetch_assoc();
                    echo "
                        <div class='row'>
                        <div class='col-md-2'><label for='title-survey' class='control-label'>Judul Survey</label></div>
                        <div class='col-md-8'><label for='title-survey' class='control-label'>: $row[title]</label></div>
                        </div>
                        <div class='row'>
                        <div class='col-md-2'><label for='title-survey' class='control-label'>Jangka Waktu</label></div>
                        <div class='col-md-8'><label for='title-survey' class='control-label'>: $row[start_date] s/d $row[due_date]</label></div>
                        </div>
                        <div class='row'>
                        <div class='col-md-2'><label for='title-survey' class='control-label'>Sampel</label></div>
                        <div class='col-md-8'><label for='title-survey' class='control-label'>: ";
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
                    ";
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row" id="form_tambah_qst">
    <div class="col-md-12">
        <?php 
        $list = base64_encode("list_question_pengguna_admin");
        $ids = base64_encode($row['id_survey']);
        ?>

        <input type="hidden" id='list' value='<?=$list?>'>
        <input type="hidden" id='ids' value='<?=$ids?>'>
        <input type="hidden" id='id_s' value='<?=$row['id_survey']?>'>

        <p class='pull-right'><a href='?d=<?=$list?>&srv=<?=$ids?>' class="btn btn-theme btn-sm addUser btn-push" data-toggle="modal" ><i class="fa fa-list"></i> Daftar Pertanyaan </a></p>
        <ul class="nav nav-tabs">
            <li class="active nav-border nav-border-top-success">
                <a href="#tambah_qst" data-toggle="tab" class="text-center">
                    <?php 
                        $query_c = "SELECT question from question where id_survey='$row[id_survey]'";
                        
                        $data_c = $mysqli->query($query_c);
                        $total = $data_c->num_rows;
                        $pertanyaan = $total+1;
                    ?>
                    <label> Tambah Pertanyaan Baru <small class='text-danger' id='jlh_tanya'><i> ( Pertanyaan ke <?=$pertanyaan?> )</i></small></label>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tambah_qst">
                <form id='form_addQst' method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-2">Pertanyaan</div>
                        <div class="col-md-10">
                            <textarea class="form-control" id="input_qst" name="question" rows="2" placeholder="Input Pertanyaan" required></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-2">Jenis Pilihan Jawaban</div>
                        <div class="col-md-9">
                            <select id="style_ans" width="100%" class="form-control" placeholder="-- Pilih Jenis Pilihan Jawaban --" name="style" required>
                                <?php 
                                    $query = "SELECT * from style_ans";
                                    $data = $mysqli->query($query);
                                    echo "
                                        <option value='0' selected disabled >-- Pilih Jenis Pilihan Jawaban --</option>'";
                                        while ($s = $data->fetch_assoc()) {
                                            echo "
                                                <option value=".$s['id_style_ans'].">$s[style_ans]</option>'
                                            ";
                                        }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <a href="#style_answer" data-toggle='modal' class="btn btn-theme btn-sm btn-push pull-right"><span data-toggle='tooltip' data-placement='top' title='Klik Untuk Lihat Contoh Jenis Pilihan Jawaban' ><i class="fa fa-question-circle" aria-hidden="true"></i> Contoh Pilihan</span></a>
                        </div>
                    </div>
                    <br/>
                    <div class="row" id="jumlah_skala_ans"></div><br/>
                    <div class="row" id="value_ans"></div>
                    <?php  
                    $q = "SELECT id_survey from survey where created_by='$_SESSION[username_q]' order by id_survey desc limit $limit";
                    // echo $q;
                    $r = $mysqli->query($q);

                    while($id_s = $r->fetch_assoc()){
                        echo "<input type='hidden' name='id_s[]' value='$id_s[id_survey]'>";
                    }
                    
                    ?>
                    
                    <div class='modal-footer'>
                        <button class="btn btn-theme btn-push" type="submit" id="save_add" data-toggle='tooltip' data-placement='top' title='Simpan & Tambah Pertanyaan Lagi' >Simpan dan Tambah</button>
                        <button class="btn btn-theme btn-push" type="submit" id="save_list" data-toggle='tooltip' data-placement='top' title='Simpan & Lihat Daftar Pertanyaan'>Simpan dan Lihat Daftar</button>
                        <a href="?d=<?=base64_encode("list_survey_pengguna_admin"); ?>" class="btn btn-danger btn-push" data-toggle='tooltip' data-placement='top' title='Batal Tambah Pertanyaan'>Batal</a>
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