<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($_GET['tipo'] != 69 && $usu_13 != 70 && $usu_13 != 71){
        header('Location: ../public/home.php?code=401&msg=No tiene permiso para ingresar!Contacte con TI');
    }

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
        $msgRest        = '';
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
                                            <tr class="bg-light">
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

    <script src="../js/solicitud.js"></script>

    <script>
        function setSolicitud(codigo){
            var xHTTP	= new XMLHttpRequest();
            var xURL	= 'http://api.conmebol.com/portalpermiso/public/v1/100/' + codigo;
            
            xHTTP.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var xJSON   = JSON.parse(this.responseText);
                    var estado  = '';

                    if (xJSON['data'][0]['tipo_estado_codigo'] == 'A'){
                        estado  =                     
                        '                               <option value="A" selected>ACTIVO</option>'+
                        '                               <option value="I">INACTIVO</option>';
                    } else {
                        estado  =                     
                        '                               <option value="A">ACTIVO</option>'+
                        '                               <option value="I" selected>INACTIVO</option>';
                    }

                    if (xJSON['data'][0]['tipo_dia_corrido'] == 'S'){
                        diaCorrido  =                     
                        '                               <option value="S" selected>SI</option>'+
                        '                               <option value="N">NO</option>';
                    } else {
                        diaCorrido  =                     
                        '                               <option value="S">SI</option>'+
                        '                               <option value="N" selected>NO</option>';
                    }

                    if (xJSON['data'][0]['tipo_dia_unidad'] == 'D'){
                        tipoUnidad  =                     
                        '                               <option value="D" selected>DÍA</option>'+
                        '                               <option value="H">HORA</option>';
                    } else {
                        tipoUnidad   =                     
                        '                               <option value="D">DÍA</option>'+
                        '                               <option value="H" selected>HORA</option>';
                    }

                    if (xJSON['data'][0]['tipo_archivo_adjunto'] == 'S'){
                        tipoAdjunto =                     
                        '                               <option value="S" selected>SI</option>'+
                        '                               <option value="N">NO</option>';
                    } else {
                        tipoAdjunto =                     
                        '                               <option value="S">SI</option>'+
                        '                               <option value="N" selected>NO</option>';
                    }

                    var html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitud.php">'+
                    '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                    '		    <h4 class="modal-title" id="vcenter"> Solicitud </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <input id="workCodigo" name="workCodigo" value="'+xJSON['data'][0]['tipo_permiso_codigo']+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workModo" name="workModo" value="U" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
                    '           </div>'+
                    '           <div class="row pt-3">'+
                    '               <div class="col-sm-12 col-md-3">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var01">ESTADO</label>'+
                    '                       <select id="var01" name="var01" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
                    '                           <optgroup label="Estado">'+estado+
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-sm-12 col-md-3">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var02">ORDEN</label>'+
                    '                       <input id="var02" name="var02" class="form-control" value="'+xJSON['data'][0]['tipo_orden_numero']+'" type="number" style="text-transform:uppercase; height:40px;" placeholder="ORDEN">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-sm-12 col-md-3">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var03">DÍA LIMITE</label>'+
                    '                       <input id="var03" name="var03" class="form-control" value="'+xJSON['data'][0]['tipo_orden_numero']+'" type="number" style="text-transform:uppercase; height:40px;" placeholder="ORDEN">'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-sm-12 col-md-3">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var04">DÍA CORRIDO</label>'+
                    '                       <select id="var04" name="var04" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
                    '                           <optgroup label="Corrido">'+diaCorrido+
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-sm-12 col-md-3">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var05">DÍA UNIDAD</label>'+
                    '                       <select id="var05" name="var05" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
                    '                           <optgroup label="Corrido">'+tipoUnidad+
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    '               <div class="col-sm-12 col-md-3">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var06">ARCHIVO ADJUNTO</label>'+
                    '                       <select id="var06" name="var06" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
                    '                           <optgroup label="Corrido">'+tipoAdjunto+
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    '           </div>'+
                    '           <div class="row pt-3">'+
                    '                <div class="col-sm-12">'+
                    '                    <div class="form-group">'+
                    '                        <label for="var07">OBSERVACI&Oacute;N</label>'+
                    '                        <textarea id="var07" name="var07" class="form-control" rows="3" style="text-transform:uppercase;">'+xJSON['data'][0]['tipo_observacion']+'</textarea>'+
                    '                    </div>'+
                    '                </div>'+
                    '           </div>'+
                    '	    </div>'+
                    '	    <div class="modal-footer">'+
                    '           <button type="submit" class="btn btn-info">Guardar</button>'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                    $("#modalcontent").empty();
                    $("#modalcontent").append(html);
                } 
            };
            
            xHTTP.open('GET', xURL);
            xHTTP.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
            xHTTP.send();
        }

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
            var xURL	= 'http://api.conmebol.com/portalpermiso/public/v1/100/procesar';
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
            xHTTP.send(xPARS);
        }
    </script>
</body>
</html>