<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($usu_13 == 21 || $usu_13 == 87 || $usu_13 == 109){
        $codCar = 3;
        $codAcc = 2;
    } else {
        $codCar = 4;
        $codAcc = 1;
    }
    
    $workPage       = 'home.php?';
    $solictudesJSON = get_curl('200/solicitudes/'.$codCar.'/'.$usu_05.'/T');
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

    <head>
    <?php
        include '../include/header.php';
    ?>
    </head>

    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div id="main-wrapper">
<?php
    	include '../include/menu.php';
?>

            <div class="page-wrapper">
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
                
                <div class="container-fluid">
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
                $indIng                             = $indIng + 1;
                $solicitud_fecha_hora_colaborador   = ($solictudesVALUE['solicitud_fecha_hora_colaborador'] == '31/12/1969' ? '' : $solictudesVALUE['solicitud_fecha_hora_colaborador']);
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="p-2">
                                            <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                        </div>
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                            <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                            <div class="comment-footer">
                                                <span class="text-muted float-right"><?php echo $solicitud_fecha_hora_colaborador; ?></span>
                                                <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
<?php
                if ($usu_05 == $solictudesVALUE['solicitud_documento'] || ($usu_13 != 21 && $usu_13 != 87 && $usu_13 != 109)) {
?>                                    
                                                <button type="button" class="btn btn-success btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 2, 1, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>, '<?php echo $workPage; ?>');"><i class="fa fa-check"></i> </button>
                                                <button type="button" class="btn btn-danger btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Rechazar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>, '<?php echo $workPage; ?>');"><i class="fa fa-times"></i> </button>
<?php
                }
?>
                                            </div>
                                        </div>
                                    </div>

<?php
            }
        }
    }

    if ($indIng === 0){
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                        </div>
                                    </div>
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
                $indAut                         = $indAut + 1;
                $solicitud_fecha_hora_superior  = ($solictudesVALUE['solicitud_fecha_hora_superior'] == '31/12/1969' ? '' : $solictudesVALUE['solicitud_fecha_hora_superior']);  
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="p-2">
                                            <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                        </div>
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                            <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                            <div class="comment-footer">
                                                <span class="text-muted float-right"><?php echo $solicitud_fecha_hora_superior; ?></span>
                                                <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
                                                <button type="button" class="btn btn-info btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="ReIngresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 2, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>, '<?php echo $workPage; ?>');"><i class="ti-reload"></i> </button>
                                                <button type="button" class="btn btn-warning btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 3, 2, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>, '<?php echo $workPage; ?>');"><i class="fa fa-check"></i> </button>
                                                <button type="button" class="btn btn-danger btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Rechazar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 2, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>, '<?php echo $workPage; ?>');"><i class="fa fa-times"></i> </button>
                                            </div>
                                        </div>
                                    </div>

<?php
            }
        }
    }

    if ($indAut === 0){
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                        </div>
                                    </div>
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
                $indApr                         = $indApr + 1;
                $solicitud_fecha_hora_talento   = ($solictudesVALUE['solicitud_fecha_hora_talento'] == '31/12/1969' ? '' : $solictudesVALUE['solicitud_fecha_hora_talento']);
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="p-2">
                                            <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                        </div>
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                            <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                            <div class="comment-footer">
                                                <span class="text-muted float-right"><?php echo $solicitud_fecha_hora_talento; ?></span>
                                                <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
                                            </div>
                                        </div>
                                    </div>

<?php
            }
        }
    }

    if ($indApr === 0){
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                        </div>
                                    </div>
<?php
    }
?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card bg-light-danger">
                                <div class="card-body">
                                    <h4 class="card-title">SOLICITUDES RECHAZADAS</h4>
                                </div>
                                <div class="comment-widgets scrollable" style="height:350px;">
<?php
    $indAnu = 0;

    if ($solictudesJSON['code'] === 200){
        foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
            if ($solictudesVALUE['solicitud_estado_codigo'] === 'C'){
                $indAnu                 = $indAnu + 1;
                $auditoria_fecha_hora   = ($solictudesVALUE['auditoria_fecha_hora'] == '31/12/1969' ? '' : $solictudesVALUE['auditoria_fecha_hora']);
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="p-2">
                                            <img src="../assets/images/users/photo.png" alt="user" width="50" class="rounded-circle">
                                        </div>
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium"><?php echo trim(strtoupper($solictudesVALUE['solicitud_persona'])); ?></h6>
                                            <span class="m-b-15 d-block"><?php echo trim(strtoupper($solictudesVALUE['tipo_permiso_nombre'])); ?> </span>
                                            <div class="comment-footer">
                                                <span class="text-muted float-right"><?php echo $auditoria_fecha_hora; ?></span>
                                                <button type="button" class="btn btn-primary btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Ver Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i> </button>
                                                <button type="button" class="btn btn-info btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="ReIngresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, <?php echo $codAcc ?>, '<?php echo trim($usu_05); ?>', <?php echo trim($usu_13); ?>, '<?php echo $workPage; ?>');"><i class="ti-reload"></i> </button>
                                            </div>
                                        </div>
                                    </div>

<?php
            }
        }
    }

    if ($indAnu === 0){
?>
                                    <div class="d-flex flex-row comment-row">
                                        <div class="comment-text active w-100">
                                            <h6 class="font-medium">NO HAY SOLICITUDES.</h6>
                                        </div>
                                    </div>
<?php
    }
?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 class="col-10 card-title">Horarios de Marcaciones</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="tableLoad" class="table v-middle" style="width: 100%;">
                                            <thead id="tableCodigo" class="">
                                                <tr class="bg-conmebol" style="text-align:center;">
                                                    <th class="border-top-0">C&Oacute;DIGO</th>
                                                    <th class="border-top-0">FECHA</th>
                                                    <th class="border-top-0">ENTRADA OFICINA</th>
                                                    <th class="border-top-0">SALIDA ALMUERZO</th>
                                                    <th class="border-top-0">ENTRADA ALMUERZO</th>
                                                    <th class="border-top-0">SALIDA OFICINA</th>
                                                    <th class="border-top-0">COMENTARIO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
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
                </div>

                <a href="javascript:void(0)" class="float" style="background-color:#163562 !important; color:#ffffff !important;" data-toggle="modal" data-target="#modaldiv" title="Nueva Solicitud" onclick="setSolicitud('<?php echo $workPage; ?>');">
                    <i class="fa fa-plus custom-float"></i>
                </a>

<?php
    include '../include/development.php';
?>

            </div>
        </div>
        
        <div class="chat-windows"></div>

<?php
    include '../include/footer.php';
?>

        <script src="../js/api.js?<?php echo date('Ymd'); ?>"></script>
        <script src="../js/tpersonal.js?<?php echo date('Ymd'); ?>"></script>

        <script>
            const docFunc = '<?php echo trim($usu_05); ?>';

            if (localStorage.getItem('solicitudJSON') === 'null' || localStorage.getItem('solicitudJSON') === null ){
                localStorage.removeItem('solicitudJSON');
                localStorage.setItem('solicitudJSON', JSON.stringify(<?php echo json_encode(get_curl('100/solicitud')); ?>));
            }

            if (localStorage.getItem('solicitudesJSON') === 'null' || localStorage.getItem('solicitudesJSON') === null ){
                localStorage.removeItem('solicitudesJSON');
                localStorage.setItem('solicitudesJSON', JSON.stringify(<?php echo json_encode($solictudesJSON); ?>));
            }
        </script>

        <script src="../js/marcacion.js?<?php echo date('Ymd');?>"></script>
    </body>
</html>