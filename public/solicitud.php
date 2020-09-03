<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';
    
    if ($usu_09 != 6){
        header('Location: ../public/home.php?code=401&msg=No tiene permiso para ingresar!Contacte con TI');
    }
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
                                    <li class="breadcrumb-item active" aria-current="page">Solicitudes</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="col-10 card-title">Solicitudes</h4>
                                    <h4 class="col-2 card-title" style="text-align: right;">
                                        <a class="btn btn-info" style="background-color:#163562; border-color:#163562;"  href="javascript:void(0)" role="button" title="Procesar" data-toggle="modal" data-target="#modaldiv" onclick="setProcesar();"><i class="ti-reload"></i></a>
                                	</h4>
								</div>
                                <div class="table-responsive">
                                    <table id="tableLoad" class="table v-middle" style="width: 100%;">
                                        <thead id="tableCodigo" class="">
                                            <tr class="bg-conmebol" style="text-align:center;">
                                                <th class="border-top-0">C&Oacute;DIGO</th>
                                                <th class="border-top-0">ESTADO</th>
                                                <th class="border-top-0">CATEGOR&Iacute;A</th>
                                                <th class="border-top-0">ORDEN</th>
                                                <th class="border-top-0">SOLICITUD</th>
                                                <th class="border-top-0">DÍA LIMITE</th>
                                                <th class="border-top-0">DÍA CORRIDO</th>
                                                <th class="border-top-0">DÍA UNIDAD</th>
                                                <th class="border-top-0">ARCHIVO ADJUNTO</th>
                                                <th class="border-top-0">OBSERVACI&Oacute;N</th>
                                                <th class="border-top-0">USUARIO</th>
                                                <th class="border-top-0">FECHA HORA</th>
                                                <th class="border-top-0">IP</th>
                                                <th class="border-top-0">EDITAR</th>
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

    <script src="../js/api.js?<?php echo date('Ymd');?>"></script>

    <script>
        function setProcesar(){
            var html =
            '<div class="modal-content" style="background-color:transparent; border:0px">'+
            '   <div class="col-12">'+
            '       <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">'+
            '           <span class="sr-only">Loading...</span>'+
            '       </div>'+
            '   </div>'+
            '   <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">'+
            '       <span class="sr-only">Loading...</span>'+
            '   </div>'+
            '</div>';

            $("#modalcontent").empty();
            $("#modalcontent").append(html);

            var xHTTP	= new XMLHttpRequest();
            var xURL	= urlBASE + '/100/procesar';
            var xPARS   = JSON.stringify({
                "auditoria_usuario": "<?php echo trim(strtoupper($usu_03)); ?>",
                "auditoria_fecha_hora": "<?php echo date('Y-m-d H:i:s'); ?>",
                "auditoria_ip": "<?php echo $log_03; ?>"
            });

            xHTTP.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var xJSON   = JSON.parse(this.responseText);
                    var xDataURL= '../public/solicitud.php?code=' + xJSON['code'] + '&msg=' + xJSON['message'];
                    window.location.replace(xDataURL); 
                }
            };
            
            xHTTP.open('POST', xURL);
            xHTTP.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
            xHTTP.setRequestHeader('Authorization', 'Basic dXNlcl9zZmhvbG94Om5zM3JfNWZoMCEweA==');
            xHTTP.send(xPARS);
        }

        if (localStorage.getItem('tipoSolicitudJSON') === 'null' || localStorage.getItem('tipoSolicitudJSON') === null ){
            localStorage.removeItem('tipoSolicitudJSON');
            localStorage.setItem('tipoSolicitudJSON', JSON.stringify(<?php echo json_encode(get_curl('100/solicitud')); ?>));
        }
    </script>

    <script src="../js/solicitud.js?<?php echo date('Ymd');?>"></script>
</body>
</html>