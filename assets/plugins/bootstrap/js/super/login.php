<!DOCTYPE HTML>
<html>
	<head>
		<title>QUESTIONNAIRE</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../img/logo.png" />
		
		<!-- Font -->
		<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Roboto:300,400,500,700'>
		<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/icon?family=Material+Icons'>
		
		<!-- CSS -->
		<link rel='stylesheet' href='../assets/plugins/bootstrap/css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='../assets/plugins/bootstrap/css/bootstrap-material-design.css'>
		<link rel='stylesheet' type='text/css' href='../assets/plugins/bootstrap/css/ripples.css'>  
		<link rel='stylesheet' type='text/css' href="../assets/css/sign-type-2.css">
		<link rel='stylesheet' type='text/css' href="../assets/css/default.theme.css" rel="stylesheet" id="theme">
		
		<!-- Javascript-->
		<script src="../assets/plugins/bootstrap/js/jquery-3.1.1.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src='../assets/plugins/bootstrap/js/material.js'></script>
		<script src='../assets/plugins/bootstrap/js/ripples.js'></script>
		
		<script>
			$.material.init();
		
			$(document).ready(function () {   
				$('#focusedInput1, #focusedInput2').on('keyup', function() {
					$( "#response" ).fadeOut('slow');
				});

				$('#form_login').on('submit', function (event) {
			        event.preventDefault();
			        $("#submit").val('Process . . .');
			        var delay = 1500;
			        $.ajax({
			            url:'../mods/backend/act.php?act=login',
			            type:'POST',
			            data:$('#form_login').serialize(),
			            success:function(result){
			                $("#submit").val('LOGIN');  
			                // console.log(result);
			                // alert(result);
			                if(result==" Sukses"){
			                    setTimeout(function() {
			                      window.location.href = "/super";
			                    }, 500);
			                }else{
			                	$("#response").fadeIn('slow').html(result);
				                $('html, body').animate({ scrollTop: 0 }, 700);
			                }
			            }
			        });
			    });
			});
		</script>


		<style>
	        .paper{
	          margin-top: 5%;
	          box-shadow: 0px 2px 21px 0px rgba(0,0,0,0.75);
	        }
	        .debug{
	                border:1px solid black;
	        }
	        .dev{
	          margin-top:-0px;
	        }
	        .imge{
	          margin:30px 20px 0px 0px;
	        }
	    </style>
	</head>
<body>
	<div class="container-fluid">
		<div class='wrapper'>
			<div class="col-lg-12 text-center">
				<img class="img imge img-fluid" width='25%' src='../img/logo_usu.png'>
			</div>
			<div class='col-lg-4 col-md-offset-4 well well-lg paper dev'>
				<div class="sign-header">
                    <div class="form-group">
                        <div class="sign-text">
                            <span>SuperUser Portal Survey USU</span>
                        </div>
                    </div>
                </div>
                <div id='response' class='alert alert-danger' style='display: none; border-radius: 4px; opacity: 0.9; margin-bottom: -20px; margin-top: 5px;' ></div>
				<div class='col-lg-12'>	
					<form id='form_login' class='sign-in form-horizontal shadow no-overflow ' action='#'>
						<div class="form-group label-floating">
						  <input class="form-control" id="focusedInput1" type="text" name='username' placeholder="Username" required>
						  <p class="help-block">Masukkan username</p>
						</div>
					    <div class='form-group label-floating'>
						  <input class='form-control' id='focusedInput2' name='password' type='password' placeholder="Password" required>
						  <p class="help-block">Masukkan password</p>
						</div>
					    <div class='form-group'>
					       	<input type='submit' id='submit' class='btn-theme btn-lg btn-block no-margin rounded' value='LOGIN'/>
					    </div>
					</form>						
				</div>
				<div class='row'>
					<div class='col-lg-12 col-md-12 col-sm-12'>
						<p class='text-center'>Developed by : <a href='http://www.usu.ac.id/'> Pusat Sistem Informasi USU </a>&copy; 2017</p>
					</div>
				</div>
			</div>
	</div>
</body>
</html>