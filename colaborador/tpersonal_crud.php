<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';
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
                                        <li class="breadcrumb-item active" aria-current="page">Tarjeta Personal</li>
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
                                <div class="card-body">
                                    <div class="row">
                                        <h4 class="col-10 card-title"> Tarjeta Personal </h4>
                                        <h4 class="col-2 card-title" style="text-align: right;">
                                            <a onclick="setTPersonal(0, 1);" class="btn text-center text-white" style="background-color:#163562; border-color:#163562;" href="javascript:void(0)" role="button" data-toggle="modal" data-target="#modaldiv" title="Nuevo"><i class="ti-plus"></i></a>
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
            const _parm04BASE   = 'colaborador/tpersonal_crud.php';
            const _parm05BASE   = '<?php echo trim($usu_05); ?>';
        </script>

        <script src="../js/api.js?<?php echo date('Ymd');?>"></script>
        <script src="../js/tpersonal.js?<?php echo date('Ymd');?>"></script>
        <script src="../js/tpersonal_crud.js?<?php echo date('Ymd');?>"></script>
    </body>
</html>