<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($usu_09 != 7){
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
                        <h4 class="page-title">DASHBOARD</h4>
                        <div class="d-flex align-items-center"></div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../public/home.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard v1</li>
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
                            <div class="card-body" style="background-color:#005ea6; color:#ffffff;">
                                <form action="#">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var01">Solicitud</label>
                                                    <select id="var01" name="var01" class="select2 form-control custom-select" onchange="verDashboard(); viewVacaciones('rowVac', 'var01', 'var02', 'var05', 'var06', 'var07');" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var02">Fecha Desde</label>
                                                    <input id="var02" name="var02" value="2020-01-01"  class="form-control" onchange="verDashboard();  viewVacaciones('rowVac', 'var01', 'var02', 'var05', 'var06', 'var07');" type="date" style="width:100%; height:40px;" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var03">Fecha Hasta</label>
                                                    <input id="var03" name="var03" value="2020-12-31" class="form-control" onchange="verDashboard();" type="date" style="width:100%; height:40px;" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var04">Estado</label>
                                                    <select id="var04" name="var04" class="select2 form-control custom-select" onchange="verDashboard();" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var05">Gerencia</label>
                                                    <select id="var05" name="var05" class="select2 form-control custom-select" onchange="selectDepartamento('var05', 'var06'); selectColaborador('var05', 'var06', 'var07'); verDashboard();   viewVacaciones('rowVac', 'var01', 'var02', 'var05', 'var06', 'var07');" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var06">Departamento</label>
                                                    <select id="var06" name="var06" class="select2 form-control custom-select" onchange="selectColaborador('var05', 'var06', 'var07'); verDashboard();   viewVacaciones('rowVac', 'var01', 'var02', 'var05', 'var06', 'var07');" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="var07">Colaborador</label>
                                                    <select id="var07" name="var07" class="select2 form-control custom-select" onchange="verDashboard();  viewVacaciones('rowVac', 'var01', 'var02', 'var05', 'var06', 'var07');" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h4 class="col-12 card-title" style="text-align: right;">
                                                <a class="btn btn-info" style="background-color:#163562; border-color:#163562;"  href="javascript:void(0)" onclick="loadExport()" role="button" title="Export XLS"><i class="ti-cloud-down"></i> Exportar</a>
                                            </h4>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <h4 class="col-10 card-title"> Detalle </h4>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titING01"></h1>
                                        <h6 class="text-muted">Ingresados</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valING01" class="css-bar m-b-0 css-bar-info"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titAUT01"></h1>
                                        <h6 class="text-muted">Autorizados</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valAUT01" class="css-bar m-b-0 css-bar-success"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titAPR01"></h1>
                                        <h6 class="text-muted">Aprobados</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valAPR01" class="css-bar m-b-0 css-bar-warning"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titANU01"></h1>
                                        <h6 class="text-muted">Anulados</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valANU01" class="css-bar m-b-0 css-bar-danger"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="rowVac">
                    <div class="col-lg-3 col-md-6">
                        <div class="card card bg-light-info">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titPER02"></h1>
                                        <h6 class="text-muted">Periodo</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valPER02" class="css-bar m-b-0 css-bar-info"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-light-success">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titCOR02"></h1>
                                        <h6 class="text-muted">Correspondiente</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valCOR02" class="css-bar m-b-0 css-bar-success"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-light-danger">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titUSU02"></h1>
                                        <h6 class="text-muted">Utilizadas</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valUSU02" class="css-bar m-b-0 css-bar-danger"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card bg-light-warning">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <div class="col p-r-0">
                                        <h1 class="font-light" id="titDIS02"></h1>
                                        <h6 class="text-muted">Disponibles</h6>
                                    </div>

                                    <div class="col text-right align-self-center">
                                        <div id="valDIS02" class="css-bar m-b-0 css-bar-warning"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body analytics-info">
                                <h4 class="card-title"> Por Gerencia </h4>
                                <div id="char01" style="height:450px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body analytics-info">
                                <h4 class="card-title"> Por Departamento </h4>
                                <div id="char02" style="height:450px;"></div>
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
    <script src="../js/select.js?<?php echo date('Ymd');?>"></script>
    <script src="../js/dashboard_v1.js?<?php echo date('Ymd');?>"></script>
    
    <script>
        function loadExport(){
            var parm01 = document.getElementById('var01').value;  
            var parm02 = document.getElementById('var02').value;  
            var parm03 = document.getElementById('var03').value;  
            var parm04 = document.getElementById('var04').value;  
            var parm05 = document.getElementById('var05').value;  
            var parm06 = document.getElementById('var06').value;  
            var parm07 = document.getElementById('var07').value;  
             
            window.location.replace('../export/export_dashboard_v1.php?cod01='+ parm01 +'&cod02='+ parm02 +'&cod03='+ parm03 +'&cod04='+ parm04 +'&cod05='+ parm05 +'&cod06='+ parm06 +'&cod07='+ parm07); 
        }
        
        selectSolicitud('var01');
        selectEstado('var04');
        selectGerencia('var05');
        selectDepartamento('var05', 'var06');
        selectColaborador('var05', 'var06', 'var07');
        verDashboard();
        viewVacaciones('rowVac', 'var01', 'var02', 'var05', 'var06', 'var07');
    </script>
</body>
</html>