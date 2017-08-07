<!DOCTYPE HTML>
<html>
    <head>
        <title>PORTAL SURVEY USU</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../img/logo.png" />
        
        <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">  

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/plugins/bootstrap/dist/css/bootstrap.min.css">     
      
        <!-- START @PAGE LEVEL STYLES -->
        <link href="../assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        
        <link href="../assets/plugins/animate.css/animate.min.css" rel="stylesheet">

        <!-- DatePicker -->
        <link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="../assets/plugins/bootstrap-datepicker-vitalets/css/datepicker.css" rel="stylesheet">
        
        <!-- Datatables -->
        <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">
        
        <!--Multiple -->
        <link rel="stylesheet" href="../assets/plugins/select2/select2.min.css">
        <link href="../assets/plugins/chosen_v1.2.0/chosen.min.css" rel="stylesheet">

        <!-- START @THEME STYLES -->
        
        <link href="../assets/css/layout.css" rel="stylesheet">
        <link href="../assets/css/error-page.css" rel="stylesheet">
        <link href="../assets/css/components.css" rel="stylesheet">
        <link href="../assets/css/default.theme.css" rel="stylesheet">

        <!-- JQuery & Bootstrap -->
        <script src="../assets/plugins/bootstrap/js/jquery-3.1.1.min.js"></script>
        <script src="../assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src='../assets/plugins/bootstrap/js/function-super.js'></script>

        <style type="text/css">
            a:hover{
                text-decoration:none;
            }
            .clickable-row{
                cursor: pointer;
            }
            #alert,#alert2{
                border: 1px solid;
                border-radius: 4px;  
                position: relative !important; 
                display:none; 
                z-index: 9999; 
                margin-bottom: -10px; 
                margin-top: -60px;
            }  
            hr.style { 
              height: 30px; 
              border-style: solid; 
              border-color: #8c8b8b; 
              border-width: 1px 0 0 0; 
              border-radius: 20px; 
              margin-top: -5px;
            } 

            hr.style:before { 
              display: block; 
              content: ""; 
              height: 30px; 
              margin-top: -31px; 
              border-style: solid; 
              border-color: #8c8b8b; 
              border-width: 0 0 1px 0; 
              border-radius: 20px; 
            }
            .daftar{
                text-shadow: 2px 2px #c0c0c0;
                padding-top: 2%;
            }
            #panel{
                -webkit-box-shadow: -1px -1px 10px 0px rgba(0,0,0,0.5);
                -moz-box-shadow: -1px -1px 10px 0px rgba(0,0,0,0.5);
                box-shadow: -1px -1px 10px 0px rgba(0,0,0,0.5);
            }           
            #panel{
              display:none;
            }

            hr.title {
                height: 5px;
                border: 0;
                margin-top: -1%; 
                box-shadow: 0 5px 5px -5px #8c8b8b inset;
            }
            .thumbnail_head{
                width:100%;
                height:100px;
                background-color: #81B71A;
                color:white;
                vertical-align:middle;
                text-align: center;
                font-weight: bold;
                font-size: 30pt;
                padding-top: 20px;
            }
        </style>
    </head>
<body <?php if(!empty($_GET['d'])){ echo "class='page-sound page-header-fixed page-sidebar-fixed page-footer-fixed'"; } ?> >
    <section id="wrapper">
        <?php
            require_once('../lib/config.php');
            // require_once('lib/function.php');
            include('modals.php');

        ?>
        <header id="header" class="page-header-fixed navbar-fixed-top">
            <nav class="navbar navbar-toolbar navbar-fixed-top" style='background-color: #81B71A;'>
                <div class="nav navbar-nav navbar-left" style="color:white;">
                        <a class="navbar-brand" href='/super' style="color:white;">PortalSurvey USU </a>
                            <span class='navbar-brand'>SUPERUSER</span>
                    <div class="clearfix"></div>
                </div>
                <div class="nav navbar-nav navbar-right">
                    <li class="dropdown navbar-profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="avatar"><img src="../img/logo.png" class="img-circle"></span>
                                <span class="text hidden-xs hidden-sm text-muted" style='color:white;'><?= $_SESSION['username_su'] ?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                            <li>
                                <a href='#' data-toggle='modal' data-target='#logout'><i class="fa fa-sign-out"></i>Sign out</a>
                            </li>
                        </ul>
                    </li>
                </div>
            </nav>
        </header>
        <?php if(!empty($_GET['d'])){ if($_SESSION['level']=='super'){ include ('../mods/menu.php'); }else{include ('mods/menu.php');}} ?>
        <section class="body-content animated fadeIn container-fluid text-middle" <?php 
            if(!empty($_GET['d'])){
                echo "id='page-content'";
            }
                ?> style="padding-top:2%; ">
                <?php
                // var_dump($_SESSION); 
                    switch ($_SESSION['level']) {
                        case 'super':
                            switch (base64_decode($_GET['d'])) {
                                case 'dashboard_tampilan_home_pengguna':
                                    include('../mods/frontend/admin/home.php');
                                break;
                                case 'tampilan_error_pengguna_admin':
                                    include('../mods/frontend/error.php');
                                break;
                                case 'tambah_survey_pengguna_admin':
                                    include('../mods/frontend/admin/addSurvey.php');
                                break;
                                case 'list_survey_pengguna_admin':
                                    include('../mods/frontend/admin/listSurvey.php');
                                break;
                                case 'edit_survey_pengguna_admin':
                                    include('../mods/frontend/admin/editSurvey.php');
                                break;
                                case 'tambah_question_pengguna_admin':
                                    include('../mods/frontend/admin/addQuestion.php');
                                break;
                                case 'tambah_new_question_pengguna_admin':
                                    include('../mods/frontend/admin/newQuestion.php');
                                break;
                                case 'list_question_pengguna_admin':
                                    include('../mods/frontend/admin/listQst.php');
                                    break;
                                case 'edit_question_pengguna_admin':
                                    include('../mods/frontend/admin/editQst.php');
                                break;
                                case 'add_profile_pengguna_admin':
                                    include('../mods/frontend/admin/addProfile.php');
                                break;
                                case 'copy_survey_pengguna_admin':
                                    include('../mods/frontend/admin/copySurvey.php');
                                break;
                                case 'jawab_survey_pengguna_admin':
                                    include('../mods/frontend/admin/jawabSurvey.php');
                                break;
                                case 'list_tampilan_question_admin':
                                    include('../mods/frontend/admin/question.php');
                                break;
                                case 'report_survey_pengguna_admin':
                                    include('../mods/frontend/admin/reportSurvey.php');
                                break;
                                case 'daftar_user_admin_superuser':
                                    include('../mods/frontend/admin/listUser.php');
                                break;
                                default:
                                    include('../mods/frontend/admin/home.php');
                                break;
                            }  
                        break;
                        default:
                            include('../mods/frontend/admin/home.php');
                        break;
                    }
                ?>                                    
        </section>
        <footer class="footer-content text-center">
            2017 - <span id="copyright"></span> &copy; Portal Survey USU
        </footer>
    </section>

</body>
<script>
  $(function () {
    $("#data").DataTable();
    $(".select2").select2();
    $('[data-toggle="tooltip"]').tooltip();   
  });
    var d = new Date();
    var n = d.getFullYear();
    // document.getElementById("username") = localStorage.getItem("username");
    document.getElementById('copyright').innerHTML=n;
</script>

<script src="../assets/plugins/bootstrap/js/zingchart.min.js"></script>

<script src="../assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js">
</script>
<script src="../assets/plugins/moment/min/moment.min.js"></script>

<!--Daterangepicker js -->
<script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../assets/plugins/bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js"></script>

<!--Datatables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script> 

<!--Multiple -->
<script src="../assets/plugins/select2/select2.full.min.js"></script>

<script src="../assets/plugins/chosen_v1.2.0/chosen.jquery.min.js"></script>
<!-- form picker -->
<script src="../assets/plugins/bootstrap/js/blankon.form.picker.js"></script>

<script src="../assets/plugins/bootstrap/js/blankon.form.element.js"></script>

</html>