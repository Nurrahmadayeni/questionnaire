<script type="text/javascript">
    $(document).ready(function(){
        $('#form').on( 'submit', function (event) {
            event.preventDefault();
            $("#submit").val('Process . . .');
            $.ajax({
                url:'mods/backend/act.php?act=addQst',
                type:'POST',
                data:$('#form').serialize(),
                success:function(result){
                    $("#submit").val('Submit');
                    $("#response").html(result);
                    // $("#response").slideDown(2000, function(){
                    //    $("#response").html(result);
                    //    $("#response").slideUp(2000); 
                    // });
                }
            });
        });
    });
</script>
<div class="row">
	<div class="col-md-12">
	    <div class="panel rounded shadow">
	        <div class="panel-heading">
	            <div>
	                <h3 class="panel-title pull-left"><i class="fa fa-list"></i>DAFTAR PERTANYAAN</h3>
	            </div>
	            <div class="clearfix"></div>
	        </div>
	        <div id='response'></div>
	        <div class="panel-body">
	        	<?php
                    $query = "SELECT *from survey where id_survey='$_GET[srv]'";
                    $result = $mysqli->query($query);

                    $row = $result->fetch_assoc();
                    echo "
                        <div class='row'>
                        <div class='col-md-4'><label for='title-survey' class='control-label'>Judul Survey</div>
                        <div class='col-md-4'><label for='title-survey' class='control-label'>: $row[title]</label></div>
                        </div>
                        <div class='row'>
                        <div class='col-md-4'><label for='title-survey' class='control-label'>Jangka Waktu</div>
                        <div class='col-md-4'><label for='title-survey' class='control-label'>: $row[time_period]</label></div>
                        </div>
                        </label></div>
                    ";
                ?>
	            <div class='panel-body'>
	            	<?php 
	            		$no=1;
                        $query = "SELECT *from question where id_survey='$_GET[srv]'";
                        $result = $mysqli->query($query);

                        while ($row = $result->fetch_assoc()) {
                        	$a=1;$b=2;$c=3;$d=4;$e=5;
                            echo $no. ". $row[question]". "<br/>";
                            ?>
                                <div>
                            	<form action='#' id='form' method='post' enctype='multipart/form-data'>
                            		<input type='hidden' name='lvl' value='<?php echo "$_GET[mod]"; ?>'>
                            		<input type='hidden' name='id_user' value='<?php echo "$_GET[usr]"; ?>'>
                            		<input type='hidden' name='id_srv' value='<?php echo "$_GET[srv]";?>'>
                            		<div class='rdio radio-inline rdio-theme rounded'>
                                        <input class='radio-inline' id='radio-type-rounded<?php echo "$a$no' required type='radio' name='answer[$no]' value='$row[id_q] 1'";?>'>
                                        <label for='radio-type-rounded<?php echo "$a$no"?>'>Sangat Buruk</label>
                                    </div>
                                    <div class='rdio radio-inline rdio-theme rounded'>
                                        <input class='radio-inline' id='radio-type-rounded<?php echo "$b$no' required type='radio' name='answer[$no]' value='$row[id_q] 2'";?>'>
                                        <label for='radio-type-rounded<?php echo "$b$no"?>'>Buruk</label>
                                    </div>
                                    <div class='rdio radio-inline rdio-theme rounded'>
                                        <input class='radio-inline' id='radio-type-rounded<?php echo "$c$no' required type='radio' name='answer[$no]' value='$row[id_q] 3'";?>'>
                                        <label for='radio-type-rounded<?php echo "$c$no"?>'>Sedang</label>
                                    </div>
                                    <div class='rdio radio-inline rdio-theme rounded'>
                                        <input id='radio-type-rounded<?php echo "$d$no' required type='radio' name='answer[$no]' value='$row[id_q] 4'";?>'>
                                        <label for='radio-type-rounded<?php echo "$d$no"?>'>Bagus</label>
                                    </div>
                                    <div class='rdio radio-inline rdio-theme rounded'>
                                        <input id='radio-type-rounded<?php echo "$e$no' required type='radio' name='answer[$no]' value='$row[id_q] 5'";?>'>
                                        <label for='radio-type-rounded<?php echo "$e$no"?>'>Sangat Bagus</label>
                                    </div>
                                </div>

                             <?php
                            $no++;
                        }
                        echo "<div class='modal-footer'>
  							<button class='btn btn-success pull-left btn-push' type='submit' id='submit'>Submit</button>
                    		<button class='btn btn-danger pull-left btn-push'>Cancel</button>
						</div>
                        	
                        </form>";
	            	?>
	            </div>
	        </div>
	    </div>
	</div>
</div>
