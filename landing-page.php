<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Manajemen Survey | Universitas Sumatera Utara">
    <meta name="keywords" content="survey, sistem informasi manajamen survey, usu, universitas sumatera utara">
    <meta name="author" content="PSI USU">
    <link rel="icon" type="image/png" href="img/logo.png" />

    <title>SURVEY USU - Landing Page</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/dist/css/bootstrap.min.css">

    <!-- Theme CSS -->
    <link href="assets/css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#page-top">SURVEY</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="#about">Tentang SURVEY</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container" id="maincontent" tabindex="-1">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-responsive" src="img/logo-1.png" alt="">
                <div class="intro-text">
                    <h1 class="name">SURVEY</h1>
                    <hr class="star-light">
                    <span class="skills">Sistem Informasi Manajemen SURVEY USU</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- About Section -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Tentang SURVEY</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <p>SURVEY merupakan sistem informasi yang dirancang untuk memudahkan dalam melakukan survey secara online.</p>
            </div>
            <div class="col-lg-4">
                <p>Untuk dapat menggunakan SURVEY, dosen/pegawai/mahasiswa harus melakukan login terlebih dahulu. Silahkan klik tombol login di bawah untuk melakukan login.</p>
            </div>
            <?php  
                use parinpan\fanjwt\libs\JWTAuth;
                $loginLink = JWTAuth::makeLink([
                    'baseUrl' => 'https://akun.usu.ac.id/auth/login',
                    'callback' => 'https://survey.usu.ac.id/callback.php',
                    'redir' => 'https://survey.usu.ac.id'
                ]);
            ?>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="<?=$loginLink?>" class="btn btn-lg btn-primary btn-outline">
                    <i class="fa fa-sign-in"></i> Login
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright &copy; PSI 2017
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="assets/plugins/bootstrap/js/jquery-3.1.1.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Theme JavaScript -->
<script src="assets/js/freelancer.min.js"></script>

</body>

</html>
