<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($usu_13 != 21 && $usu_13 != 87 && $usu_13 != 109){
        header('Location: ../public/home.php?code=401&msg=No tiene permiso para ingresar!Contacte con TI');
    }

    $solPAPMANJSON  = get_curl('200/solicitudes/grafico/tipodet/F/32');
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
<?php
    include '../include/header.php';
?>
</head>

<body>
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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
<?php
    	include '../include/menu.php';
?>
       
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">LICENCIA POR PAP Y MAMOGRAF&Iacute;A</h4>
                        <div class="d-flex align-items-center"></div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../public/home.php">Home</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="card bg-light-success">
                            <div class="card-body">
                                <h4 class="card-title">YA SE HICERON - PERIODO <?php echo date('Y'); ?></h4>
                            </div>
                            <div class="comment-widgets scrollable" style="height:350px;">
<?php
    if ($solPAPMANJSON['code'] === 200){
        foreach ($solPAPMANJSON['data'] as $solKEY => $solVALUE) {
            if ($solVALUE['solicitud_tipo'] == 'CON_SOLICITUD') {
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                    </div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium"><?php echo trim(strtoupper($solVALUE['solicitud_persona'])); ?></h6>
                                        <span class="m-b-15 d-block">DOC NRO.: <?php echo trim(strtoupper($solVALUE['solicitud_documento'])); ?></span>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
            }
        }
    }
?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="card bg-light-danger">
                            <div class="card-body">
                                <h4 class="card-title">LOS QUE FALTAN - PERIODO <?php echo date('Y'); ?></h4>
                            </div>
                            <div class="comment-widgets scrollable" style="height:350px;">
<?php
    if ($solPAPMANJSON['code'] === 200){
        foreach ($solPAPMANJSON['data'] as $solKEY => $solVALUE) {
            if ($solVALUE['solicitud_tipo'] == 'SIN_SOLICITUD') {
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                    </div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium"><?php echo trim(strtoupper($solVALUE['solicitud_persona'])); ?></h6>
                                        <span class="m-b-15 d-block">DOC NRO:. <?php echo trim(strtoupper($solVALUE['solicitud_documento'])); ?></span>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
            }
        }
    }
?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Procesar -->
                <div id="modaldiv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" id="modalcontent">
                    </div>
                </div>
                <!-- Modal Procesar -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php
    include '../include/development.php';
?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>

<?php
    include '../include/footer.php';
?>
</body>
</html>