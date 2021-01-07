<?php
    require '../class/function/curl_api.php';
    require '../class/function/function.php';
    require '../class/session/session_system.php';

    if ($usu_09 != 7){
        header('Location: ../public/home.php?code=401&msg=No tiene permiso para ingresar!Contacte con TI');
    }

    $compJSON = get_curl('200/comprobante/codigobarra');
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
                            <h4 class="page-title">Comprobante Lector C&oacute;digo Barra</h4>
                            <div class="d-flex align-items-center"></div>
                        </div>

                        <div class="col-7 align-self-center">
                            <div class="d-flex no-block justify-content-end align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="../public/home.php">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Comprobante Lector</li>
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
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="var001">Buscar Comprobante</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon11" style="height:70px; font-size:2rem;"><i class="fa fas fa-barcode"></i></span>
                                                        </div>
                                                        <input id="var001" name="var001" class="form-control" onblur="searchComprobante(this.id);" onchange="searchComprobante(this.id);" type="text" style="height:70px; font-size:2rem;" aria-describedby="basic-addon11" required autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
<?php
    foreach ($compJSON['data'] as $compKEY => $compVALUE) {
?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="d-flex flex-row">
                                    <div class="p-10 bg-info">
                                        <h3 class="text-white box m-b-0"><i class="ti-file"></i></h3>
                                        <input id="<?php echo $compVALUE['comprobante_codigo_barra']; ?>" name="<?php echo $compVALUE['comprobante_codigo_barra']; ?>" value="<?php echo $compVALUE['comprobante_codigo']; ?>" class="form-control" type="hidden" style="height:40px;" required readonly>
                                    </div>
                                    
                                    <div class="p-10">
                                        <h3 class="text-info m-b-0"><?php echo $compVALUE['tipo_mes_castellano'].' '.$compVALUE['comprobante_periodo']; ?></h3>
                                        <span class="text-muted"><?php echo $compVALUE['comprobante_colaborador']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
    }
?>
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
            const _parm04BASE   = '../public/comprobante_lector.php?';
            const _parm05BASE	= '<?php echo trim($usu_05); ?>';
        </script>

        <script src="../js/api.js?<?php echo date('Ymd');?>"></script>

        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $("#var001").focus();
                }, 100);
            });
        </script>
    </body>
</html>