<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($_GET['tipo'] == 3 && $usu_13 != 21 && $usu_13 != 87 && $usu_13 != 109){
        header('Location: ../public/home.php?code=401&msg=No tiene permiso para ingresar!Contacte con TI');
    }

    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
        $msgRest        = '';
    }

    if(isset($_GET['tipo'])){
        $work01         = $_GET['tipo'];
    } else {
        $work01         = 1;
    }

    $workPage       = 'solicitudes.php?tipo='. $work01.'&';
    $solictudJSON   = get_curl('100');
    $solictudesJSON = get_curl('200/solicitud/'.$work01.'/'.$usu_05);
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
                                        <a class="btn btn-info" style="background-color:#163562; border-color:#163562;"  href="javascript:void(0)" role="button" data-toggle="modal" data-target="#modaldiv" title="Nueva Solicitud" onclick="setSolicitud();"><i class="ti-plus"></i></a>
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
                                                <th class="border-top-0">FECHA</th>
                                                <th class="border-top-0">CANT. DÍAS</th>
                                                <th class="border-top-0">CANT. HORAS</th>
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
    include '../public/genSolicitud.php';
   
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
                    { targets			: [8],	visible : true,	searchable : true,	orderData : [8, 0] },
                    { targets			: [9],	visible : true,	searchable : true,	orderData : [9, 0] }
                ],
                columns		: [
                    { data				: 'solicitud_estado_nombre', name : 'solicitud_estado_nombre'},
                    { data				: 'solicitud_documento', name : 'solicitud_documento'},
                    { data				: 'solicitud_persona', name : 'solicitud_persona'},
                    { data				: 'tipo_permiso_nombre', name : 'tipo_permiso_nombre'},
                    { data				: 'solicitud_fecha_desde', name : 'solicitud_fecha_desde'},
                    { data				: 'solicitud_fecha_cantidad', name : 'solicitud_fecha_cantidad'},
                    { data				: 'solicitud_hora_cantidad', name : 'solicitud_hora_cantidad'},
                    { data				: 'solicitud_usuario_aprobador', name : 'solicitud_usuario_aprobador'},
                    { data				: 'solicitud_usuario_talento', name : 'solicitud_usuario_talento'},
<?php
    if ($work01 == 1) {
?>
                    { render			: function (data, type, full, meta) {return '<button type="button" class="btn btn-danger btn-circle-2" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Anular Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1);"><i class="fa fa-times"></i></button>';}},
<?php
    } elseif ($work01 == 2) {
?>
                    { render			: function (data, type, full, meta) {return '<button type="button" class="btn btn-success btn-circle-2" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Autorizar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 2, 1);"><i class="fa fa-check"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-circle-2" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Anular Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1);"><i class="fa fa-times"></i></button>';}},
<?php
    } elseif ($work01 == 3) {
?>
                    { render			: function (data, type, full, meta) {return '<button type="button" class="btn btn-info btn-circle-2" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Re-Ingresar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 1, 1);"><i class="fa fa-check"></i></button>&nbsp;<button type="button" class="btn btn-warning btn-circle-2" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Aprobar Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 3, 1);"><i class="fa fa-check"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-circle-2" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" title="Anular Solicitud" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id, 4, 1);"><i class="fa fa-times"></i></button>';}},
<?php
    }
?>
                ]
            });
        });
    </script>
</body>
</html>