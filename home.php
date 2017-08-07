<!DOCTYPE HTML>
<html>
    <head>
        <title>PORTAL SURVEY USU</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="img/logo.png" />

        <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">  

        <!-- CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/dist/css/bootstrap.min.css">     
      
        <!-- START @PAGE LEVEL STYLES -->
        <link href="assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        
        <link href="assets/plugins/animate.css/animate.min.css" rel="stylesheet">

        <!-- DatePicker -->
        <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-datepicker-vitalets/css/datepicker.css" rel="stylesheet">
        
        <!-- Datatables -->
        <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
        
        <!--Multiple -->
        <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
        <link href="assets/plugins/chosen_v1.2.0/chosen.min.css" rel="stylesheet">

        <!-- START @THEME STYLES -->
        
        <link href="assets/css/layout.css" rel="stylesheet">
        <link href="assets/css/error-page.css" rel="stylesheet">
        <link href="assets/css/components.css" rel="stylesheet">
        <link href="assets/css/default.theme.css" rel="stylesheet">

        <!-- JQuery & Bootstrap -->
        <script src="assets/plugins/bootstrap/js/jquery-3.1.1.min.js"></script>
        <script src="assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src='assets/plugins/bootstrap/js/function.js'></script>
    </head>
<body>
    <section id="wrapper">
        <header id="header" class="page-header-fixed navbar-fixed-top">
            <nav class="navbar navbar-toolbar navbar-fixed-top" style='background-color: #81B71A;'>
                <div class="nav navbar-nav navbar-left" style="color:white;">
                        <a class="navbar-brand" href='#' style="color:white;">PortalSurvey USU </a>
                    <div class="clearfix"></div>
                </div>
            </nav>
        </header>
      
        <section class="body-content animated fadeIn container-fluid text-middle">
            <?php 
                 $link = JWTAuth::makeLink([
            'baseUrl' => 'https://akun.usu.ac.id/auth/login',
            'callback' => 'https://survey.usu.ac.id/callback.php',
            'redir' => 'https://survey.usu.ac.id/'
        ]);
            ?>
        </section>
        <footer class="footer-content text-center">
            2017 - <span id="copyright"></span> &copy; Portal Survey USU
        </footer>
    </section>

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

<script src="assets/plugins/bootstrap/js/zingchart.min.js"></script>

<script src="assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js">
</script>
<script src="assets/plugins/moment/min/moment.min.js"></script>

<!--Daterangepicker js -->
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js"></script>

<!--Datatables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script> 

<!--Multiple -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script src="assets/plugins/chosen_v1.2.0/chosen.jquery.min.js"></script>
<!-- form picker -->
<script src="assets/plugins/bootstrap/js/blankon.form.picker.js"></script>

<script src="assets/plugins/bootstrap/js/blankon.form.element.js"></script>

</body>
</html>