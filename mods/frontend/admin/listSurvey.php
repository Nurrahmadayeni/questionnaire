<?php
    $level = $_SESSION['level'];
    if($level=="fakultas" || $level=="unit" || $level=="super" ){ 
?>
<div class="row">
    <div class="col-md-12">
        <a><label><h4 class="pull-left"><i class="fa fa-list" aria-hidden="true"></i> Daftar Survey</h4></label></a>
        <hr class="title">
    </div>
</div>
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default rounded shadow">
	        <div class="panel-body">	
	        	<?php include("listSurveyDb.php"); ?>	            
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