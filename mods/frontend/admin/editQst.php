<?php
    $id_q = base64_decode($_GET['qst']);
    $id_survey = base64_decode($_GET['srv']);
   
    $level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super" ){ 

        $query = "SELECT *from survey where id_survey='$id_survey'";
        $result = $mysqli->query($query);
        $cek = $result->num_rows;
        if($cek>0){
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#form').on( 'submit', function (event) {
            event.preventDefault();
            $("#submit").val('Process . . .');
            $.ajax({
                url:'mods/backend/act.php?act=editQst',
                type:'POST',
                data:$('#form').serialize(),
                success:function(result){
                    $("#submit").val('Submit');
                    $("#response").html(result);
                    $("#question").val('');
                }
            });
        });
    });
</script>

    <div class="col-md-12">
        <div class="panel rounded shadow panel-default">
            <div class="panel-heading">
                <div>
                    <h3 class="panel-title pull-left"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>EDIT QUESTION</h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id='response'></div>
            <div class="panel-body">
                <?php
                	 $question = $mysqli->query("SELECT question from question where id_survey='$id_survey' and id_q='$id_q'")->fetch_object()->question;

                    echo "
                        <form id='form' action='#' method='post'>
                            <input type='hidden' name='id_survey' value='$id_survey'>
                            <input type='hidden' name='id_question' value='$id_q'>
                            <div class='form-group'>
                                <label for='name-survey' class='control-label'>Pertanyaan: </label>
                                <input type='text' class='form-control' name='question' required='' id='question' value='$question'>
                            </div>
                            <div class='modal-footer'>
                                <input type='Submit' class='btn btn-theme btn-push' value='Update' id='submit'>
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
           