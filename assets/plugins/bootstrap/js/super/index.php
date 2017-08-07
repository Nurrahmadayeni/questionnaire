<?php
    // error_reporting(0);
    session_start();

    if($_SESSION['level']!='super'){
    session_destroy();
    }
	include('lib/config.php');

    if(isset($_SESSION['username_su']) && !empty($_SESSION['username_su'])){
        require('dashboard.php');
       
    }else{
		require('login.php');
        
    }
?>
