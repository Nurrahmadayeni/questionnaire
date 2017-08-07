<?php
    $id_survey = base64_decode($_GET['srv']);
    $query = "SELECT *from survey where id_survey='$id_survey' and pgw=1 and objective='$_SESSION[status]'";
    $result = $mysqli->query($query);
    $cek = $result->num_rows;
    if($cek>0){
?>
<div class="col-md-12">
    <div class="panel-body-link">        
        <a><label><h4 class="pull-left"><i class="fa fa-list" aria-hidden="true"></i> Daftar Pertanyaan</h4></a>
    </div>
    <hr class="title">
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel rounded shadow panel-theme">
            <div class="panel-heading">
                <?php
                    $query = "SELECT *from survey where id_survey='$id_survey'";
                    $result = $mysqli->query($query);

                    $row = $result->fetch_assoc();
                    echo "
                        <div class='row'>
                            <div class='col-md-2'><label for='title-survey' class='control-label'>Judul Survey</label></div>
                            <div class='col-md-7'><label for='title-survey' class='control-label'>: $row[title]</label></div>
                            <div class='col-md-3' style='text-align:right'>
                                <a href='?d=".base64_encode('jawab_survey_pengguna_admin')."' class='btn btn-default btn-push btn-sm' ><i class='fa fa-step-backward'></i> Kembali ke daftar survey </a>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-2'><label for='title-survey' class='control-label'>Jangka Waktu</div>
                            <div class='col-md-6'><label for='title-survey' class='control-label'>: $row[start_date] s/d $row[due_date]</label>
                            </div>
                        </div>
                    ";
                ?>
            </div>
            <div id='response'></div>
            <div id='alert' class="alert alert-success col-md-4 col-md-offset-4" style=''></div>
            <div class="panel-body" style='background-color: white;'>
                <div class='panel-body' style='background-color: white;'>
                    <?php 
                        $no=1;
                        $query = "SELECT *from question where id_survey='$id_survey'";
                        // echo $query;
                        $result = $mysqli->query($query);
                        $cek = $result->num_rows;
                        if($cek>0){
                            echo " <form action='#' id='form_question' method='post' enctype='multipart/form-data'>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='panel rounded shadow panel-theme'>";
                                echo "<div class='panel-heading'>";
                                echo $no.". ". $row['question']. "</div>";
                                echo "<div class='panel-body' style='background-color:#F4F4F4'>";
                                echo "
                                        <input type='hidden' name='username' value='$_SESSION[username]'>
                                        <input type='hidden' name='id_srv' value='$id_survey'>
                                        <input type='hidden' name='id_q[$id_q]' value='$row[id_q]'>
                                        <input type='hidden' name='id_style_ans[$id_q]' value='$row[id_style_ans]'>";
                                        // echo "<input type='hidden' name='id_matkul' value='$_POST[id_matkul]'>";

                                        $id_q = $row['id_q'];

                                        if($row['id_style_ans']=='1'){
                                            $val = explode(', ', $row['answer_value']);

                                            for($i=0; $i<=count($val)-1; $i++){
                                                echo "
                                                    <div class='rdio radio-inline rdio-theme rounded'>
                                                        <input class='radio-inline' id='answerR$no$i' required type='radio' name='answer[$id_q]' value='$val[$i]'>
                                                        <label for='answerR$no$i'>$val[$i]</label>
                                                    </div>
                                                ";
                                            }
                                        }elseif($row['id_style_ans']=='2'){
                                            $val = explode(', ', $row['answer_value']);

                                            for($i=0; $i<=count($val)-1; $i++){
                                                echo "
                                                    <div class='ckbox ckbox-theme'>
                                                        <input id='answerC$no$i' class='sampel' type='checkbox' name='chosen[$id_q][]' value='$val[$i]'>
                                                        <label for='answerC$no$i' class='control-label'>$val[$i]</label>
                                                    </div>
                                                ";
                                            }
                                        }elseif($row['id_style_ans']=='3'){
                                            echo "<input type='number' class='number form-control' name='answer[$id_q]' value='input angka' required>";

                                        }elseif($row['id_style_ans']=='4'){
                                           echo "<textarea class='form-control' rows='3' name='answer[$id_q]' required></textarea>";

                                        }

                                echo "</div><br/><br/>";
                                $no++;
                            }
                            echo "<div class='modal-footer'>
                                    <button class='btn btn-theme pull-left btn-push' type='submit' id='submit_answer'>Submit </button> 
                                      <button class='btn btn-danger pull-left btn-push' type='reset'> Reset</button>
                                    </div>
                            </form>";
                        }else{
                            echo "Belum terdapat pertanyaan di survey ini";
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    echo"<script>
            document.location.href='?d=error';
        </script>";
}

?>