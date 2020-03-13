<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($usu_13 == 21 || $usu_13 == 87 || $usu_13 == 109){
        $codCar = 3;
    } else {
        $codCar = 4;
    }

    $workPage       = 'home.php?';
    $solictudesJSON = get_curl('200/solicitud/'.$codCar.'/'.$usu_05);

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
                            <div class="comment-widgets scrollable" style="height:350px;">
<?php
    $indIng = 0;

    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'I'){
                $indIng = $indIng + 1;
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
                                            <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
<?php
                if ($usu_05 == $solictudesVALUE['solicitud_documento'] || ($usu_13 != 21 && $usu_13 != 87 && $usu_13 != 109)) {
?>                                    
                                            <button type="button" class="btn btn-success btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 2, 1, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>);"><i class="fa fa-check"></i> </button>
                                            <button type="button" class="btn btn-danger btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Anular Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>);"><i class="fa fa-times"></i> </button>
<?php
                }
?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
            }
        }
    }

    if ($indIng === 0){
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
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
                            <div class="comment-widgets scrollable" style="height:350px;">
<?php
    $indAut = 0;

    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'A'){
                $indAut = $indAut + 1;     
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
                                            <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
                                            <button type="button" class="btn btn-info btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="ReIngresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 2, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>);"><i class="ti-reload"></i> </button>
                                            <button type="button" class="btn btn-warning btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 3, 2, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>);"><i class="fa fa-check"></i> </button>
                                            <button type="button" class="btn btn-danger btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Anular Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 2, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>);"><i class="fa fa-times"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
            }
        }
    }

    if ($indAut === 0){
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
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
                            <div class="comment-widgets scrollable" style="height:350px;">
<?php
    $indApr = 0;

    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'P'){
                $indApr = $indApr + 1;  
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
                                            <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
            }
        }
    }

    if ($indApr === 0){
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
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
                            <div class="comment-widgets scrollable" style="height:350px;">
<?php
    $indAnu = 0;

    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'C'){
                $indAnu = $indAnu + 1;
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
                                            <span class="text-muted float-right"><?php echo trim(strtoupper($solictudesVALUE['auditoria_fecha_hora'])); ?></span>
                                            <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
                                            <button type="button" class="btn btn-info btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="ReIngresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 4, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>);"><i class="ti-reload"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
            }
        }
    }

    if ($indAnu === 0){
?>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                    </div>
                                </div>
                                <!-- Comment Row -->
<?php
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

            <a href="javascript:void(0)" class="float" style="background-color:#163562 !important; color:#ffffff !important;" data-toggle="modal" data-target="#modaldiv" title="Nueva Solicitud" onclick="setSolicitud('<?php echo $workPage; ?>');">
                <i class="fa fa-plus custom-float"></i>
            </a>

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

    <script src="../js/api.js"></script>

    <script>
        if (localStorage.getItem('solicitudJSON') === 'null' || localStorage.getItem('solicitudJSON') === null ){
            localStorage.removeItem('solicitudJSON');
            localStorage.setItem('solicitudJSON', JSON.stringify(<?php echo json_encode(get_curl('100')); ?>));
        }

        if (localStorage.getItem('solicitudesJSON') === 'null' || localStorage.getItem('solicitudesJSON') === null ){
            localStorage.removeItem('solicitudesJSON');
            localStorage.setItem('solicitudesJSON', JSON.stringify(<?php echo json_encode($solictudesJSON); ?>));
        }
    </script>
</body>
</html>