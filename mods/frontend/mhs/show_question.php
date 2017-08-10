<?php   
    include('../../../lib/config.php');
    error_reporting(0);
    session_start();
    // $_SESSION['status'] = $user['status'];
    
    $id_fak = $mysqli->query("SELECT id_fak FROM mhs WHERE id_user='$_POST[id_user]'")->fetch_object()->id_fak;

    $q_m = "SELECT nama_matkul from mat_kul where id_matkul='$_POST[id_matkul]' and id_fak='$id_fak' ";

    $r_m = $mysqli->query($q_m);
    $ro_m = $r_m->fetch_assoc();
    
    echo "
        <div class='panel rounded shadow panel-default animated fadeIn'>
            <div class='panel-heading'>
                <div>
                    <h4 class='panel-title pull-left'><i class='fa fa-book'></i>
                    Matakuliah : ".$ro_m['nama_matkul']."
                </h4>
                </div>
                <div class='clearfix'></div>
            </div>
            <div class='panel-body'>
    ";
    echo "<div id='response'></div>";
    
	$no=1;
    $query = "SELECT *from question where id_survey='$_POST[id_survey]'";
    // echo $query;

    $result = $mysqli->query($query);
    $cek = $result->num_rows;
    if($cek>0){
        echo "<form action='mods/backend/act.php?act=addQst' method='post' enctype='multipart/form-data'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='panel rounded shadow panel-theme'>";
            echo "<div class='panel-heading'>";
            echo $no.". ". $row['question']. "</div>";
            echo "<div class='panel-body' style='background-color:#F4F4F4'>";
            echo "
                    <input type='hidden' name='id_user' value='$_SESSION[id_user]'>
                    <input type='hidden' name='id_srv' value='$_POST[id_survey]'>
                    <input type='hidden' name='id_q[$id_q]' value='$row[id_q]'>
                    <input type='hidden' name='id_style_ans[$id_q]' value='$row[id_style_ans]'>";
                    echo "<input type='hidden' name='id_matkul' value='$_POST[id_matkul]'>";

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
                        echo "<input type='text' class='form-control' name='answer[$id_q]' required>";

                    }elseif($row['id_style_ans']=='5'){
                        echo "<textarea class='form-control' rows='3' name='answer[$id_q]' required></textarea>";
                    }

            echo "</div><br/><br/>";
            $no++;
        }
        echo "<div class='modal-footer'>
                <button class='btn btn-theme pull-left btn-push' type='submit' id='submit_answer'>Submit </button> 
                  <button class='btn btn-danger pull-left btn-push' type='reset'> Reset</button>
        </div>
            
        </form></div></div>";
    }else{
        echo "<div class='alert alert-danger'>Belum terdapat pertanyaan pada survey ini</div>";
    }
?>
