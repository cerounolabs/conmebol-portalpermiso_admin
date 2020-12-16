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

                                        <li class="breadcrumb-item active" aria-current="page">Dashboard v3</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" style="background-color:#005ea6; color:#ffffff;">
                                    <form action="#">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="var01">Estado</label>
                                                        <select id="var01" name="var01" class="select2 form-control custom-select"  style="width:100%; height:40px;" required></select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="var02">Gerencia</label>
                                                        <select id="var02" name="var02" class="select2 form-control custom-select" onchange="selectDepartamento('var02', 'var03'); selectColaborador('var02', 'var03', 'var04');" style="width:100%; height:40px;" required></select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="var03">Departamento</label>
                                                        <select id="var03" name="var03" class="select2 form-control custom-select" onchange="selectColaborador('var02', 'var03', 'var04');" style="width:100%; height:40px;" required></select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="var04">Colaborador</label>
                                                        <select id="var04" name="var04" class="select2 form-control custom-select"  style="width:100%; height:40px;" required></select>
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 class="col-10 card-title"> Detalle </h4>

                                        <h4 class="col-2 card-title" style="text-align: right;">
                                            <a onclick="loadExport()" class="btn text-center text-white" style="background-color:#163562; border-color:#163562;"  href="javascript:void(0)" role="button" title="Export XLS"><i class="ti-cloud-down"></i> Exportar</a>
                                        </h4>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tableLoad" class="table v-middle" style="width: 100%;">
                                            <thead id="tableCodigo" class="">
                                                <tr class="bg-conmebol" style="text-align:center;">                                         
                                                    <th class="border-top-0">C&Oacute;DIGO</th>
                                                    <th class="border-top-0">&nbsp;</th>
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
<?php
    include '../include/development.php';
?>
            </div>
        </div>
        
        <div class="chat-windows"></div>

<?php
    include '../include/footer.php';
?>

        <script>
            const _parm01BASE   = '<?php echo trim($usu_03); ?>';
            const _parm02BASE   = '<?php echo date('Y-m-d H:i:s'); ?>';
            const _parm03BASE   = '<?php echo trim($log_03); ?>';
            const _parm04BASE   = 'public/dashboard_v3';
            const _parm05BASE	= '<?php echo trim($usu_05); ?>';
        </script>

        <script src="../js/api.js?<?php echo date('Ymd');?>"></script>
        <script src="../js/select.js?<?php echo date('Ymd');?>"></script>
        <script src="../js/tpersonal.js?<?php echo date('Ymd');?>"></script>
        <script src="../js/dashboard_v3.js?<?php echo date('Ymd');?>"></script>

        <script>
            function loadExport(){  
                var codEst  = document.getElementById('var01').value;
                var codGer  = document.getElementById('var02').value;
                var codDep  = document.getElementById('var03').value;
                var codCol  = document.getElementById('var04').value;

                window.location.replace('../export/export_dashboard_v3.php?&cod01='+ codEst +'&cod02='+ codGer +'&cod03='+ codDep +'&cod04='+ codCol); 
            }

            selectDominio('var01', 'TARJETAPERSONALESTADO', false);
            selectGerencia('var02');
            selectDepartamento('var02', 'var03');
            selectColaborador('var02', 'var03', 'var04');
        </script>
    </body>
</html>