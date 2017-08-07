<!DOCTYPE HTML>
<html>
	<head>
		<title>QUESTIONNAIRE</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="img/logo.png" />
		
		<!-- Font -->
		<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Roboto:300,400,500,700'>
		<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/icon?family=Material+Icons'>
		
		<!-- CSS -->
		<link rel='stylesheet' href='assets/plugins/bootstrap/css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='assets/plugins/bootstrap/css/bootstrap-material-design.css'>
		<link rel='stylesheet' type='text/css' href='assets/plugins/bootstrap/css/ripples.css'>  
		<link rel='stylesheet' type='text/css' href="assets/css/sign-type-2.css">
		<link rel='stylesheet' type='text/css' href="assets/css/default.theme.css" rel="stylesheet" id="theme">
		
		<!-- Javascript-->
		<script src="assets/plugins/bootstrap/js/jquery-3.1.1.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src='assets/plugins/bootstrap/js/material.js'></script>
		<script src='assets/plugins/bootstrap/js/ripples.js'></script>
		
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
			            url:'mods/backend/act.php?act=login',
			            type:'POST',
			            data:$('#form_login').serialize(),
			            success:function(result){
			                $("#submit").val('LOGIN');  
			                // console.log(result);

			                if(result==" Sukses"){
			                    var Base64 = {_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

			                    	var home = Base64.encode("dashboard_tampilan_home_pengguna");

				                    setTimeout(function() {
				                      window.location.href = "?d="+home;
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
				<img class="img imge img-fluid" width='25%' src='img/logo_usu.png'>
			</div>
			<div class='col-lg-4 col-md-offset-4 well well-lg paper dev'>
				<div class="sign-header">
                    <div class="form-group">
                        <div class="sign-text">
                            <span>PORTAL SURVEY USU</span>
                        </div>
                    </div>
                </div>
                <div id='response' class='alert alert-danger' style='display: none; border-radius: 4px; opacity: 0.9; margin-bottom: -20px; margin-top: 5px;' ></div>
				<div class='col-lg-12'>	
					<form id='form_login' class='sign-in form-horizontal shadow no-overflow ' action='#'>
						<div class="form-group label-floating">
						  <input class="form-control" id="focusedInput1" type="text" name='username' placeholder="Username" required>
						  <p class="help-block">Masukkan username berupa nim/nidn/nip</p>
						</div>
					    <div class='form-group label-floating'>
						  <input class='form-control' id='focusedInput2' name='password' type='password' placeholder="Password" required>
						  <p class="help-block">Masukkan password sesuai portal akademik/sim sdm</p>
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