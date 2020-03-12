	<script>
function setEstado(rowSel, rowEst, rowAcc){
    var codRow  = document.getElementById(rowSel);
    var codFun  = '<?php echo trim($usu_05); ?>';
    var codCar  = '<?php echo trim($usu_13); ?>';
    var html    = '';
    var titEst  = '';

    switch (rowEst) {
        case 1:
            titEst  = 'Re-Ingresar Solicitud';
            colEst  = '#2585e4;';
            colBtn  = 'btn-info';
            titMen  = 'FAVOR SOLICITAR A TALENTO HUMANO DICHO RE-INGRESO. VERIFIQUE!';
            rowEst  = 'I';
            antEst  = 'P';
            break;

        case 2:
            titEst  = 'Autorizar Solicitud';
            colEst  = '#22c6ab;';
            colBtn  = 'btn-success';
            titMen  = 'FAVOR SOLICITAR A SU JEFATURA DICHA AUTORIZACION. VERIFIQUE!';
            rowEst  = 'A';
            antEst  = 'I';
            break;

        case 3:
            titEst  = 'Aprobar Solicitud';
            colEst  = '#ffaf0e;';
            colBtn  = 'btn-warning';
            titMen  = 'FAVOR SOLICITAR A TALENTO HUMANO DICHA APROBACION. VERIFIQUE!';
            rowEst  = 'P';
            antEst  = 'A';
            break;

        case 4:
            titEst  = 'Anular Solicitud';
            colEst  = '#eb4c4c;';
            colBtn  = 'btn-danger';
            titMen  = 'FAVOR SOLICITAR A TALENTO HUMANO DICHA ANULACION. VERIFIQUE!';
            rowEst  = 'C';
            antEst  = 'I';
            break;

        case 5:
            titEst  = 'Visualizar Solicitud';
            colEst  = '#563dea;';
            colBtn  = 'btn-primary';
            titMen  = '';
            rowEst  = 'V';
            antEst  = '';
            break;
    }

    switch (rowAcc) {
        case 1:
            rowAcc = 'J';
            break;

        case 2:
            rowAcc = 'T';
            break;
    }

    if (rowEst == 'V') {
        var xDATA   = '<?php echo json_encode($solictudesJSON['data']); ?>';
        var xJSON   = JSON.parse(xDATA);
        var html    = '';
        
        xJSON.forEach(element => {
            if (element.solicitud_codigo == codRow.id) {
            html =
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
                '               <input id="workPage" name="workPage" value="" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div class="col-sm-12">'+
                '                   <div class="form-group">'+
                '                       <label for="var01">SOLICITUD DE</label>'+
                '                       <input id="var01" name="var01" value="'+element.tipo_permiso_nombre+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" placeholder="SOLICITUD" readonly>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div id="tit02" class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var02">FECHA INICIO</label>'+
                '                       <input id="var02" name="var02" class="form-control" type="date" value="" style="text-transform:uppercase; height:40px;" placeholder="FECHA DESDE" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div id="tit03" class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var03">FECHA RETORNO</label>'+
                '                       <input id="var03" name="var03" class="form-control" type="date" value="" style="text-transform:uppercase; height:40px;" placeholder="FECHA HASTA" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div id="tit04" class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var04">CANTIDAD DE DIAS</label>'+
                '                       <input id="var04" name="var04" class="form-control" type="number" value="" style="text-transform:uppercase; height:40px;" placeholder="CANTIDAD DE DIAS" readonly>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div id="tit05" class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var05">HORA DESDE</label>'+
                '                       <input id="var05" name="var05" class="form-control" type="time" value="" style="text-transform:uppercase; height:40px;" placeholder="HORA DESDE" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div id="tit06" class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var06">HORA HASTA</label>'+
                '                       <input id="var06" name="var06" class="form-control" type="time" value="" style="text-transform:uppercase; height:40px;" placeholder="HORA HASTA" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div id="tit07" class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var07">CANTIDAD DE HORAS</label>'+
                '                       <input id="var07" name="var07" class="form-control" type="number" value="" style="text-transform:uppercase; height:40px;" placeholder="CANTIDAD DE HORAS" readonly>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '                <div class="col-sm-12">'+
                '                    <div class="form-group">'+
                '                        <label for="var09">COMENTARIO</label>'+
                '                        <textarea id="var09" name="var09" class="form-control" rows="3" style="text-transform:uppercase;" readonly></textarea>'+
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
            }
        });
    } else {
        if (codRow.getAttribute('value2') != codFun) {
            if ((codRow.getAttribute('value') == 'A' || codRow.getAttribute('value') == 'C') && (rowEst == 'I' || rowEst == 'P' || rowEst == 'C') && (codCar == 21 || codCar == 87 || codCar == 109)) {
                html    =
                '<div class="modal-content">'+
                '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                '	    <div class="modal-header" style="color:#fff; background:'+colEst+';">'+
                '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                '	    </div>'+
                '	    <div class="modal-body" >'+
                '           <div class="form-group">'+
                '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                '               <input id="workAccion" name="workAccion" value="'+rowAcc+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                '               <input id="workPage" name="workPage" value="home.php?" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                '               <input id="var01" name="var01" value="'+rowEst+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
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
                '           <button type="submit" class="btn '+colBtn+'">'+titEst+'</button>'+
                '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
            } else {
                if (codRow.getAttribute('value') == 'I') {
                    html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                    '	    <div class="modal-header" style="color:#fff; background:'+colEst+';">'+
                    '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workAccion" name="workAccion" value="'+rowAcc+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="workPage" name="workPage" value="home.php?" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                    '               <input id="var01" name="var01" value="'+rowEst+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
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
                    '           <button type="submit" class="btn '+colBtn+'">'+titEst+'</button>'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                } else {
                    html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" action="#">'+
                    '	    <div class="modal-header" style="color:#fff; background:'+colEst+'">'+
                    '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    '	    <div class="modal-body" >'+
                    '           <div class="form-group">'+
                    '               <h4 style="text-align:center;">'+titMen+'</h4>'
                    '           </div>'+
                    '	    </div>'+
                    '	    <div class="modal-footer">'+
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                }
            }
        } else {
            if (codRow.getAttribute('value') == 'I' && rowEst == 'C') {
                html    =
                '<div class="modal-content">'+
                '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                '	    <div class="modal-header" style="color:#fff; background:'+colEst+';">'+
                '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                '	    </div>'+
                '	    <div class="modal-body" >'+
                '           <div class="form-group">'+
                '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                '               <input id="workAccion" name="workAccion" value="'+rowAcc+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                '               <input id="workPage" name="workPage" value="home.php?" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                '               <input id="var01" name="var01" value="'+rowEst+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
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
                '           <button type="submit" class="btn '+colBtn+'">'+titEst+'</button>'+
                '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
            } else {
                html    =
                '<div class="modal-content">'+
                '   <form id="form" data-parsley-validate method="post" action="#">'+
                '	    <div class="modal-header" style="color:#fff; background:'+colEst+'">'+
                '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                '	    </div>'+
                '	    <div class="modal-body" >'+
                '           <div class="form-group">'+
                '               <h4 style="text-align:center;">'+titMen+'</h4>'
                '           </div>'+
                '	    </div>'+
                '	    <div class="modal-footer">'+
                '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
            }
        }
    }

    $("#modalcontent").empty();
    $("#modalcontent").append(html);
}
	</script>
