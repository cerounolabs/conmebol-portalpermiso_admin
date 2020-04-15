const urlBASE   = 'http://api.conmebol.com/sfholox/public/v1';
const xHTTP	    = new XMLHttpRequest();

function getJSON(codJSON, codURL) {
    var urlJSON = urlBASE + '/' + codURL;

    $.ajax({
        'async': false,
        'type': "GET",
        'global': false,
        'dataType': "json",
        'url': urlJSON,
        'success': function (data) {
            localStorage.removeItem(codJSON);
            localStorage.setItem(codJSON, JSON.stringify(data));
        }
    });
}

function postJSON(codPAGE, codURL, codPARS) {
    var urlJSON = urlBASE + '/' + codURL;

    xHTTP.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var xJSON = JSON.parse(this.responseText);
            window.location.replace('../public/' + codPAGE + '.php?code='+ xJSON.code + '&msg=' + xJSON.message); 
        }
    };
    
    xHTTP.open('POST', urlJSON);
    xHTTP.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
    xHTTP.send(codPARS);
}

function getDate(var01) {
    var ff      = new Date();
    var dd      = ff.getDate();
    var mm      = ff.getMonth() + 1;
    var aa      = ff.getFullYear();
    var result  = '';

    if (dd < 10 ) {
        dd = '0' + dd;
    }

    if (mm < 10 ) {
        mm = '0' + mm;
    }
    
    switch (var01) {
        case 1:
            result = aa + '-' + mm + '-' + dd;
            break;
    }
    
    return result;
}

function cantFecha(){
    var xJSON       = JSON.parse(localStorage.getItem('solicitudJSON'))['data'];
    var inpSol      = document.getElementById('var01');
    var fecDesde    = document.getElementById('var02');
    var fecHasta    = document.getElementById('var03');
    var fecCant     = document.getElementById('var04');
    var fecCuenta   = 'N';
    var fec1        = new Date(fecDesde.value.substring(0, 4), (fecDesde.value.substring(5, 7) - 1), fecDesde.value.substring(8, 10));
    var fec2        = new Date(fecHasta.value.substring(0, 4), (fecHasta.value.substring(5, 7) - 1), fecHasta.value.substring(8, 10));

    xJSON.forEach(element => {
        if (inpSol.value == element.tipo_permiso_codigo){
            fecCuenta = element.tipo_dia_corrido;
        }
    });

    if (fec1 <= fec2) {
        var diffDays    = ((fec2.getTime() - fec1.getTime()) / (1000 * 3600 * 24));
        var cantDays    = 0;

        for (var i=0; i < diffDays; i++) {
            if (fec1.getDay() != 0 && fec1.getDay() != 6) {
                cantDays++;
            }

            if ((fec1.getDay() == 0 || fec1.getDay() == 6) && fecCuenta == 'S') {
                cantDays++;
            }

            fec1.setDate(fec1.getDate() + 1);
        }

        if (cantDays == 0) {
            cantDays = 1;
        }

        fecCant.value   = cantDays;
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

function cantDia(var01, var02) {
    var timeDiff    = Math.abs(var02.getTime() - var01.getTime());
    var diffDays    = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
    var cantDia     = 0;

    for (var i=0; i < diffDays; i++) {
        if (var01.getDay() == 0 || var01.getDay() == 6) {
            cantDia++;
        }

        var01.setDate(var01.getDate() + 1);
    }

   return cantDia;
}

function valSolicitud(){
    var xJSON   = JSON.parse(localStorage.getItem('solicitudJSON'))['data'];
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
                inpAdj.required     = true;
                titAdj.style.display= '';
            } else {
                inpAdj.readOnly     = false;
                inpAdj.required     = false;
                titAdj.style.display= 'none';
            }
        }
    });
}

function getSolicitud(var01){
    var xJSON   = JSON.parse(localStorage.getItem('solicitudesJSON'))['data'];
    var html    = '';

    xJSON.forEach(element => {
        if (element.solicitud_codigo == var01){
            solicitud_fecha_hora_colaborador   = (element.solicitud_fecha_hora_colaborador.includes('31/12/1969') ? '' : element.solicitud_fecha_hora_colaborador);
            solicitud_fecha_hora_superior      = (element.solicitud_fecha_hora_superior.includes('31/12/1969') ? '' : element.solicitud_fecha_hora_superior);
            solicitud_fecha_hora_talento       = (element.solicitud_fecha_hora_talento.includes('31/12/1969') ? '' : element.solicitud_fecha_hora_talento);
            
            html     =
                '<div class="modal-content">'+
                '   <form id="form" data-parsley-validate method="post" action="">'+
                '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
                '		    <h4 class="modal-title" id="vcenter"> '+element.solicitud_persona+' </h4>'+
                '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                '	    </div>'+
                '	    <div class="modal-body" >'+
                '           <div class="form-group">'+
                '               <input id="workCodigo" name="workCodigo" value="'+element.solicitud_codigo+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                '               <input id="workModo" name="workModo" value="V" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
                '               <input id="workPage" name="workPage" value="'+var01+'" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div class="col-sm-12">'+
                '                   <div class="form-group">'+
                '                       <label>SOLICITUD DE</label>'+
                '                       <input value="'+element.tipo_permiso_nombre+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>FECHA INICIO</label>'+
                '                       <input value="'+element.solicitud_fecha_desde_1+'" class="form-control" type="date" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>FECHA RETORNO</label>'+
                '                       <input value="'+element.solicitud_fecha_hasta_1+'" class="form-control" type="date" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>CANTIDAD DE DIAS</label>'+
                '                       <input value="'+element.solicitud_fecha_cantidad+'" class="form-control" type="number" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div id="tit05" class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>HORA DESDE</label>'+
                '                       <input value="'+element.solicitud_hora_desde+'" class="form-control" type="time" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>HORA HASTA</label>'+
                '                       <input value="'+element.solicitud_hora_hasta+'" class="form-control" type="time" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>CANTIDAD DE HORAS</label>'+
                '                       <input value="'+element.solicitud_hora_cantidad+'" class="form-control" type="number" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>USUARIO SOLICITANTE</label>'+
                '                       <input value="'+element.solicitud_usuario_colaborador+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>FECHA SOLICITANTE</label>'+
                '                       <input value="'+solicitud_fecha_hora_colaborador+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>COMENTARIO SOLICITANTE</label>'+
                '                       <textarea class="form-control" rows="1" style="text-transform:uppercase; height:40px;" readonly>'+element.solicitud_observacion_colaborador+'</textarea>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>USUARIO AUTORIZADOR</label>'+
                '                       <input value="'+element.solicitud_usuario_superior+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>FECHA AUTORIZADOR</label>'+
                '                       <input value="'+solicitud_fecha_hora_superior+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>COMENTARIO AUTORIZADOR</label>'+
                '                       <textarea class="form-control" rows="1" style="text-transform:uppercase; height:40px;" readonly>'+element.solicitud_observacion_superior+'</textarea>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '           <div class="row pt-3">'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>USUARIO APROBADOR</label>'+
                '                       <input value="'+element.solicitud_usuario_talento+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>FECHA APROBADOR</label>'+
                '                       <input value="'+solicitud_fecha_hora_talento+'" class="form-control" type="text" style="text-transform:uppercase; height:40px;" readonly>'+
                '                   </div>'+
                '               </div>'+
                '               <div class="col-sm-12 col-md-4">'+
                '                   <div class="form-group">'+
                '                       <label>COMENTARIO APROBADOR</label>'+
                '                       <textarea class="form-control" rows="1" style="text-transform:uppercase; height:40px;" readonly>'+element.solicitud_observacion_talento+'</textarea>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '	    </div>'+
                '	    <div class="modal-footer">'+
                '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
        }
    });

    $("#modalcontent").empty();
    $("#modalcontent").append(html);
}

function getTipoGerencia(){
    var xJSON = JSON.parse(localStorage.getItem('tipoGerenciaJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoDepartamento(){
    var xJSON = JSON.parse(localStorage.getItem('tipoDepartamentoJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoCargo(){
    var xJSON = JSON.parse(localStorage.getItem('tipoCargoJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoLicencia(){
    var xJSON = JSON.parse(localStorage.getItem('tipoLicenciaJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoPermiso(){
    var xJSON = JSON.parse(localStorage.getItem('tipoPermisoJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoInasistencia(){
    var xJSON = JSON.parse(localStorage.getItem('tipoInasistenciaJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoSolicitud(){
    var xJSON = JSON.parse(localStorage.getItem('tipoSolicitudJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoSolicitudId(codigo){
    var xHTTP	= new XMLHttpRequest();
    var xURL	= urlBASE + '/100/solicitud/' + codigo;
    
    xHTTP.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var xJSON   = JSON.parse(this.responseText);
            var estado  = '';

            if (xJSON['data'][0]['tipo_estado_codigo'] == 'A'){
                estado  =                     
                '                               <option value="A" selected>ACTIVO</option>'+
                '                               <option value="I">INACTIVO</option>';
            } else {
                estado  =                     
                '                               <option value="A">ACTIVO</option>'+
                '                               <option value="I" selected>INACTIVO</option>';
            }

            if (xJSON['data'][0]['tipo_dia_corrido'] == 'S'){
                diaCorrido  =                     
                '                               <option value="S" selected>SI</option>'+
                '                               <option value="N">NO</option>';
            } else {
                diaCorrido  =                     
                '                               <option value="S">SI</option>'+
                '                               <option value="N" selected>NO</option>';
            }

            if (xJSON['data'][0]['tipo_dia_unidad'] == 'D'){
                tipoUnidad  =                     
                '                               <option value="D" selected>DÍA</option>'+
                '                               <option value="H">HORA</option>';
            } else {
                tipoUnidad   =                     
                '                               <option value="D">DÍA</option>'+
                '                               <option value="H" selected>HORA</option>';
            }

            if (xJSON['data'][0]['tipo_archivo_adjunto'] == 'S'){
                tipoAdjunto =                     
                '                               <option value="S" selected>SI</option>'+
                '                               <option value="N">NO</option>';
            } else {
                tipoAdjunto =                     
                '                               <option value="S">SI</option>'+
                '                               <option value="N" selected>NO</option>';
            }

            var html    =
            '<div class="modal-content">'+
            '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitud.php">'+
            '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
            '		    <h4 class="modal-title" id="vcenter"> Solicitud </h4>'+
            '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
            '	    </div>'+
            '	    <div class="modal-body" >'+
            '           <div class="form-group">'+
            '               <input id="workCodigo" name="workCodigo" value="'+xJSON['data'][0]['tipo_permiso_codigo']+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
            '               <input id="workModo" name="workModo" value="U" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
            '           </div>'+
            '           <div class="row pt-3">'+
            '               <div class="col-sm-12 col-md-3">'+
            '                   <div class="form-group">'+
            '                       <label for="var01">ESTADO</label>'+
            '                       <select id="var01" name="var01" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
            '                           <optgroup label="Estado">'+estado+
            '                           </optgroup>'+
            '                       </select>'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-sm-12 col-md-3">'+
            '                   <div class="form-group">'+
            '                       <label for="var02">ORDEN</label>'+
            '                       <input id="var02" name="var02" class="form-control" value="'+xJSON['data'][0]['tipo_orden_numero']+'" type="number" style="text-transform:uppercase; height:40px;" placeholder="ORDEN">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-sm-12 col-md-3">'+
            '                   <div class="form-group">'+
            '                       <label for="var03">DÍA LIMITE</label>'+
            '                       <input id="var03" name="var03" class="form-control" value="'+xJSON['data'][0]['tipo_orden_numero']+'" type="number" style="text-transform:uppercase; height:40px;" placeholder="ORDEN">'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-sm-12 col-md-3">'+
            '                   <div class="form-group">'+
            '                       <label for="var04">DÍA CORRIDO</label>'+
            '                       <select id="var04" name="var04" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
            '                           <optgroup label="Corrido">'+diaCorrido+
            '                           </optgroup>'+
            '                       </select>'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-sm-12 col-md-3">'+
            '                   <div class="form-group">'+
            '                       <label for="var05">DÍA UNIDAD</label>'+
            '                       <select id="var05" name="var05" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
            '                           <optgroup label="Corrido">'+tipoUnidad+
            '                           </optgroup>'+
            '                       </select>'+
            '                   </div>'+
            '               </div>'+
            '               <div class="col-sm-12 col-md-3">'+
            '                   <div class="form-group">'+
            '                       <label for="var06">ARCHIVO ADJUNTO</label>'+
            '                       <select id="var06" name="var06" class="select2 form-control custom-select" style="width:100%; height:40px;">'+
            '                           <optgroup label="Corrido">'+tipoAdjunto+
            '                           </optgroup>'+
            '                       </select>'+
            '                   </div>'+
            '               </div>'+
            '           </div>'+
            '           <div class="row pt-3">'+
            '                <div class="col-sm-12">'+
            '                    <div class="form-group">'+
            '                        <label for="var07">OBSERVACI&Oacute;N</label>'+
            '                        <textarea id="var07" name="var07" class="form-control" rows="3" style="text-transform:uppercase;">'+xJSON['data'][0]['tipo_observacion']+'</textarea>'+
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
    };
    
    xHTTP.open('GET', xURL);
    xHTTP.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
    xHTTP.setRequestHeader('Authorization', 'Basic dXNlcl9zZmhvbG94Om5zM3JfNWZoMCEweA==');
    xHTTP.send();
}

function setSolicitud(var01){
    var xJSON   = JSON.parse(localStorage.getItem('solicitudJSON'))['data'];
    var xSelect = '';
    var fecIni  = getDate(1);
    var fecRet  = getDate(1);
    
    xJSON.forEach(element => {
        if (element.tipo_estado_codigo == 'A'){
            if (element.tipo_solicitud_codigo != 'I') {
                xSelect = xSelect + '                               <option value="'+element.tipo_permiso_codigo+'">'+element.tipo_solicitud_nombre + ' - ' + element.tipo_permiso_nombre+'</option>';
            } else {
                xSelect = xSelect + '                               <option value="'+element.tipo_permiso_codigo+'">'+element.tipo_permiso_nombre+'</option>';
            }
        }
    });
    
    var html     =
    '<div class="modal-content">'+
    '   <form id="form" data-parsley-validate method="post" enctype="multipart/form-data" action="../class/crud/solicitudes.php">'+
    '	    <div class="modal-header" style="color:#fff; background:#163562;">'+
    '		    <h4 class="modal-title" id="vcenter"> Solicitud </h4>'+
    '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
    '	    </div>'+
    '	    <div class="modal-body" >'+
    '           <div class="form-group">'+
    '               <input id="workCodigo" name="workCodigo" value="0" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
    '               <input id="workModo" name="workModo" value="C" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
    '               <input id="workPage" name="workPage" value="'+var01+'" class="form-control" type="hidden" placeholder="Modo" required readonly>'+
    '           </div>'+
    '           <div class="row pt-3">'+
    '               <div class="col-sm-12">'+
    '                   <div class="form-group">'+
    '                       <label for="var01">SOLICITUD DE</label>'+
    '                       <select id="var01" name="var01" class="select2 form-control custom-select" style="width:100%; height:40px;" onblur="valSolicitud();">'+
    '                           <optgroup label="Solicitud">'+xSelect+
    '                           </optgroup>'+
    '                       </select>'+
    '                   </div>'+
    '               </div>'+
    '           </div>'+
    '           <div class="row pt-3">'+
    '               <div id="tit02" class="col-sm-12 col-md-4">'+
    '                   <div class="form-group">'+
    '                       <label for="var02">FECHA INICIO</label>'+
    '                       <input id="var02" name="var02" class="form-control" type="date" value="'+fecIni+'" onblur="cantFecha();" style="text-transform:uppercase; height:40px;" placeholder="FECHA DESDE">'+
    '                   </div>'+
    '               </div>'+
    '               <div id="tit03" class="col-sm-12 col-md-4">'+
    '                   <div class="form-group">'+
    '                       <label for="var03">FECHA RETORNO</label>'+
    '                       <input id="var03" name="var03" class="form-control" type="date" value="'+fecRet+'" onblur="cantFecha();" style="text-transform:uppercase; height:40px;" placeholder="FECHA HASTA">'+
    '                   </div>'+
    '               </div>'+
    '               <div id="tit04" class="col-sm-12 col-md-4">'+
    '                   <div class="form-group">'+
    '                       <label for="var04">CANTIDAD DE DIAS</label>'+
    '                       <input id="var04" name="var04" class="form-control" type="number" value="1" style="text-transform:uppercase; height:40px;" placeholder="CANTIDAD DE DIAS" readonly>'+
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
    '                       <input id="var07" name="var07" class="form-control" type="number" value="0" style="text-transform:uppercase; height:40px;" placeholder="CANTIDAD DE HORAS" readonly>'+
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
    '           <button type="submit" name="submit" class="btn btn-info">Guardar</button>'+
    '		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
    '	    </div>'+
    '   </form>'+
    '</div>';

    $("#modalcontent").empty();
    $("#modalcontent").append(html);
}

function setEstado(rowSel, rowEst, rowAcc, rowFun, rowCar){
    var codRow  = document.getElementById(rowSel);
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
            titEst  = 'Rechazar Solicitud';
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
        var xJSON   = JSON.parse(localStorage.getItem('solicitudesJSON'))['data'];
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
        if (codRow.getAttribute('value2') != rowFun) {
            if ((codRow.getAttribute('value') == 'A' || codRow.getAttribute('value') == 'C') && (rowEst == 'I' || rowEst == 'P' || rowEst == 'C') && (rowCar == 21 || rowCar == 87 || rowCar == 109)) {
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