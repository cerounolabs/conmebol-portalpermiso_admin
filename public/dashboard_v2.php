<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($usu_09 != 7){
        header('Location: ../public/home.php?code=401&msg=No tiene permiso para ingresar!Contacte con TI');
    }

    $var02 = date('Y');
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
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard v2</li>
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
                                                    <label for="var01">Comprobante</label>
                                                    <select id="var01" name="var01" class="select2 form-control custom-select" onchange="verDashboard();" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var02">Periodo</label>
                                                    <input id="var02" name="var02" value="<?php echo $var02; ?>"  class="form-control" onchange="verDashboard();" type="number" min="2020" max="<?php echo $var02; ?>" style="width:100%; height:40px;" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var03">Mes Desde</label>
                                                    <select id="var03" name="var03" class="select2 form-control custom-select" onchange="verDashboard();" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var04">Mes Hasta</label>
                                                    <select id="var04" name="var04" class="select2 form-control custom-select" onchange="verDashboard();" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var05">Gerencia</label>
                                                    <select id="var05" name="var05" class="select2 form-control custom-select" onchange="selectDepto('var05', 'var06'); selectColaborador('var05', 'var06', 'var07'); verDashboard();" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="var06">Departamento</label>
                                                    <select id="var06" name="var06" class="select2 form-control custom-select" onchange="selectColaborador('var05', 'var06', 'var07'); verDashboard();" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="var07">Colaborador</label>
                                                    <select id="var07" name="var07" class="select2 form-control custom-select" onchange="verDashboard();" style="width:100%; height:40px;" required></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">

                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">

                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">

                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">

                    </div>
                    <!-- Column -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="col-10 card-title"> Detalle </h4>
                                    <h4 class="col-2 card-title" style="text-align: right;">
                                	</h4>
								</div>
                                <div class="table-responsive">
                                    <table id="tableLoad" class="table v-middle" style="width: 100%;">
                                        <thead id="tableCodigo" class="">
                                            <tr class="bg-conmebol" style="text-align:center;">
                                                <th class="border-top-0">C&Oacute;DIGO</th>
                                                <th class="border-top-0">VER</th>
                                                <th class="border-top-0">TIPO</th>
                                                <th class="border-top-0">PERIODO</th>
                                                <th class="border-top-0">MES</th>
                                                <th class="border-top-0">COLABORADOR</th>
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
    <script src="../js/dashboard_v2.js"></script>

    <script>
        selectDominio('var01', 'COMPROBANTETIPO', 0);
        selectMes('var03', 'var04');
        selectGerencia('var05');
        selectDepto('var05', 'var06');
        selectColaborador('var05', 'var06', 'var07');
    </script>
</body>
</html>