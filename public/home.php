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

    if ($usu_13 == 21 || $usu_13 == 85 || $usu_13 == 107){
        $codCar = 3;
    } else {
        $codCar = 2;
    }

    $workPage       = 'home.php?';
    $solictudJSON   = get_curl('100');
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
                                            <button type="button" class="btn btn-success btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 2, 1);"><i class="fa fa-check"></i> </button>
                                            <button type="button" class="btn btn-danger btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Anular Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1);"><i class="fa fa-times"></i> </button>
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
                                            <button type="button" class="btn btn-info btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="ReIngresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 2);"><i class="ti-reload"></i> </button>
                                            <button type="button" class="btn btn-warning btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 3, 2);"><i class="fa fa-check"></i> </button>
                                            <button type="button" class="btn btn-danger btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="Anular Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 2);"><i class="fa fa-times"></i> </button>
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
                                            <span class="text-muted float-right"><?php echo trim(strtoupper($solictudesVALUE['solicitud_fecha_hora_talento'])); ?></span>
                                            <button type="button" class="btn btn-info btn-circle" id="<?php echo $solictudesVALUE['solicitud_codigo']; ?>" value="<?php echo $solictudesVALUE['solicitud_estado_codigo']; ?>" value2="<?php echo $solictudesVALUE['solicitud_documento']; ?>" title="ReIngresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 4);"><i class="ti-reload"></i> </button>
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

            <a href="javascript:void(0)" class="float" style="background-color:#163562 !important; color:#ffffff !important;" data-toggle="modal" data-target="#modaldiv" title="Nueva Solicitud" onclick="setSolicitud(1);">
                <i class="fa fa-plus custom-float"></i>
            </a>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php
    include '../include/development.php';
    include '../public/genSolicitud.php';
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
   
    if ($codeRest == 200) {
?>
    <script>
        $(function() {
            toastr.success('<?php echo $msgRest; ?>', 'Correcto!');
        });
    </script>
<?php
    }
            
    if (($codeRest == 204) || ($codeRest == 401)) {
?>
    <script>
        $(function() {
            toastr.error('<?php echo $msgRest; ?>', 'Error!');
        });
    </script>
<?php
    }
?>
    <script>
        /*
        function setEstado(rowSel, rowEst, rowAcc){
            var codRow  = document.getElementById(rowSel);
            var codFun  = '<?php //echo trim($usu_05); ?>';
            var codCar  = '<?php //echo trim($usu_13); ?>';
            var html    = '';
            var titEst  = '';

            switch (rowEst) {
                case 'I':
                    titEst  = 'Re-Ingresar Solicitud';
                    colEst  = '#2585e4;';
                    titMen  = 'FAVOR SOLICITAR A SU TALENTO HUMANO DICHO RE-INGRESO. VERIFIQUE!';
                    break;

                case 'A':
                    titEst  = 'Autorizar Solicitud';
                    colEst  = '#22c6ab;';
                    titMen  = 'FAVOR SOLICITAR A SU JEFATURA DICHA AUTORIZACION. VERIFIQUE!';
                    break;

                case 'P':
                    titEst  = 'Aprobar Solicitud';
                    colEst  = '#ffaf0e;';
                    titMen  = 'FAVOR SOLICITAR A SU TALENTO HUMANO DICHA APROBACION. VERIFIQUE!';
                    break;

                case 'C':
                    titEst  = 'Anular Solicitud';
                    colEst  = '#eb4c4c;';
                    titMen  = 'FAVOR SOLICITAR A SU TALENTO HUMANO DICHA ANULACION. VERIFIQUE!';
                    break;
            }

            if (codRow.getAttribute('value2') != codFun) {
                if ((codRow.getAttribute('value') == 'A' || codRow.getAttribute('value') == 'C') && (rowEst == 'I' || rowEst == 'P' || rowEst == 'C') && (codCar == 21 || codCar == 85 || codCar == 107)) {
                    html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                    '	    <div class="modal-header" style="color:#fff; background:'+colEst+';">'+
                    '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workAccion" name="workAccion" value="'+rowAcc+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workPage" name="workPage" value="home.php?" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="var01" name="var01" value="'+rowEst+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '           </div>'+
                    '           <div class="row pt-3">'+
                    '                <div class="col-sm-12">'+
                    '                    <div class="form-group">'+
                    '                        <label for="var02">COMENTARIO</label>'+
                    '                        <textarea id="var02" name="var02" class="form-control" rows="3" style="text-transform:uppercase;" required></textarea>'+
                    '                    </div>'+
                    '                </div>'+
                    '           </div>'+
                    '	    </div>'+
                    '	    <div class="modal-footer">'+
                    '           <button type="submit" class="btn btn-info">Actualizar</button>'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                } else {
                    if (codRow.getAttribute('value') == 'I') {
                        html    =
                        '<div class="modal-content">'+
                        '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                        '	    <div class="modal-header" style="color:#fff; background:'+colEst+';">'+
                        '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                        '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                        '	    </div>'+
                        '	    <div class="modal-body" >'+
                        '           <div class="form-group">'+
                        '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                        '               <input id="workAccion" name="workAccion" value="'+rowAcc+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                        '               <input id="workPage" name="workPage" value="home.php?" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                        '               <input id="var01" name="var01" value="'+rowEst+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                        '           </div>'+
                        '           <div class="row pt-3">'+
                        '                <div class="col-sm-12">'+
                        '                    <div class="form-group">'+
                        '                        <label for="var02">COMENTARIO</label>'+
                        '                        <textarea id="var02" name="var02" class="form-control" rows="3" style="text-transform:uppercase;" required></textarea>'+
                        '                    </div>'+
                        '                </div>'+
                        '           </div>'+
                        '	    </div>'+
                        '	    <div class="modal-footer">'+
                        '           <button type="submit" class="btn btn-info">Actualizar</button>'+
                        '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                        '	    </div>'+
                        '   </form>'+
                        '</div>';
                    } else {
                        html    =
                        '<div class="modal-content">'+
                        '   <form id="form" data-parsley-validate method="post" action="#">'+
                        '	    <div class="modal-header" style="color:#fff; background:'+colEst+'">'+
                        '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                        '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                        '	    </div>'+
                        '	    <div class="modal-body" >'+
                        '           <div class="form-group">'+
                        '               <h4 style="text-align:center;">'+titMen+'</h4>'
                        '           </div>'+
                        '	    </div>'+
                        '	    <div class="modal-footer">'+
                        '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                        '	    </div>'+
                        '   </form>'+
                        '</div>';
                    }
                }
            } else {
                if (codRow.getAttribute('value') == 'I' && rowEst == 'C') {
                    html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                    '	    <div class="modal-header" style="color:#fff; background:'+colEst+';">'+
                    '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workAccion" name="workAccion" value="'+rowAcc+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workPage" name="workPage" value="home.php?" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="var01" name="var01" value="'+rowEst+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '           </div>'+
                    '           <div class="row pt-3">'+
                    '                <div class="col-sm-12">'+
                    '                    <div class="form-group">'+
                    '                        <label for="var02">COMENTARIO</label>'+
                    '                        <textarea id="var02" name="var02" class="form-control" rows="3" style="text-transform:uppercase;" required></textarea>'+
                    '                    </div>'+
                    '                </div>'+
                    '           </div>'+
                    '	    </div>'+
                    '	    <div class="modal-footer">'+
                    '           <button type="submit" class="btn btn-info">Actualizar</button>'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                } else {
                    html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="#">'+
                    '	    <div class="modal-header" style="color:#fff; background:'+colEst+'">'+
                    '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <h4 style="text-align:center;">'+titMen+'</h4>'
                    '           </div>'+
                    '	    </div>'+
                    '	    <div class="modal-footer">'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                }
            }

            $("#modalcontent").empty();
            $("#modalcontent").append(html);
        }
        */
    </script>
</body>
</html>