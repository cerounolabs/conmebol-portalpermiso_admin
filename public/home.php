<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
        $msgRest        = '';
    }

    $solictudesJSON = get_curl('200/solicitudes/1');
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
                        <h4 class="page-title">Bienvenido <?php echo $usu_01.' '.$usu_04; ?></h4>
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
                        <div class="card bg-light-info">
                            <div class="card-body">
                                <h4 class="card-title">SOLICITUDES INGRESADAS</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="height:400px;">
<?php
    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'I'){       
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                    </div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                        <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right"><?php echo trim(strtoupper($solictudesVALUE['solicitud_fecha_hora_colaborador'])); ?></span>
                                        </div>
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
                        <div class="card bg-light-success">
                            <div class="card-body">
                                <h4 class="card-title">SOLICITUDES AUTORIZADAS</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="height:400px;">
<?php
    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'A'){       
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                    </div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                        <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right"><?php echo trim(strtoupper($solictudesVALUE['solicitud_fecha_hora_aprobador'])); ?></span>
                                        </div>
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
                        <div class="card bg-light-warning">
                            <div class="card-body">
                                <h4 class="card-title">SOLICITUDES APROBADAS</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="height:400px;">
<?php
    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'P'){       
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                    </div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                        <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right"><?php echo trim(strtoupper($solictudesVALUE['solicitud_fecha_hora_talento'])); ?></span>
                                        </div>
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
                                <h4 class="card-title">SOLICITUDES ANULADAS</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="height:400px;">
<?php
    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'C'){       
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                    </div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                        <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right"><?php echo trim(strtoupper($solictudesVALUE['solicitud_fecha_hora_talento'])); ?></span>
                                        </div>
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