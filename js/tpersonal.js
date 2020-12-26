function setTPersonal(codElem, codAcc){
    var xJSON   = getColaboradorId(_parm05BASE);
    var xJSON2  = getDominio('TARJETAPERSONALCANTIDAD')
    var xJSON3  = getDominio('REDSOCIALTIPO');
    var xJSON4  = getDominio('PREFIJOCELULARTIPO');
    var xJSON5  = getTPersonaId(codElem);
    var xJSON6  = getTPersonalPrefijoTPersonal(codElem);
    var xJSON7  = getTPersonalRSocialTPersonal(codElem);
    var html    = '';
    var htmlTelf= '';
    var htmlRedS= '';
    var htmlNom = '';
    var htmlApe = '';
    var selTar  = 0;
    var selRSoc = '';
    var selPFijo= 0;
    var indTelf = 1;
    var indRSoc = 1;
    var codEst  = 1;

    switch (codAcc) {
		case 1:
			bodyTit = 'NUEVO';
			bodyCol = '#163562;';
			bodyMod = 'C';
			bodyOnl = '';
            bodyBot = '           <button type="submit" class="btn text-center text-white" style="background-color:'+ bodyCol +'">Generar Solicitud</button>';
			break;

		case 2:
			bodyTit = 'VER';
			bodyCol = '#6929d5;';
			bodyMod = 'R';
			bodyOnl = 'readonly';
			bodyBot = '';
			break;

		case 3:
            codEst  = 2;
			bodyTit = 'EDITAR';
			bodyCol = '#007979;';
			bodyMod = 'U';
			bodyOnl = '';
            bodyBot = '           <button type="submit" class="btn text-center text-white" style="background-color:'+ bodyCol +'">Confirmar Solicitud</button>';
			break;

		case 4:
            codEst  = 3;
			bodyTit = 'ANULAR';
			bodyCol = '#ff2924;';
			bodyMod = 'U';
			bodyOnl = 'readonly';
			bodyBot = '           <button type="submit" class="btn text-center text-white" style="background-color:'+ bodyCol +'">Anular Solicitud</button>';
			break;
	
		case 5:
			bodyTit = 'AUDITORIA';
			bodyCol = '#d38109;';
			bodyMod = 'A';
			bodyOnl = 'readonly';
			bodyBot = '';
			break;

		default:
			break;
    }

    if(codAcc == 1){
        xJSON2.forEach(element1 => {
            if (element1.tipo_estado_parametro == 1) {
                selTar = selTar + '                               <option value="'+ element1.tipo_parametro +'">'+ element1.tipo_nombre_castellano +'</option>';
            } 
        });

        xJSON3.forEach(element1 => {
            if (element1.tipo_estado_parametro == 1) {
                selRSoc = selRSoc + '                               <option value="'+ element1.tipo_parametro +'">'+ element1.tipo_nombre_castellano +'</option>';
            } 
        });

        xJSON4.forEach(element1 => {
            if (element1.tipo_estado_parametro == 1) {
                selPFijo = selPFijo + '                               <option value="'+ element1.tipo_parametro +'">'+ element1.tipo_nombre_castellano +'</option>';
            } 
        });

        xJSON.forEach(element => {
            bodyTit = element.nombre_completo;
            html    =
                '<div class="modal-content">'+
                '   <form id="form" data-parsley-validate method="post" enctype="multipart/form-data" action="../class/crud/tpersonal.php">'+
                '	    <div class="modal-header" style="color:#fff; background:'+ bodyCol +'">'+
                '		    <h4 class="modal-title" id="vcenter">'+ bodyTit +'</h4>'+
                '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                '	    </div>'+
                ''+
                '	    <div class="modal-body">'+
                '           <div class="row">'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var00_1">Nombre a visualizar</label>'+
                '                       <select id="var00_1" name="var00_1" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="Visualizar">'+
                '                               <option value="P">'+ element.nombre_1 +'</option>'+
                '                               <option value="S">'+ element.nombre_2 +'</option>'+
                '                           </optgroup>'+
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var00_2">Apellido a visualizar</label>'+
                '                       <select id="var00_2" name="var00_2" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="Visualizar">'+
                '                               <option value="P">'+ element.apellido_1 +'</option>'+
                '                               <option value="S">'+ element.apellido_2 +'</option>'+
                '                           </optgroup>'+
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var01">Correo</label>'+
                '                       <input id="var01" name="var01" value="'+ element.email +'" class="form-control" type="email" style="height:40px;" readonly required>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-8">'+
                '                   <div class="form-group">'+
                '                       <label for="var00_3">Cargo</label>'+
                '                       <input id="var00_3" name="var00_3" value="'+ element.cargo_nombre +'" class="form-control" type="text" style="height:40px;" readonly required>'+
                '                   </div>'+
                '               </div>'+
                ''+
/*
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var00_2">Fecha Nacimiento</label>'+
                '                       <input id="var00_2" name="var00_2" value="'+ element.fecha_nacimiento_2 +'" class="form-control" type="text" style="height:40px;" readonly required>'+
                '                   </div>'+
                '               </div>'+
                ''+
*/
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label for="var02">Tarjetas Requeridas</label>'+
                '                       <select id="var02" name="var02" value="" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="Cantidad">'+ selTar +
                '                           </optgroup>'+
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-6 col-md-3">'+
                '                   <div class="form-group">'+
                '                       <label for="var03_1">Visualizar</label>'+
                '                       <select id="var03_1" name="var03_1" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="Tipo">'+
                '								<option value="S">SI</option>'+
                '							    <option value="N">NO</option>'+
                '                           </optgroup>'+ 
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-6 col-md-3">'+
                '                   <div class="form-group">'+
                '                       <label for="var04_1">Prefijo</label>'+
                '                       <select id="var04_1" name="var04_1" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="Tipo">'+ selPFijo +
                '                           </optgroup>'+
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12 col-md-6">'+
                '                   <div class="form-group">'+
                '                       <label for="var05_1">Celular Corporativo</label>'+
                '                       <input id="var05_1" name="var05_1" value="" class="form-control" type="text" style="height:40px;" required>'+
                '                   </div>'+
                '               </div>'+
                ''+
/*
                '               <div class="col-sm-6 col-md-3">'+
                '                   <div class="form-group">'+
                '                       <label for="var03_2">Visualizar</label>'+
                '                       <select id="var03_2" name="var03_2" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="">'+
                '								<option value="S">SI</option>'+
                '							    <option value="N">NO</option>'+
                '                           </optgroup>'+ 
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-6 col-md-3">'+
                '                   <div class="form-group">'+
                '                       <label for="var04_2">Prefijo</label>'+
                '                       <select id="var04_2" name="var04_2" class="select2 form-control custom-select" style="height:40px;" required>'+ 
                '                           <optgroup label="Tipo">'+ selPFijo +
                '                           </optgroup>'+
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12 col-md-6">'+
                '                   <div class="form-group">'+
                '                       <label for="var05_2">Celular Particular</label>'+
                '                       <input id="var05_2" name="var05_2" value="" class="form-control" type="text" style="height:40px;" required>'+
                '                   </div>'+
                '               </div>'+
                ''+
*/
                '               <div class="col-sm-6 col-md-3">'+
                '                   <div class="form-group">'+
                '                       <label for="var06_1">Visualizar</label>'+
                '                       <select id="var06_1" name="var06_1" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="Tipo">'+
                '								<option value="S">SI</option>'+
                '							    <option value="N">NO</option>'+
                '                           </optgroup>'+ 
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-6 col-md-3">'+
                '                   <div class="form-group">'+
                '                       <label for="var07_1">Red Social</label>'+
                '                       <select id="var07_1" name="var07_1" class="select2 form-control custom-select" style="height:40px;" required>'+
                '                           <optgroup label="Red Social">'+ selRSoc +
                '                           </optgroup>'+ 
                '                       </select>'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12 col-md-6">'+
                '                   <div class="form-group">'+
                '                       <label for="var08_1">Link</label>'+
                '                       <input id="var08_1" name="var08_1"  class="form-control" type="text" style="height:40px;">'+ 
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                ''+
                '           <div class="form-group">'+
                '               <input class="form-control" type="hidden" id="workCodigo"       name="workCodigo"       value="'+ codElem +'"       required readonly>'+
                '               <input class="form-control" type="hidden" id="workModo"         name="workModo"         value="'+ bodyMod +'"       required readonly>'+
                '               <input class="form-control" type="hidden" id="workPage"         name="workPage"         value="'+ _parm04BASE +'"   required readonly>'+
                '               <input class="form-control" type="hidden" id="workDocumento"    name="workDocumento"    value="'+ _parm05BASE +'"   required readonly>'+
                '				<input class="form-control" type="hidden" id="workEstado"       name="workEstado"       value="'+ codEst +'"        required readonly>'+
                '               <input class="form-control" type="hidden" id="workAccion"       name="workAccion"       value="1"                   required readonly>'+
                '               <input class="form-control" type="hidden" id="workCTelefono"    name="workCTelefono"    value="3"                   required readonly>'+
                '               <input class="form-control" type="hidden" id="workCRSocial"     name="workCRSocial"     value="2"                   required readonly>'+
                '           </div>'+
                '	    </div>'+
                ''+
                '	    <div class="modal-footer">'+ bodyBot +
                '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
                
        });
    } else if(codAcc == 2){
        window.open('../export/tpersonal_pdf.php?&codigo='+ codElem, '_blank'); 
    } else if(codAcc > 2 && codAcc < 5){
        xJSON5.forEach(element => {
            if (element.tarjeta_personal_codigo == codElem){
                bodyTit = element.tarjeta_personal_nombre;

                xJSON6.forEach(element1 => {
                    if(element1.tarjeta_personal_codigo == codElem){
                        var rowView = 'SI';

                        if (element1.tarjeta_personal_telefono_visualizar != 'S'){
                            rowView = 'NO';
                        }

                        htmlTelf = htmlTelf +
                            '               <div class="col-sm-6 col-md-3">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var03_'+ indTelf +'">Visualizar</label>'+
                            '                       <select id="var03_1'+ indTelf +'" name="var03_'+ indTelf +'" class="select2 form-control custom-select" style="height:40px;" readonly required>'+
                            '                           <optgroup label="Tipo">'+
                            '								<option value="'+ element1.tarjeta_personal_telefono_visualizar +'">'+ rowView +'</option>'+
                            '                           </optgroup>'+ 
                            '                       </select>'+
                            '                   </div>'+
                            '               </div>'+
                            ''+
                            '               <div class="col-sm-6 col-md-3">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var04_'+ indTelf +'">Prefijo</label>'+
                            '                       <select id="var04_'+ indTelf +'" name="var04_'+ indTelf +'" class="select2 form-control custom-select" style="height:40px;" readonly required>'+
                            '                           <optgroup label="Tipo">'+
                            '						        <option value="'+ element1.tipo_prefijo_parametro +'">+'+ element1.tipo_prefijo_castellano +'</option>'+
                            '                           </optgroup>'+
                            '                       </select>'+
                            '                   </div>'+
                            '               </div>'+
                            ''+
                            '               <div class="col-sm-12 col-md-6">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var05_'+ indTelf +'">Celular</label>'+
                            '                       <input id="var05_'+ indTelf +'" name="var05_'+ indTelf +'" value="'+ element1.tarjeta_personal_telefono_numero +'" class="form-control" type="text" style="height:40px;" readonly required>'+
                            '                   </div>'+
                            '               </div>'+
                            '';

                        indTelf= indTelf + 1;
                     }  
                });

                xJSON7.forEach(element1 => {
                    if(element1.tarjeta_personal_codigo == codElem){
                        var rowView = 'SI';

                        if (element1.tarjeta_personal_red_social_visualizar != 'S'){
                            rowView = 'NO';
                        }

                        htmlRedS = htmlRedS +
                            '               <div class="col-sm-6 col-md-3">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var06_'+indRSoc+'">Visualizar</label>'+
                            '                       <select id="var06_'+indRSoc+'" name="var06_'+indRSoc+'" class="select2 form-control custom-select" style="height:40px;" readonly required>'+
                            '                           <optgroup label="Tipo">'+
                            '								<option value="'+ element1.tarjeta_personal_red_social_visualizar +'">'+ rowView +'</option>'+
                            '                           </optgroup>'+ 
                            '                       </select>'+
                            '                   </div>'+
                            '               </div>'+
                            ''+
                            '               <div class="col-sm-6 col-md-3">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var07_'+indRSoc+'">Red Social</label>'+
                            '                       <select id="var07_'+indRSoc+'" name="var07_'+indRSoc+'" class="select2 form-control custom-select" style="height:40px;" readonly required>'+
                            '                           <optgroup label="Red Social">'+
                            '						        <option value="'+ element1.tipo_red_social_parametro +'">'+ element1.tipo_red_social_castellano +'</option>'+
                            '                           </optgroup>'+ 
                            '                       </select>'+
                            '                   </div>'+
                            '               </div>'+
                            ''+
                            '               <div class="col-sm-12 col-md-6">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var08_'+indRSoc+'">Link</label>'+
                            '                       <input id="var08_'+indRSoc+'" name="var08_'+indRSoc+'" value="'+ element1.tarjeta_personal_red_social_direccion +'" class="form-control" type="text" style="height:40px;" readonly>'+ 
                            '                   </div>'+
                            '               </div>'+
                            '           </div>'+
                            '';

                        indRSoc = indRSoc + 1;
                     }  
                });

                if(element.tarjeta_personal_nombre_visualizar == 'P'){
                    htmlNom = '                               <option value="P">'+ element.tarjeta_personal_nombre1 +'</option>';
                } else {
                    htmlNom = '                               <option value="S">'+ element.tarjeta_personal_nombre2 +'</option>';
                }

                if(element.tarjeta_personal_apellido_visualizar == 'P'){
                    htmlApe = '                               <option value="P">'+ element.tarjeta_personal_apellido1 +'</option>';
                } else {
                    htmlApe = '                               <option value="S">'+ element.tarjeta_personal_apellido2 +'</option>';
                }

                html    =
                    '<div class="modal-content">'+
                    '   <form id="form" data-parsley-validate method="post" enctype="multipart/form-data" action="../class/crud/tpersonal.php">'+
                    '	    <div class="modal-header" style="color:#fff; background:'+ bodyCol +'">'+
                    '		    <h4 class="modal-title" id="vcenter">'+ bodyTit +'</h4>'+
                    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                    '	    </div>'+
                    ''+
                    '	    <div class="modal-body">'+
                    '           <div class="row">'+
                    '               <div class="col-sm-12 col-md-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var00_1">Nombre a visualizar</label>'+
                    '                       <select id="var00_1" name="var00_1" class="select2 form-control custom-select" style="height:40px;" readonly required>'+
                    '                           <optgroup label="Visualizar">'+ htmlNom +
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    ''+
                    '               <div class="col-sm-12 col-md-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var00_2">Apellido a visualizar</label>'+
                    '                       <select id="var00_2" name="var00_2" class="select2 form-control custom-select" style="height:40px;" readonly required>'+
                    '                           <optgroup label="Visualizar">'+ htmlApe +
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    ''+
                    '               <div class="col-sm-12 col-md-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var01">Correo</label>'+
                    '                       <input id="var01" name="var01" value="'+ element.tarjeta_personal_email +'" class="form-control" type="email" style="height:40px;" readonly required>'+
                    '                   </div>'+
                    '               </div>'+
                    ''+
                    '               <div class="col-sm-12 col-md-8">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var00_3">Cargo</label>'+
                    '                       <input id="var00_3" name="var00_3" value="'+ element.tipo_cargo_nombre +'" class="form-control" type="text" style="height:40px;" readonly required>'+
                    '                   </div>'+
                    '               </div>'+
                    ''+
                    
/*
                    '               <div class="col-sm-12 col-md-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var00_2">Fecha Nacimiento</label>'+
                    '                       <input id="var00_2" name="var00_2" value="'+ element.tarjeta_personal_fecha_nacimiento_2 +'" class="form-control" type="text" style="height:40px;" readonly required>'+
                    '                   </div>'+
                    '               </div>'+
                    ''+
*/
                    '               <div class="col-sm-12 col-md-4">'+
                    '                   <div class="form-group">'+
                    '                       <label for="var02">Tarjetas Requeridas</label>'+
                    '                       <select id="var02" name="var02" value="" class="select2 form-control custom-select" style="height:40px;" readonly required>'+
                    '                           <optgroup label="Cantidad">'+
                    '                               <option value="'+ element.tipo_cantidad_parametro +'">'+ element.tipo_cantidad_castellano +'</option>' +
                    '                           </optgroup>'+
                    '                       </select>'+
                    '                   </div>'+
                    '               </div>'+
                    ''+ htmlTelf +
                    ''+ htmlRedS +
                    ''+
                    '           <div class="form-group">'+
                    '               <input class="form-control" type="hidden" id="workCodigo"       name="workCodigo"       value="'+ codElem +'"                               required readonly>'+
                    '               <input class="form-control" type="hidden" id="workModo"         name="workModo"         value="'+ bodyMod +'"                               required readonly>'+
                    '               <input class="form-control" type="hidden" id="workPage"         name="workPage"         value="'+ _parm04BASE +'"                           required readonly>'+
                    '               <input class="form-control" type="hidden" id="workDocumento"    name="workDocumento"    value="'+ element.tarjeta_personal_documento +'"    required readonly>'+
                    '				<input class="form-control" type="hidden" id="workEstado"       name="workEstado"       value="'+ codEst +'"                                required readonly>'+
                    '               <input class="form-control" type="hidden" id="workAccion"       name="workAccion"       value="2"                                           required readonly>'+
                    '               <input class="form-control" type="hidden" id="workCTelefono"    name="workCTelefono"    value="'+ indTelf +'"                               required readonly>'+
                    '               <input class="form-control" type="hidden" id="workCRSocial"     name="workCRSocial"     value="'+ indRSoc +'"                               required readonly>'+
                    '           </div>'+
                    '	    </div>'+
                    ''+
                    '	    <div class="modal-footer">'+ bodyBot +
                    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                    '	    </div>'+
                    '   </form>'+
                    '</div>';
                }
        });    
    }

    $("#modalcontent").empty();
    $("#modalcontent").append(html);
}