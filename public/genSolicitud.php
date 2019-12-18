

	<script>
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

		function setSolicitud(codPage){
            var sitPag = '';
            switch (codPage) {
                case 1:
                    sitioPag = 'home';
                    break;
            
                case 2:
                    sitioPag = 'solicitudes';
                    break;
            }
            
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
            '               <input id="workPage" name="workPage" value="'+sitioPag+'" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
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
                    titMen  = 'FAVOR SOLICITAR A SU TALENTO HUMANO DICHO RE-INGRESO. VERIFIQUE!';
                    rowEst  = 'I';
                    antEst  = 'P';
                    break;

                case 2:
                    titEst  = 'Autorizar Solicitud';
                    colEst  = '#22c6ab;';
                    titMen  = 'FAVOR SOLICITAR A SU JEFATURA DICHA AUTORIZACION. VERIFIQUE!';
                    rowEst  = 'A';
                    antEst  = 'I';
                    break;

                case 3:
                    titEst  = 'Aprobar Solicitud';
                    colEst  = '#ffaf0e;';
                    titMen  = 'FAVOR SOLICITAR A SU TALENTO HUMANO DICHA APROBACION. VERIFIQUE!';
                    rowEst  = 'P';
                    antEst  = 'A';
                    break;

                case 4:
                    titEst  = 'Anular Solicitud';
                    colEst  = '#eb4c4c;';
                    titMen  = 'FAVOR SOLICITAR A SU TALENTO HUMANO DICHA ANULACION. VERIFIQUE!';
                    rowEst  = 'C';
                    antEst  = 'I';
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

            if (codRow.getAttribute('value2') != codFun) {
                if ((codRow.getAttribute('value') == 'A' || codRow.getAttribute('value') == 'C') && (rowEst == 'I' || rowEst == 'P' || rowEst == 'C') && (codCar == 21 || codCar == 85 || codCar == 107)) {
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
                    '               <input id="workPage" name="workPage" value="<?php echo $workPage; ?>" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
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
                    '           <button type="submit" class="btn btn-info">Actualizar</button>'+
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
                        '           <button type="submit" class="btn btn-info">Actualizar</button>'+
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
                    '           <button type="submit" class="btn btn-info">Actualizar</button>'+
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

            $("#modalcontent").empty();
            $("#modalcontent").append(html);
        }
	</script>
