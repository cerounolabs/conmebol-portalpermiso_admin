<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    }

    unset($_SESSION['log_01']);
    unset($_SESSION['log_02']);
    unset($_SESSION['log_03']);
    
    unset($_SESSION['usu_01']);
    unset($_SESSION['usu_02']);
    unset($_SESSION['usu_03']);
    unset($_SESSION['usu_04']);

    unset($_SESSION['expire']);

    session_unset();
    session_destroy();

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
    }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="CONMEBOL, Sistema Permiso">
	<meta name="author" content="IT Consulting - https://it.com.py">

	<!--<link href="assets/images/favicon.ico" rel="icon" type="image/png" sizes="16x16">-->
    <link href="http://www.conmebol.com/sites/all/themes/conm/favicon.ico" type="image/vnd.microsoft.icon" rel="shortcut icon"/>
	<link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
	<link href="assets/libs/morris.js/morris.css" rel="stylesheet">
	<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="assets/libs/select2/dist/css/select2.min.css" type="text/css" rel="stylesheet">
    <link href="assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
	<link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
	<link href="dist/css/style.css" rel="stylesheet">
    
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></scri
	<![endif]-->
	
	<title>CONMEBOL | SISTEMA PERMISO</title>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background-color:#005ea6;">
            <div class="auth-box" style="background-color:#e4f1fa;">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="assets/images/logo_index_2.png" style="height:100px;" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" id="loginform" method="post" action="class/session/session_index.php">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="val_01" name="val_01" aria-label="val_01" aria-describedby="basic-addon1" placeholder="Email" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" id="val_02" name="val_02" aria-label="val_02" aria-describedby="basic-addon1" placeholder="Password" required>
                                </div>

                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" style="background-color:#005caa;" type="submit">INICIAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>

<?php  
    if ($codeRest == 401) {
?>
    <script>
        $(function() {
            toastr.error('<?php echo $msgRest; ?>', 'Error!');
        });
    </script>
<?php
    }
?>
</body>

</html>