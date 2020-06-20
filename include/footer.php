        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap tether Core JavaScript -->
        <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- apps -->
        <script src="../dist/js/app.min.js"></script>
        <script src="../dist/js/app.init.horizontal-fullwidth.js"></script>
        <script src="../dist/js/app-style-switcher.horizontal.js"></script>

        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="../assets/extra-libs/sparkline/sparkline.js"></script>

        <!--Wave Effects -->
        <script src="../dist/js/waves.js"></script>

        <!--Menu sidebar -->
        <script src="../dist/js/sidebarmenu.js"></script>

        <!--Custom JavaScript -->
        <script src="../dist/js/custom.min.js"></script>

        <!--datatables.net -->
        <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
        <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

        <!--chartis chart-->
        <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
        <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

        <!--c3 charts -->
        <script src="../assets/extra-libs/c3/d3.min.js"></script>
        <script src="../assets/extra-libs/c3/c3.min.js"></script>

        <!--chartjs -->
        <script src="../assets/libs/raphael/raphael.min.js"></script>
        <script src="../assets/libs/morris.js/morris.min.js"></script>

        <!-- Chart JS -->
        <script src="../assets/libs/chart.js/dist/Chart.min.js"></script>

        <!--select2 -->
        <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
        <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
        <script src="../dist/js/pages/forms/select2/select2.init.js"></script>

        <!--toast -->
        <script src="../assets/libs/toastr/build/toastr.min.js"></script>
        <script src="../assets/extra-libs/toastr/toastr-init.js"></script>

        <!--GaugeJS -->
        <script src="../assets/libs/gaugeJS/dist/gauge.min.js"></script>

        <!--Flot -->
        <script src="../assets/libs/flot/excanvas.min.js"></script>
        <script src="../assets/libs/flot/jquery.flot.js"></script>
        <script src="../assets/libs/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>

        <!--JVector -->
        <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>

        <!--Sweet Alert2 -->
        <script src="../assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

        <!--Highcharts -->
        <script src="../dist/js/pages/highcharts/highcharts.js"></script>
        <script src="../dist/js/pages/highcharts/modules/data.js"></script>
        <script src="../dist/js/pages/highcharts/modules/drilldown.js"></script>

        <!-- This Page JS -->
        <script src="../assets/libs/echarts/dist/echarts-en.min.js"></script>

        <!--Morris JavaScript -->
        <script src="../assets/libs/raphael/raphael.min.js"></script>
        <script src="../assets/libs/morris.js/morris.min.js"></script>

        <!--Valitate JavaScript -->
        <script src="../assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
        <script src="../assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>

         <!--This page JavaScript -->
        <script src="../assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="../assets/libs/magnific-popup/meg.init.js"></script>

<?php
    if(isset($_GET['code'])){
        $codeRest       = $_GET['code'];
        $msgRest        = $_GET['msg'];
    } else {
        $codeRest       = 0;
        $msgRest        = '';
    }
    
    if ($codeRest == 200) {
?>
        <script>
            $(function() {
                toastr.success('<?php echo $msgRest; ?>', 'Correcto!');
            });

            localStorage.clear();
        </script>
<?php
    }

    if (($codeRest == 204) || ($codeRest == 400) || ($codeRest == 401)) {
?>
        <script>
            $(function() {
                toastr.error('<?php echo $msgRest; ?>', 'Error!');
            });
        </script>
<?php
    }

    if(isset($_GET['code'])){
        switch ($_GET['tipo']) {
            case 'SOLING':
                if ($solictudesJSON['code'] == 200) {
                    foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
                        if ($solictudesVALUE['solicitud_codigo'] == $_GET['codigo']) {
                            if (!empty($solictudesVALUE['solicitud_adjunto'])) {
                                $adjunto = 'http://permisos.conmebol.com/uploads/'.$solictudesVALUE['solicitud_adjunto'];
                            } else {
                                $adjunto = 'javascript:void(0)';
                            }

                            setEmail(
                                $usu_17,
                                $usu_16, 
                                $solictudesVALUE['solicitud_estado_nombre'], 
                                $solictudesVALUE['tipo_permiso_nombre'], 
                                $solictudesVALUE['solicitud_persona'], 
                                $solictudesVALUE['solicitud_fecha_desde_2'], 
                                $solictudesVALUE['solicitud_fecha_hasta_2'], 
                                $solictudesVALUE['solicitud_hora_desde'], 
                                $solictudesVALUE['solicitud_hora_hasta'], 
                                $adjunto, 
                                $solictudesVALUE['solicitud_observacion_colaborador'], 
                                $solictudesVALUE['solicitud_observacion_superior'], 
                                $solictudesVALUE['solicitud_observacion_talento']
                            );

                            break;
                        }
                    }
                }
                
                break;
            
            case 'SOLAUT':
                if ($solictudesJSON['code'] == 200) {
                    foreach ($solictudesJSON['data'] as $solictudesKEY => $solictudesVALUE) {
                        if ($solictudesVALUE['solicitud_codigo'] == $_GET['codigo']) {
                            if (!empty($solictudesVALUE['solicitud_adjunto'])) {
                                $adjunto = 'http://permisos.conmebol.com/uploads/'.$solictudesVALUE['solicitud_adjunto'];
                            } else {
                                $adjunto = 'javascript:void(0)';
                            }
                            
                            setEmail(
                                'rrhh@conmebol.com',
                                'Talento Humano',
                                $solictudesVALUE['solicitud_estado_nombre'], 
                                $solictudesVALUE['tipo_permiso_nombre'], 
                                $solictudesVALUE['solicitud_persona'], 
                                $solictudesVALUE['solicitud_fecha_desde_2'], 
                                $solictudesVALUE['solicitud_fecha_hasta_2'], 
                                $solictudesVALUE['solicitud_hora_desde'], 
                                $solictudesVALUE['solicitud_hora_hasta'], 
                                $adjunto, 
                                $solictudesVALUE['solicitud_observacion_colaborador'], 
                                $solictudesVALUE['solicitud_observacion_superior'], 
                                $solictudesVALUE['solicitud_observacion_talento']
                            );

                            $remi = $usu_01.' '.$usu_04;
                            setEmail(
                                $usu_15,
                                $remi, 
                                $solictudesVALUE['solicitud_estado_nombre'], 
                                $solictudesVALUE['tipo_permiso_nombre'], 
                                $solictudesVALUE['solicitud_persona'], 
                                $solictudesVALUE['solicitud_fecha_desde_2'], 
                                $solictudesVALUE['solicitud_fecha_hasta_2'], 
                                $solictudesVALUE['solicitud_hora_desde'], 
                                $solictudesVALUE['solicitud_hora_hasta'], 
                                $adjunto, 
                                $solictudesVALUE['solicitud_observacion_colaborador'], 
                                $solictudesVALUE['solicitud_observacion_superior'], 
                                $solictudesVALUE['solicitud_observacion_talento']
                            );

                            break;
                        }
                    }
                }
                
                break;
        }
    }
?>