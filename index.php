<?php
    error_reporting(0);
    session_start();

    require_once('vendor/autoload.php');
    include('lib/config.php');

    // namespaces
    use parinpan\fanjwt\libs\JWTAuth;

    /*if(isset($_SESSION['username_q']) && !empty($_SESSION['username_q'])){
        require('dashboard.php');
    }else{
        switch ($_GET['do']){
            case 'login':
                    include('mods/backend/login.php');
                break;
            default:
                    include('mods/frontend/login.php');
                break;
        }
    }*/

    $credentialSSO = JWTAuth::communicate(
	'https://akun.usu.ac.id/auth/listen',
	@$_COOKIE['ssotok']
    );

    $loginLink = JWTAuth::makeLink([
	'baseUrl' => 'https://akun.usu.ac.id/auth/login',
        'callback' => 'https://survey.usu.ac.id/callback.php',
        'redir' => 'https://survey.usu.ac.id'
    ]);

    $logoutLink = JWTAuth::makeLink([
        'baseUrl' => 'https://akun.usu.ac.id/auth/logout',
        'redir' => 'https://survey.usu.ac.id'
    ]);

    if($credentialSSO->logged_in)
    {

    }

    else
    {
	setcookie('ssotok', null, -1, '/');
	echo "<a href=\"$loginLink\">Login</a>";
    }
?>
