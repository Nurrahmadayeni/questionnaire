<?php
    // error_reporting(0);
    session_start();

    require_once('vendor/autoload.php');
    include('lib/config.php');

    // namespaces
    use parinpan\fanjwt\libs\JWTAuth;


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
            'redir' => 'https://survey.usu.ac.id',
            'callback' => 'https://survey.usu.ac.id/callback.php',
    ]);


    if($credentialSSO->logged_in){
        
        $username = $credentialSSO->payload->identity;
        
        $query = "SELECT level from users_auth where username='$username'";
        $data_admin = $mysqli->query($query);
        $user = $data_admin->fetch_assoc();

        if($user['level'] =='super'){
            $_SESSION['username_q'] = "Super Admin";
            $_SESSION['level'] =  'super';
            $_SESSION['status'] = 'super';
            $_SESSION['username'] = $username;
        }else if($user['level']=='admin'){
            
            $str = file_get_contents('https://api.usu.ac.id/1.0/users/'.$username);

            $data = json_decode($str, TRUE);
            $_SESSION['username_q'] = $data['full_name'];

            // faculties
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'https://api.usu.ac.id/1.0/faculties');

            $result = curl_exec($ch);
            curl_close($ch);

            $obj = json_decode($result);
            $fakultas = array();
            foreach ($obj as $key => $value) {
                array_push($fakultas,$obj[$key]->code);
            }
            
            if(in_array($data['work_unit'], $fakultas)){
                $_SESSION['level'] =  'fakultas';
            }else{
                $_SESSION['level'] =  'unit';
            }

            $_SESSION['status'] = $data['work_unit'];
            $_SESSION['username'] = $username;

        }else{
            $str = file_get_contents('https://api.usu.ac.id/1.0/users/'.$username);

            $data = json_decode($str, TRUE);
            $_SESSION['username_q'] = $data['full_name'];
            $_SESSION['username'] = $username;
            $_SESSION['status'] = $data['work_unit'];
            if($data['type']==1 || $data['type']==5){
                $_SESSION['level'] =  'pgw';
            }else{
                $_SESSION['level'] =  'dsn';
            }   
        }

    	require('dashboard.php');    	
    } else {
        setcookie('ssotok', null, -1, '/');
        require('landing-page.php');
    }
?>