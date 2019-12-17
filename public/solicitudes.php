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

    $solictudJSON   = get_curl('100');
    $solictudesJSON = get_curl('200/solicitud/'.$usu_05);
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
                                        <a class="btn btn-info" style="background-color:#163562; border-color:#163562;"  href="javascript:void(0)" role="button" title="Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setSolicitud();"><i class="ti-plus"></i></a>
                                	</h4>
								</div>
                                <div class="table-responsive">
                                    <table id="tableLoad" class="table v-middle" style="width: 100%;">
                                        <thead id="tableCodigo" class="<?php echo $usu_05; ?>">
                                            <tr class="bg-light">
                                                <th class="border-top-0">ESTADO</th>
                                                <th class="border-top-0">DOCUMENTO</th>
                                                <th class="border-top-0">COLABORADOR</th>
                                                <th class="border-top-0">SOLICITUD</th>
                                                <th class="border-top-0">CANTIDAD DE DÍAS</th>
                                                <th class="border-top-0">CANTIDAD DE HORAS</th>
                                                <th class="border-top-0">AUTORIZADO / ANULADO POR</th>
                                                <th class="border-top-0">APROBADOR / ANULADO POR</th>
                                                <th class="border-top-0"></th>
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
    <script>
        $(document).ready(function() {
            $('#tableLoad').DataTable({
                processing	: true,
                destroy		: true,
                searching	: true,
                paging		: true,
                lengthChange: true,
                info		: true,
                orderCellsTop: false,
                fixedHeader	: false,
                language	: {
                    lengthMenu: "Mostrar _MENU_ registros por pagina",
                    zeroRecords: "Nothing found - sorry",
                    info: "Mostrando pagina _PAGE_ de _PAGES_",
                    infoEmpty: "No hay registros disponibles.",
                    infoFiltered: "(Filtrado de _MAX_ registros totales)",
                    sZeroRecords: "No se encontraron resultados",
                    sSearch: "buscar",
                    oPaginate: {
                        sFirst:    "Primero",
                        sLast:     "Último",
                        sNext:     "Siguiente",
                        sPrevious: "Anterior"
                    },
                },
                data		: <?php echo json_encode($solictudesJSON['data']); ?>,
                columnDefs	: [
                    { targets			: [0],	visible : true,	searchable : true,	orderData : [0, 0] },
                    { targets			: [1],	visible : true,	searchable : true,	orderData : [1, 0] },
                    { targets			: [2],	visible : true,	searchable : true,	orderData : [2, 0] },
                    { targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] },
                    { targets			: [4],	visible : true,	searchable : true,	orderData : [4, 0] },
                    { targets			: [5],	visible : true,	searchable : true,	orderData : [5, 0] },
                    { targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] },
                    { targets			: [7],	visible : true,	searchable : true,	orderData : [7, 0] },
                    { targets			: [8],	visible : true,	searchable : true,	orderData : [8, 0] }
                ],
                columns		: [
                    { data				: 'solicitud_estado_nombre', name : 'solicitud_estado_nombre'},
                    { data				: 'solicitud_documento', name : 'solicitud_documento'},
                    { data				: 'solicitud_persona', name : 'solicitud_persona'},
                    { data				: 'tipo_permiso_nombre', name : 'tipo_permiso_nombre'},
                    { data				: 'solicitud_fecha_cantidad', name : 'solicitud_fecha_cantidad'},
                    { data				: 'solicitud_hora_cantidad', name : 'solicitud_hora_cantidad'},
                    { data				: 'solicitud_usuario_aprobador', name : 'solicitud_usuario_aprobador'},
                    { data				: 'solicitud_usuario_talento', name : 'solicitud_usuario_talento'},
                    { render			: function (data, type, full, meta) {return '<a href="javascript:void(0)" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" role="button" class="btn btn-success" title="Autorizar/Anular" data-toggle="modal" data-target="#modaldiv" onclick="setEstado1(this.id);"><i class="ti-settings"></i>&nbsp;</a>&nbsp;<a href="javascript:void(0)" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" role="button" class="btn btn-warning" title="Aprobar/Anular" data-toggle="modal" data-target="#modaldiv" onclick="setEstado2(this.id);"><i class="ti-medall-alt"></i>&nbsp;</a>&nbsp;';}},
                ]
            });
        });

        function cantFecha(){
            var fecDesde    = document.getElementById('var02');
            var fecHasta    = document.getElementById('var03');
            var fecCant     = document.getElementById('var04');

            var fec1        = new Date(fecDesde.value);
            var fec2        = new Date(fecHasta.value);

            if (fec1 <= fec2) {
                var diff        = (fec2.getTime() - fec1.getTime()) / (1000 * 3600 * 24);
                fecCant.value   = diff + 1;
            } else {
                alert('La FECHA HASTA no puede ser menor que ' + fecDesde.value);
                fecHasta.value = fecDesde.value;
            } 
        }

        function cantHora(){
            var fecDesde    = document.getElementById('var02');
            var fecHasta    = document.getElementById('var03');
            var horDesde    = document.getElementById('var05');
            var horHasta    = document.getElementById('var06');
            var horCant     = document.getElementById('var07');

            var fec1        = new Date(fecDesde.value + ' ' + horDesde.value);
            var fec2        = new Date(fecHasta.value + ' ' + horHasta.value);

            if (fec1 <= fec2) {
                var diff        = (fec2.getTime() - fec1.getTime()) / 1000;
                horCant.value   = diff / 3600;
            }
        }

        function valSolicitud(){
            var xDATA   = '<?php echo json_encode($solictudJSON['data']); ?>';
            var xJSON   = JSON.parse(xDATA);
            var inpSol  = document.getElementById('var01');
            var inpFDe  = document.getElementById('var02');
            var titFDe  = document.getElementById('tit02');
            var inpFHa  = document.getElementById('var03');
            var titFHa  = document.getElementById('tit03');
            var inpFCa  = document.getElementById('var04');
            var titFCa  = document.getElementById('tit04');
            var inpHDe  = document.getElementById('var05');
            var titHDe  = document.getElementById('tit05');
            var inpHHa  = document.getElementById('var06');
            var titHHa  = document.getElementById('tit06');
            var inpHCa  = document.getElementById('var07');
            var titHCa  = document.getElementById('tit07');
            var inpAdj  = document.getElementById('var08');
            var titAdj  = document.getElementById('tit08');

            xJSON.forEach(element => {
                if (inpSol.value == element.tipo_permiso_codigo){
                    if (element.tipo_dia_unidad == 'D') {
                        inpFDe.readOnly     = false;
                        inpFHa.readOnly     = false;
                        inpFCa.readOnly     = true;

                        titFDe.style.display= '';
                        titFHa.style.display= '';
                        titFCa.style.display= '';

                        inpHDe.readOnly     = true;
                        inpHHa.readOnly     = true;
                        inpHCa.readOnly     = true;

                        titHDe.style.display= 'none';
                        titHHa.style.display= 'none';
                        titHCa.style.display= 'none';
                    } else {
                        inpFHa.value        = inpFDe.value;

                        inpFDe.readOnly     = false;
                        inpFHa.readOnly     = true;
                        inpFCa.readOnly     = true;

                        titFDe.style.display= '';
                        titFHa.style.display= 'none';
                        titFCa.style.display= 'none';

                        inpHDe.readOnly     = false;
                        inpHHa.readOnly     = false;
                        inpHCa.readOnly     = true;

                        titHDe.style.display= '';
                        titHHa.style.display= '';
                        titHCa.style.display= '';
                    }

                    if (element.tipo_archivo_adjunto == 'S') {
                        inpAdj.readOnly     = true;
                        titAdj.style.display= '';
                    } else {
                        inpAdj.readOnly     = false;
                        titAdj.style.display= 'none';
                    }
                }
            });
        }

        function setSolicitud(){
            var html    =
            '<div class="modal-content">'+
            '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes.php">'+
            '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
            '		    <h4 class="modal-title" id="vcenter"> Solicitud </h4>'+
            '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
            '	    </div>'+
            '	    <div class="modal-body" >'+
            '           <div class="form-group">'+
            '               <input id="workCodigo" name="workCodigo" value="0" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
            '               <input id="workModo" name="workModo" value="C" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
            '           </div>'+
            '           <div class="row pt-3">'+
            '               <div class="col-sm-12">'+
            '                   <div class="form-group">'+
            '                       <label for="var01">SOLICITUD DE</label>'+
            '                       <select id="var01" name="var01" class="select2 form-control custom-select" style="width:100%; height:40px;" onblur="valSolicitud();">'+
            '                           <optgroup label="Solicitud">'+
<?php
    if ($solictudJSON['code'] === 200) {
        foreach ($solictudJSON['data'] as $solictudKEY => $solictudVALUE) {
            if ($solictudVALUE['tipo_estado_codigo'] === 'A' && $solictudVALUE['tipo_solicitud_codigo'] != 'I'){
?>
            '                               <option value="<?php echo $solictudVALUE['tipo_permiso_codigo']; ?>"><?php echo $solictudVALUE['tipo_solicitud_nombre'].' - '.$solictudVALUE['tipo_permiso_nombre']; ?></option>'+
<?php
            }
        }
    }
?>
            '                           </optgroup>'+
            '                       </select>'+
            '                   </div>'+
            '               </div>'+
            '           </div>'+
            '           <div class="row pt-3">'+
            '               <div id="tit02" class="col-sm-12 col-md-4">'+
            '                   <div class="form-group">'+
            '                       <label for="var02">FECHA DESDE</label>'+
            '                       <input id="var02" name="var02" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" onblur="cantFecha();" style="text-transform:uppercase; height:40px;" placeholder="FECHA DESDE">'+
            '                   </div>'+
            '               </div>'+
            '               <div id="tit03" class="col-sm-12 col-md-4">'+
            '                   <div class="form-group">'+
            '                       <label for="var03">FECHA HASTA</label>'+
            '                       <input id="var03" name="var03" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" onblur="cantFecha();" style="text-transform:uppercase; height:40px;" placeholder="FECHA HASTA">'+
            '                   </div>'+
            '               </div>'+
            '               <div id="tit04" class="col-sm-12 col-md-4">'+
            '                   <div class="form-group">'+
            '                       <label for="var04">CANTIDAD DE DIAS</label>'+
            '                       <input id="var04" name="var04" class="form-control" type="numer" value="1" style="text-transform:uppercase; height:40px;" placeholder="CANTIDAD DE DIAS" readonly>'+
            '                   </div>'+
            '               </div>'+
            '           </div>'+
            '           <div class="row pt-3">'+
            '               <div id="tit05" class="col-sm-12 col-md-4">'+
            '                   <div class="form-group">'+
            '                       <label for="var05">HORA DESDE</label>'+
            '                       <input id="var05" name="var05" class="form-control" type="time" value="08:00" onblur="cantHora();" style="text-transform:uppercase; height:40px;" placeholder="HORA DESDE">'+
            '                   </div>'+
            '               </div>'+
            '               <div id="tit06" class="col-sm-12 col-md-4">'+
            '                   <div class="form-group">'+
            '                       <label for="var06">HORA HASTA</label>'+
            '                       <input id="var06" name="var06" class="form-control" type="time" value="18:00" onblur="cantHora();" style="text-transform:uppercase; height:40px;" placeholder="HORA HASTA">'+
            '                   </div>'+
            '               </div>'+
            '               <div id="tit07" class="col-sm-12 col-md-4">'+
            '                   <div class="form-group">'+
            '                       <label for="var07">CANTIDAD DE HORAS</label>'+
            '                       <input id="var07" name="var07" class="form-control" type="numer" value="0" style="text-transform:uppercase; height:40px;" placeholder="CANTIDAD DE HORAS" readonly>'+
            '                   </div>'+
            '               </div>'+
            '           </div>'+
            '           <div class="row pt-3">'+
            '                <div id="tit08" class="col-sm-12">'+
            '                    <div class="form-group">'+
            '                       <label for="var08">ADJUNTAR</label>'+
            '                       <input id="var08" name="var08" class="form-control-file" type="file" style="text-transform:uppercase; height:40px;">'+
            '                    </div>'+
            '                </div>'+
            '           </div>'+
            '           <div class="row pt-3">'+
            '                <div class="col-sm-12">'+
            '                    <div class="form-group">'+
            '                        <label for="var09">COMENTARIO</label>'+
            '                        <textarea id="var09" name="var09" class="form-control" rows="3" style="text-transform:uppercase;"></textarea>'+
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

        function setEstado1(rowSel){
            var codRow  = document.getElementById(rowSel);
            var codFun  = '<?php echo trim($usu_05); ?>';
            var html    = '';

            if (codRow.getAttribute('value2') != codFun) {
                if (codRow.getAttribute('value') == 'I'){
                    html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                    '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                    '		    <h4 class="modal-title" id="vcenter"> Autorizar o Anular Solicitud </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workAccion" name="workAccion" value="J" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workPage" name="workPage" value="solicitudes" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '           </div>'+
                    '           <div class="row pt-3">'+
                    '               <div class="col-sm-12">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var01">AUTORIZAR / ANULAR</label>'+
                    '                       <select id="var01" name="var01" class="select2 form-control custom-select" style="width:100%; height:40px;" required>'+
                    '                           <optgroup label="Solicitud">'+
                    '                               <option value="A">AUTORIZAR</option>'+
                    '                               <option value="C">ANULAR</option>'+
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
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
                    '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                    '		    <h4 class="modal-title" id="vcenter"> Autorizar o Anular Solicitud </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <h4 style="text-align:center;">EL ESTADO DE LA SOLICITUD YA NO PERMITE MODIFICACIÓN. VERIFIQUE!</h4>'
                    '           </div>'+
                    '	    </div>'+
                    '	    <div class="modal-footer">'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                }
            } else {
                html    =
                '<div class="modal-content">'+
                '   <form id="form" data-parsley-validate method="post" action="#">'+
                '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                '		    <h4 class="modal-title" id="vcenter"> Autorizar o Anular Solicitud </h4>'+
                '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                '	    </div>'+
                '	    <div class="modal-body" >'+
                '           <div class="form-group">'+
                '               <h4 style="text-align:center;">FAVOR SOLICITAR A SU JEFATURA DICHA AUTORIZACION. VERIFIQUE!</h4>'
                '           </div>'+
                '	    </div>'+
                '	    <div class="modal-footer">'+
                '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
            }

            $("#modalcontent").empty();
            $("#modalcontent").append(html);
        }

        function setEstado2(rowSel){
            var codRow  = document.getElementById(rowSel);
            var codFun  = '<?php echo trim($usu_05); ?>';
            var html    = '';

            if (codRow.getAttribute('value2') != codFun) {
                if (codRow.getAttribute('value') == 'A'){
                    html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                    '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                    '		    <h4 class="modal-title" id="vcenter"> Aprobar o Anular Solicitud </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workAccion" name="workAccion" value="T" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workPage" name="workPage" value="solicitudes" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '           </div>'+
                    '           <div class="row pt-3">'+
                    '               <div class="col-sm-12">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var01">APROBAR / ANULAR</label>'+
                    '                       <select id="var01" name="var01" class="select2 form-control custom-select" style="width:100%; height:40px;" required>'+
                    '                           <optgroup label="Solicitud">'+
                    '                               <option value="P">APROBAR</option>'+
                    '                               <option value="C">ANULAR</option>'+
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
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
                    '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                    '		    <h4 class="modal-title" id="vcenter"> Autorizar o Anular Solicitud </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <h4 style="text-align:center;">EL ESTADO DE LA SOLICITUD YA NO PERMITE MODIFICACIÓN. VERIFIQUE!</h4>'
                    '           </div>'+
                    '	    </div>'+
                    '	    <div class="modal-footer">'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                }
            } else {
                html    =
                '<div class="modal-content">'+
                '   <form id="form" data-parsley-validate method="post" action="#">'+
                '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                '		    <h4 class="modal-title" id="vcenter"> Autorizar o Anular Solicitud </h4>'+
                '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                '	    </div>'+
                '	    <div class="modal-body" >'+
                '           <div class="form-group">'+
                '               <h4 style="text-align:center;">FAVOR SOLICITAR A TALENTO HUMANO DICHA APROBACION. VERIFIQUE!</h4>'
                '           </div>'+
                '	    </div>'+
                '	    <div class="modal-footer">'+
                '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
            }

            $("#modalcontent").empty();
            $("#modalcontent").append(html);
        }
    </script>
</body>
</html>