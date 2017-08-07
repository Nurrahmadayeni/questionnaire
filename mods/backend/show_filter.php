<link rel="stylesheet" href="../../assets/plugins/select2/select2.min.css">
<script src="../../assets/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    $(".select2").select2();
  });
  </script>
<?php  
	error_reporting(0);
	session_start();
	include('../../lib/config.php');
// var_dump($_POST);

if($_POST['id']=='1'){

?>
<div class="form-group" id='srv_umum'>
    <div class="col-md-2">Pilih Judul Survey</div>
    <div class="col-md-10">
        <select class="form-control mb-10 select2" id='id_survey' name='id_survey'  style='width: 100%; padding-right: 10px;' required>
            <option disabled selected>-- Pilih Judul Survey --</option>
            <?php 
                $query = "SELECT id_survey, title from survey where id_owner='$_SESSION[status]' and matakuliah=0";
                $sql = $mysqli->query($query);
                
                while($data = $sql->fetch_assoc()){
                    echo "<option value='$data[id_survey]'>$data[title]</option>";
                }
            ?>
        </select>
    </div>
	<br/> <br/>
</div>
<?php }elseif ($_POST['id']=='2') {
?>


<div id='survey_matkul'>
    <div class="form-group" id='thn_ajaran'>
        <div class="col-md-2">Tahun Ajaran</div>
        <div class="col-md-10">
            <select class="form-control mb-10 select2" name='thn_ajaran'  style='width: 100%; padding-right: 10px;' required>
                <option disabled selected>-- Pilih Tahun Ajaran --</option>
                <?php 
                    $query = "SELECT thn_ajaran from krs group by thn_ajaran";
                    $sql = $mysqli->query($query);
                    
                    while($data = $sql->fetch_assoc()){
                        echo "<option value='$data[thn_ajaran]'>$data[thn_ajaran]</option>";
                    }
                ?>
            </select>
        </div>
        <br/> <br/> 
    </div>
    
    <div class="form-group" id='semester'>
        <div class="col-md-2">Semester</div>
        <div class="col-md-10">
            <select class="form-control mb-10 select2" name='thn_ajaran'  style='width: 100%; padding-right: 10px;' required>
                <option disabled selected>-- Pilih Semester --</option>
                <?php 
                    $query = "SELECT semester from krs group by semester";
                    $sql = $mysqli->query($query);
                    
                    while($data = $sql->fetch_assoc()){
                        echo "<option value='$data[semester]'>$data[semester]</option>";
                    }
                ?>
            </select>
        </div>
        <br/> <br/> 
    </div>
    

    <div class="form-group" id='mat_kul'>
        <div class="col-md-2">Matakuliah</div>
        <div class="col-md-10">
            <select class="form-control mb-10 select2" name='thn_ajaran'  style='width: 100%; padding-right: 10px;' required>
                <option disabled selected>-- Pilih Matakuliah --</option>
                <?php 
                    // $nama_unit = $mysqli->query("SELECT nama_unit from unit_kerja where id_unit='$_SESSION[status]'")->fetch_object()->nama_unit;

                    // $query = "SELECT k.id_matkul, m.nama_matkul from krs k, mat_kul m";
                    // $sql = $mysqli->query($query);
                    
                    // while($data = $sql->fetch_assoc()){
                    //     echo "<option value='$data[semester]'>$data[semester]</option>";
                    // }
                ?>
            </select>
        </div>
        <br/> <br/> 
    </div>
</div>

<?php } ?>
