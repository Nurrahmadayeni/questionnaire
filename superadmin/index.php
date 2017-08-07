<?php
    error_reporting(0);
    session_start();
    include('lib/config.php');

    if(isset($_SESSION['username_q']) && !empty($_SESSION['username_q'])){
        require('dashboard.php');
       
    }else{
        switch ($_GET['do']){
            default:
                    include('login.php');
                break;
        }
    }
?>
