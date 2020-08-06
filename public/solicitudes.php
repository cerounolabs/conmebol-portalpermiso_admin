<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($_GET['tipo'] == 3 && $usu_13 != 21 && $usu_13 != 87 && $usu_13 != 109){
        header('Location: ../public/home.php?code=401&msg=No tiene permiso para ingresar!Contacte con TI');
    }

    if(isset($_GET['tipo'])){
        $work01         = $_GET['tipo'];
    } else {
        $work01         = 1;
    }

    if(isset($_GET['sol'])){
        $work02         = $_GET['sol'];
        $workPage       = 'solicitudes.php?tipo='.$work01.'&sol='.$work02;
    } else {
        if ($work01 == 5) {
            $work02         = 'I';
        } else {
            $work02         = 'T';
        }
        
        $workPage       = 'solicitudes.php?tipo='.$work01;
    }

    switch ($work02) {
        case 'I':
            $col07 = 'true';
            $col08 = 'false';
            $col09 = 'false';
            $titSol= 'Solicitudes Ingresadas';
            break;

        case 'A':
            $col07 = 'false';
            $col08 = 'true';
            $col09 = 'false';
            $titSol= 'Solicitudes Autorizadas';
            break;
        
        case 'P':
            $col07 = 'true';
            $col08 = 'true';
            $col09 = 'true';
            $titSol= 'Solicitudes Aprobadas';
            break;

        case 'C':
            $col07 = 'true';
            $col08 = 'true';
            $col09 = 'true';
            $titSol= 'Solicitudes Rechazadas';
            break;

        case 'T':
            $col07 = 'true';
            $col08 = 'true';
            $col09 = 'true';
            $titSol= 'Todas las Solicitudes';
            break;

        case 'PC':
            $col07 = 'true';
            $col08 = 'true';
            $col09 = 'true';
            $titSol= 'Solicitudes Aprobadas / Rechazadas por TH';
            break;
    }

    switch ($work01) {
        case 1:
            $titSol= 'Mis Solicitudes';
            break;
        
        case 2:
            $titSol= 'Solicitudes de mis Colaboradores';
            break;

        case 5:
            $titSol= 'Solicitudes Recibidas';
            break;
    }
    
    $solictudesJSON = get_curl('200/solicitudes/'.$work01.'/'.$usu_05.'/'.$work02);
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
                                    <h4 class="col-10 card-title"><?php echo $titSol; ?></h4>
                                    <h4 class="col-2 card-title" style="text-align: right;">
                                        <a class="btn btn-info" style="background-color:#163562; border-color:#163562;"  href="../export/export_solicitudes.php?parm01=<?php echo $work01; ?>&parm02=<?php echo $usu_05; ?>&parm03=<?php echo $work02; ?>" role="button" title="Export XLS"><i class="ti-cloud-down"></i></a>
                                        <a class="btn btn-info" style="background-color:#163562; border-color:#163562;"  href="javascript:void(0)" role="button" data-toggle="modal" data-target="#modaldiv" title="Nueva Solicitud" onclick="setSolicitud('<?php echo $workPage; ?>');"><i class="ti-plus"></i></a>
                                	</h4>
								</div>
                                <div class="table-responsive">
                                    <table id="tableLoad" class="table v-middle" style="width: 100%;">
                                        <thead id="tableCodigo" class="<?php echo $usu_05; ?>">
                                            <tr class="bg-conmebol" style="text-align:center;">
                                                <th class="border-top-0" colspan="11">SOLICITUD</th>
                                            </tr>
                                            <tr class="bg-conmebol" style="text-align:center;">
                                                <th class="border-top-0">C&Oacute;DIGO</th>
                                                <th class="border-top-0">ESTADO</th>
                                                <th class="border-top-0">FECHA</th>
                                                <th class="border-top-0">ADJUNTO</th>
                                                <th class="border-top-0">DOCUMENTO</th>
                                                <th class="border-top-0">COLABORADOR</th>
                                                <th class="border-top-0">TIPO</th>
                                                <th class="border-top-0">SOLICITANTE / ANULADO POR</th>
                                                <th class="border-top-0">AUTORIZADO / ANULADO POR</th>
                                                <th class="border-top-0">APROBADO / ANULADO POR</th>
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
?>

    <script src="../js/api.js"></script>

    <script>
        const docFunc = '<?php echo trim($usu_05); ?>';

        localStorage.removeItem('solicitudesJSON');

        if (localStorage.getItem('solicitudJSON') === 'null' || localStorage.getItem('solicitudJSON') === null ){
            localStorage.removeItem('solicitudJSON');
            localStorage.setItem('solicitudJSON', JSON.stringify(<?php echo json_encode(get_curl('100/solicitud')); ?>));
        }

        if (localStorage.getItem('solicitudesJSON') === 'null' || localStorage.getItem('solicitudesJSON') === null ){
            localStorage.removeItem('solicitudesJSON');
            localStorage.setItem('solicitudesJSON', JSON.stringify(<?php echo json_encode($solictudesJSON); ?>));
        }

        $(document).ready(function() {
            var xJSON	= getSolicitudAll(<?php echo $work01; ?>);

            $('#tableLoad').DataTable({
                processing	: true,
                destroy		: true,
                searching	: true,
                paging		: true,
                lengthChange: true,
                info		: true,
                order: [[ 0, "desc" ]],
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
                data		: xJSON,
                columnDefs	: [
                    { targets			: [0],	visible : false,searchable : false,	orderData : [0, 0] },
                    { targets			: [1],	visible : true,	searchable : true,	orderData : [1, 0] },
                    { targets			: [2],	visible : true,	searchable : true,	orderData : [2, 0] },
                    { targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] },
                    { targets			: [4],	visible : false,searchable : false,	orderData : [4, 0] },
                    { targets			: [5],	visible : true,	searchable : true,	orderData : [5, 0] },
                    { targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] },
                    { targets			: [7],	visible : <?php echo $col07; ?>,	searchable : <?php echo $col07; ?>,	orderData : [7, 0] },
                    { targets			: [8],	visible : <?php echo $col08; ?>,	searchable : <?php echo $col08; ?>,	orderData : [8, 0] },
                    { targets			: [9],	visible : <?php echo $col09; ?>,	searchable : <?php echo $col09; ?>,	orderData : [9, 0] },
                    { targets			: [10],	visible : true,	searchable : true,	orderData : [10, 0] }
                ],
                columns		: [
                    { data				: 'solicitud_codigo', name : 'solicitud_codigo'},
                    { data				: 'solicitud_estado_nombre', name : 'solicitud_estado_nombre'},
                    { data				: 'solicitud_fecha_desde_2', name : 'solicitud_fecha_desde_2'},
                    { render			: function (data, type, full, meta) {
                        var btn = '';

                        if (full.solicitud_adjunto) {
                            btn = '<a href="../uploads/solicitud/'+full.solicitud_adjunto+'" target="_blank" role="button" class="btn btn-primary"><i class="ti-import"></i></a>';
                        }
                            
                        return btn;
                    }},
                    { data				: 'solicitud_documento', name : 'solicitud_documento'},
                    { data				: 'solicitud_persona', name : 'solicitud_persona'},
                    { data				: 'tipo_permiso_nombre', name : 'tipo_permiso_nombre'},
                    { data				: 'solicitud_usuario_colaborador', name : 'solicitud_usuario_colaborador'},
                    { data				: 'solicitud_usuario_superior', name : 'solicitud_usuario_superior'},
                    { data				: 'solicitud_usuario_talento', name : 'solicitud_usuario_talento'},
<?php
    if ($work01 == 1) {
?>
                    { render			: function (data, type, full, meta) {
                        var retPage = "'<?php echo $workPage; ?>&'";
                        return '<button type="button" class="btn btn-primary btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Visualizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Rechazar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>, '+ retPage +');"><i class="fa fa-times"></i></button>';
                    }},
<?php
    } elseif ($work01 == 2 || $work01 == 5) {
?>
                    { render			: function (data, type, full, meta) {
                        var retPage = "'<?php echo $workPage; ?>&'";
                        var btn     = '<button type="button" class="btn btn-primary btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Visualizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i></button>';

                        if (full.solicitud_estado_codigo == 'I') {
                            btn = btn + '&nbsp;<button type="button" class="btn btn-success btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 2, 1, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>, '+ retPage +');"><i class="fa fa-check"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Rechazar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>, '+ retPage +');"><i class="fa fa-times"></i></button>';
                        }
                            
                        return btn;
                    }},
<?php
    } elseif ($work01 == 3) {
?>
                    { render			: function (data, type, full, meta) {
                        var retPage = "'<?php echo $workPage; ?>&'";
                        var btn     = '<button type="button" class="btn btn-primary btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Visualizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="getSolicitud(this.id);"><i class="fa fa-eye"></i></button>';

                        if (full.solicitud_estado_codigo == 'I') {
                            btn = btn + '&nbsp;<button type="button" class="btn btn-secondary btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Modificar Autorizante" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 6, 2, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>,'+ retPage +');"><i class="ti-ruler-pencil"></i></button>&nbsp;';
                        } else if (full.solicitud_estado_codigo == 'A') {
                            btn = btn + '&nbsp;<button type="button" class="btn btn-info btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Re-Ingresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 2, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>, '+ retPage +');"><i class="ti-reload"></i></button>&nbsp;<button type="button" class="btn btn-warning btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Aprobar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 3, 2, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>, '+ retPage +');"><i class="fa fa-check"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Rechazar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 2, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>, '+ retPage +');"><i class="fa fa-times"></i></button>';
                        } else if (full.solicitud_estado_codigo == 'C') {
                            btn = btn + '&nbsp;<button type="button" class="btn btn-info btn-circle" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Re-Ingresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 2, <?php echo trim($usu_05); ?>, <?php echo trim($usu_13); ?>, '+ retPage +');"><i class="ti-reload"></i></button>';
                        }
                            
                        return btn;
                    }},
<?php
    }
?>
                ]
            });
        });
    </script>
</body>
</html>