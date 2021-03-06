const urlBASE   = 'http://api.conmebol.com/sfholox/public/v1';
const autBASE   = 'dXNlcl9zZmhvbG94Om5zM3JfNWZoMCEweA==';
const xHTTP	    = new XMLHttpRequest();

function getJSON(codJSON, codURL) {
    var urlJSON = urlBASE + '/' + codURL;

    xHTTP.open('GET', urlJSON, false);
    xHTTP.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var xJSON = JSON.parse(this.responseText);
            localStorage.removeItem(codJSON);
            localStorage.setItem(codJSON, JSON.stringify(xJSON)); 
        }
    };
    xHTTP.setRequestHeader('Accept', 'application/json;charset=UTF-8');
    xHTTP.setRequestHeader('Authorization', 'Basic ' + autBASE);
    xHTTP.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
    xHTTP.send();
}

function postJSON(codPAGE, codURL, codPARS) {
    var urlJSON = urlBASE + '/' + codURL;

    xHTTP.open('POST', urlJSON, true);
    xHTTP.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var xJSON = JSON.parse(this.responseText);
            window.location.replace('../public/' + codPAGE + '.php?code='+ xJSON.code + '&msg=' + xJSON.message); 
        }
    };
    xHTTP.setRequestHeader('Accept', 'application/json;charset=UTF-8');
    xHTTP.setRequestHeader('Authorization', 'Basic ' + autBASE);
    xHTTP.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
    xHTTP.send(codPARS);
}

function putJSON(codPAGE, codURL, codPARS, codLOAD) {
    var urlJSON = urlBASE + '/' + codURL;

    xHTTP.open('PUT', urlJSON, true);
    xHTTP.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var xJSON = JSON.parse(this.responseText);

            switch (codLOAD) {
                case 1:
                    window.location.replace('../public/' + codPAGE + '.php?code='+ xJSON.code + '&msg=' + xJSON.message);
                    break;
            
                case 2:
                    $(document).ready(function() {
                        localStorage.removeItem('comprobanteJSON');
    
                        var codCom	    = document.getElementById('var01').value;
                        var codPer	    = document.getElementById('var02').value;
                        var codMeD	    = document.getElementById('var03').value;
                        var codMeH      = document.getElementById('var04').value;
                        var codGer      = document.getElementById('var05').value;
                        var codDep      = document.getElementById('var06').value;
                        var codDoc      = document.getElementById('var07').value;
                        var codEst      = document.getElementById('var08').value;
                        var xDATA	    = getComprobanteAll(codCom, codPer, codMeD, codMeH, codGer, codDep, codDoc, codEst);
                        var tableData   = $('#tableLoad').DataTable();
                
                        tableData.clear().rows.add(xDATA).draw();
                    });
                    break;

                case 3:
                    window.location.replace(codPAGE + 'code='+ xJSON.code + '&msg=' + xJSON.message);
                    break;
            }
        }
    };
    xHTTP.setRequestHeader('Accept', 'application/json;charset=UTF-8');
    xHTTP.setRequestHeader('Authorization', 'Basic ' + autBASE);
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

//    if (fec1.getDay() != 0 && fec1.getDay() != 6) {
        if (fec1 <= fec2) {
            var diffDays    = ((fec2.getTime() - fec1.getTime()) / (1000 * 3600 * 24));
            var cantDays    = 0;

            for (var i=0; i < diffDays; i++) {
                var fecAux = fec1.getFullYear() + '-' + (fec1.getMonth()+1) + '-' + fec1.getDate();

                if (fecAux != '2020-1-1' && fecAux != '2020-3-1' && fecAux != '2020-4-9' && fecAux != '2020-4-10' && fecAux != '2020-5-1' && fecAux != '2020-5-14' && fecAux != '2020-5-15' && fecAux != '2020-6-12' && fecAux != '2020-8-15' && fecAux != '2020-9-29' && fecAux != '2020-12-8' && fecAux != '2020-12-24' && fecAux != '2020-12-25' && fecAux != '2020-12-28' && fecAux != '2020-12-29' && fecAux != '2020-12-30' && fecAux != '2020-12-31' && fecAux != '2021-1-1') {
                    if (fec1.getDay() != 0 && fec1.getDay() != 6) {
                        cantDays++;
                    }
    
                    if ((fec1.getDay() == 0 || fec1.getDay() == 6) && fecCuenta == 'S') {
                        cantDays++;
                    }
                }

                fec1.setDate(fec1.getDate() + 1);
            }

            if (cantDays == 0) {
                cantDays = 1;
            }

            fecCant.value   = cantDays;
        } else {
            alert('La FECHA RETORNO no puede ser menor que ' + fecDesde.value);
            fecHasta.value = fecDesde.value;
        }
//    } else {
//        alert('La FECHA INICIO no puede ser Sábado o Domingo. Verifique!');
//        fecDesde.value = '';
//        fecHasta.value = '';
//        fecDesde.focus();
//    }
}

function cantHora(){
    var fecDesde    = document.getElementById('var02');
    var fecHasta    = document.getElementById('var03');
    var horDesde    = document.getElementById('var05');
    var horHasta    = document.getElementById('var06');
    var horCant     = document.getElementById('var07');

    var fec1        = new Date(fecDesde.value + ' ' + horDesde.value);
    var fec2        = new Date(fecDesde.value + ' ' + horHasta.value);

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
    var inpAdj1 = document.getElementById('var08_1');
    var titAdj1 = document.getElementById('tit08_1');
    var inpAdj2 = document.getElementById('var08_2');
    var titAdj2 = document.getElementById('tit08_2');
    var inpAdj3 = document.getElementById('var08_3');
    var titAdj3 = document.getElementById('tit08_3');
    var inpVaP  = document.getElementById('var10');
    var titVaP  = document.getElementById('tit10');
    var inpVaC  = document.getElementById('var10_1');
    var titVaC  = document.getElementById('tit10_1');
    var inpVaD  = document.getElementById('var10_2');
    var titVaD  = document.getElementById('tit10_2');

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
                inpAdj1.readOnly     = true;
                inpAdj2.readOnly     = true;
                inpAdj3.readOnly     = true;

                inpAdj1.required     = true;
                inpAdj2.required     = true;
                inpAdj3.required     = true;

                titAdj1.style.display= '';
                titAdj2.style.display= '';
                titAdj3.style.display= '';
            } else {
                inpAdj1.readOnly     = false;
                inpAdj2.readOnly     = false;
                inpAdj3.readOnly     = false;

                inpAdj1.required     = false;
                inpAdj2.required     = false;
                inpAdj3.required     = false;

                titAdj1.style.display= 'none';
                titAdj2.style.display= 'none';
                titAdj3.style.display= 'none';
            }
        }

        if (inpSol.value == 22){
            inpVaP.style.display= 'none';
            titVaP.style.display= 'none';
            inpVaC.style.display= 'none';
            titVaC.style.display= 'none';
            inpVaD.style.display= 'none';
            titVaD.style.display= 'none';
        } else {
            inpVaP.style.display= 'none';
            titVaP.style.display= 'none';
            inpVaC.style.display= 'none';
            titVaC.style.display= 'none';
            inpVaD.style.display= 'none';
            titVaD.style.display= 'none';
        }
    });
}

function valVacacion(var01, var02) {
    var inpVaD  = document.getElementById('var10_1');
    var inpVaP  = document.getElementById('var10_2');
    var xJSON   = getVacacion(var01, var02);

    var canVaD  = 0;
    var canVaP  = 0;

    xJSON.forEach(element => {
        canVaD  = element.vacacion_cantidad_dia;
        canVaP  = element.vacacion_cantidad_restante;
    });

    inpVaD.value = canVaD;
    inpVaP.value = canVaP;
}

function getSolicitudes() {
    if (localStorage.getItem('solicitudesAllJSON') === null){
        getJSON('solicitudesAllJSON', '200/solicitudes');
    }

    var xJSON = JSON.parse(localStorage.getItem('solicitudesAllJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA;
}

function getSolicitudAll(var01) {
    var xJSON = JSON.parse(localStorage.getItem('solicitudesJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        if (var01 == 5) {
            xJSON['data'].forEach(element => {
                if (element.solicitud_estado_codigo == 'I') {
                    xDATA.push(element);
                }
            });
        } else {
            xJSON['data'].forEach(element => {
                xDATA.push(element);
            });
        }
    }

    return xDATA;
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

function getComprobante(codElem){
    if (localStorage.getItem('comprobanteJSON') === null){
        getJSON('comprobanteJSON', '200/comprobante');
    }

    var xJSON = JSON.parse(localStorage.getItem('comprobanteJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if (element.comprobante_documento == codElem) {
                xDATA.push(element);
            }
        });
    }

    return xDATA;
}

function getComprobanteId(codDoc){
    if (localStorage.getItem('comprobanteIdJSON') === null){
        getJSON('comprobanteIdJSON', '200/comprobante/documento/'+codDoc);
    }

    var xJSON = JSON.parse(localStorage.getItem('comprobanteIdJSON'));
    var xDATA = [];
    var minPer= 9999;
    var maxPer= 0;

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if (element.comprobante_documento == codDoc) {
                if (element.comprobante_periodo < minPer) {
                    minPer = element.comprobante_periodo;
                }

                if (element.comprobante_periodo > maxPer) {
                    maxPer = element.comprobante_periodo;
                }

                xDATA.push(element);
            }
        });
    } else {
        xJSON['data'].forEach(element => {
            if (element.comprobante_periodo < minPer) {
                minPer = element.comprobante_periodo;
            }

            if (element.comprobante_periodo > maxPer) {
                maxPer = element.comprobante_periodo;
            }

            xDATA.push(element);
        });
    }

    for (let index = 0; index <= (maxPer - minPer); index++) {
        var aDATA = {
            comprobante_codigo: '', 
            comprobante_codigo_barra: '',
            comprobante_adjunto: '', 
            tipo_estado_codigo: 999, 
            tipo_estado_castellano: '', 
            tipo_comprobante_castellano: '', 
            comprobante_periodo: (minPer + index), 
            tipo_mes_codigo: 999, 
            tipo_mes_castellano: '', 
            comprobante_observacion: '' 
        };
        xDATA.push(aDATA);
    }

    return xDATA;
}

function getComprobanteAll(codCom, codPer, codMeD, codMeH, codGer, codDep, codDoc, codEst){
    localStorage.removeItem('comprobanteJSON');

    if (localStorage.getItem('comprobanteJSON') === null){
        getJSON('comprobanteJSON', '200/comprobante/periodo/'+ codCom + '/'+ codPer +'/'+ codMeD +'/'+ codMeH);
    }

    var xJSON = JSON.parse(localStorage.getItem('comprobanteJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if (element.tipo_comprobante_codigo == codCom && element.comprobante_periodo == codPer && element.tipo_mes_codigo >= codMeD && element.tipo_mes_codigo <= codMeH) {
                if (codGer == 0) {
                    if (codDep == 0) {
                        if (codDoc == 0) {
                            if (codEst == 0) {
                                xDATA.push(element);
                            } else {
                                if (element.tipo_estado_codigo == codEst) {
                                    xDATA.push(element);
                                }
                            }
                        } else {
                            if (element.comprobante_documento == codDoc) {
                                if (codEst == 0) {
                                    xDATA.push(element);
                                } else {
                                    if (element.tipo_estado_codigo == codEst) {
                                        xDATA.push(element);
                                    }
                                }
                            }
                        }
                    } else {
                        if (element.tipo_departamento_codigo == codDep) {
                            if (codDoc == 0) {
                                if (codEst == 0) {
                                    xDATA.push(element);
                                } else {
                                    if (element.tipo_estado_codigo == codEst) {
                                        xDATA.push(element);
                                    }
                                }
                            } else {
                                if (element.comprobante_documento == codDoc) {
                                    if (codEst == 0) {
                                        xDATA.push(element);
                                    } else {
                                        if (element.tipo_estado_codigo == codEst) {
                                            xDATA.push(element);
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if (element.tipo_gerencia_codigo == codGer) {
                        if (codDep == 0) {
                            if (codDoc == 0) {
                                if (codEst == 0) {
                                    xDATA.push(element);
                                } else {
                                    if (element.tipo_estado_codigo == codEst) {
                                        xDATA.push(element);
                                    }
                                }
                            } else {
                                if (element.comprobante_documento == codDoc) {
                                    if (codEst == 0) {
                                        xDATA.push(element);
                                    } else {
                                        if (element.tipo_estado_codigo == codEst) {
                                            xDATA.push(element);
                                        }
                                    }
                                }
                            }
                        } else {
                            if (element.tipo_departamento_codigo == codDep) {
                                if (codDoc == 0) {
                                    if (codEst == 0) {
                                        xDATA.push(element);
                                    } else {
                                        if (element.tipo_estado_codigo == codEst) {
                                            xDATA.push(element);
                                        }
                                    }
                                } else {
                                    if (element.comprobante_documento == codDoc) {
                                        if (codEst == 0) {
                                            xDATA.push(element);
                                        } else {
                                            if (element.tipo_estado_codigo == codEst) {
                                                xDATA.push(element);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });
    }

    return xDATA;
}

function getTipoGerencia(){
    if (localStorage.getItem('tipoGerenciaJSON') === null){
        getJSON('tipoGerenciaJSON', '000/gerencia');
    }

    var xJSON = JSON.parse(localStorage.getItem('tipoGerenciaJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getTipoDepartamento(var01){
    if (localStorage.getItem('tipoDepartamentoJSON') === null){
        getJSON('tipoDepartamentoJSON', '000/departamento');
    }

    var xJSON = JSON.parse(localStorage.getItem('tipoDepartamentoJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            if (var01 == 0) {
                xDATA.push(element);
            } else if (var01 == element.tipo_gerencia_codigo) {
                xDATA.push(element);
            }
        });
    }

    return xDATA; 
}

function getColaborador(var01, var02){
    if (localStorage.getItem('colaboradorJSON') === null){
        getJSON('colaboradorJSON', '000/colaborador');
    }

    var xJSON = JSON.parse(localStorage.getItem('colaboradorJSON'));
    var xDATA = [];
       
    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            if (var01 == 0) {
                if (var02 == 0) {
                    xDATA.push(element);
                } else if (var02 == element.departamento_codigo) {
                    xDATA.push(element);
                }
            } else if (var01 == element.gerencia_codigo) {
                if (var02 == 0) {
                    xDATA.push(element);
                } else if (var02 == element.departamento_codigo) {
                    xDATA.push(element);
                }
            }
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
    if (localStorage.getItem('tipoSolicitudJSON') === null){
        getJSON('tipoSolicitudJSON', '100/solicitud');
    }

    var xJSON = JSON.parse(localStorage.getItem('tipoSolicitudJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200){
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA; 
}

function getMarcacion(codElem){
    if (localStorage.getItem('marcacionJSON') === null){
        getJSON('marcacionJSON', '000/marcacion/colaborador/'+codElem);
    }

    var xJSON = JSON.parse(localStorage.getItem('marcacionJSON'));
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

function getDominio(codDom){
    if (localStorage.getItem('dominioJSON') === null){
        getJSON('dominioJSON', '100/dominio');
    }

    var xJSON = JSON.parse(localStorage.getItem('dominioJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if (element.tipo_dominio == codDom) {
                xDATA.push(element);
            }
        });
    }

    return xDATA;
}

function getADominio(codDom, codElem){
    if (localStorage.getItem('dominioAJSON'+codDom) === null){
        getJSON('dominioAJSON'+codDom, '100/auditoria/'+codDom);
    }

    var xJSON = JSON.parse(localStorage.getItem('dominioAJSON'+codDom));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if (element.tipo_codigo == codElem) {
                xDATA.push(element);
            }
        });
    }

    return xDATA;
}

function getVacacion(codAnhio){
    if (localStorage.getItem('vacacionJSON') === null){
        getJSON('vacacionJSON', '000/vacacion');
    }

    var xJSON = JSON.parse(localStorage.getItem('vacacionJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if (element.vacacion_periodo == codAnhio) {
                xDATA.push(element);
            }
        });
    }

    return xDATA;
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
        '               <div id="tit10" class="col-sm-12 col-md-4">'+
        '                   <div class="form-group">'+
        '                       <label for="var10">PERIODO</label>'+
        '                       <input id="var10" name="var10" value="2018" min="2018" class="form-control" type="hidden" style="text-transform:uppercase; height:40px;" onblur="valVacacion('+ docFunc +', this.value);">'+
        '                   </div>'+
        '               </div>'+
        '               <div id="tit10_1" class="col-sm-12 col-md-4">'+
        '                   <div class="form-group">'+
        '                       <label for="var10_1">CORRESPONDIENTE</label>'+
        '                       <input id="var10_1" name="var10_1" class="form-control" type="hidden" style="text-transform:uppercase; height:40px;" readonly>'+
        '                   </div>'+
        '               </div>'+
        '               <div id="tit10_2" class="col-sm-12 col-md-4">'+
        '                   <div class="form-group">'+
        '                       <label for="var10_2">DISPONIBLE</label>'+
        '                       <input id="var10_2" name="var10_2" class="form-control" type="hidden" style="text-transform:uppercase; height:40px;" readonly>'+
        '                   </div>'+
        '               </div>'+
        '           </div>'+
        '           <div class="row pt-3">'+
        '               <div id="tit02" class="col-sm-12 col-md-4">'+
        '                   <div class="form-group">'+
        '                       <label for="var02">FECHA INICIO</label>'+
        '                       <input id="var02" name="var02" class="form-control" type="date" value="'+fecIni+'" onblur="cantFecha();" style="text-transform:uppercase; height:40px;" placeholder="FECHA DESDE" required>'+
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
        '                <div id="tit08_1" class="col-sm-12 col-md-4">'+
        '                    <div class="form-group">'+
        '                       <label for="var08_1">ADJUNTO 1</label>'+
        '                       <input id="var08_1" name="var08_1" class="form-control-file" type="file" style="text-transform:uppercase; height:40px;">'+
        '                    </div>'+
        '                </div>'+
        '           </div>'+
        '           <div class="row pt-3">'+
        '                <div id="tit08_2" class="col-sm-12 col-md-4">'+
        '                    <div class="form-group">'+
        '                       <label for="var08_2">ADJUNTO 2</label>'+
        '                       <input id="var08_2" name="var08_2" class="form-control-file" type="file" style="text-transform:uppercase; height:40px;">'+
        '                    </div>'+
        '                </div>'+
        '           </div>'+
        '           <div class="row pt-3">'+
        '                <div id="tit08_3" class="col-sm-12 col-md-4">'+
        '                    <div class="form-group">'+
        '                       <label for="var08_3">ADJUNTO 3</label>'+
        '                       <input id="var08_3" name="var08_3" class="form-control-file" type="file" style="text-transform:uppercase; height:40px;">'+
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

    $('#var002').change(function() {
        
    });
}

function getColaboradorId(codDocu){
    if (localStorage.getItem('ColaboradorJSON') === null){
        getJSON('ColaboradorJSON', '000/colaborador/' + codDocu);
    }

    var xJSON = JSON.parse(localStorage.getItem('ColaboradorJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA;
}

function getTPersonaAll(codEst, codGer, codDep, codCol){
    if (localStorage.getItem('tpersonaJSON') === null){
        getJSON('tpersonaJSON', '200/tarjetapersonal/listado');
    }

    var xJSON = JSON.parse(localStorage.getItem('tpersonaJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if(element.tipo_estado_codigo == codEst){
                if(codGer == 0){
                    if(codDep == 0){
                        if(codCol == 0){
                            xDATA.push(element);
                        } else if(element.tarjeta_personal_documento == codCol){
                            xDATA.push(element);
                        }

                    } else if(element.tipo_departamento_codigo == codDep){
                        if(codCol == 0){
                            xDATA.push(element);
                        } else if(element.tarjeta_personal_documento == codCol){
                            xDATA.push(element);
                        }
                    }

                } else if(element.tipo_gerencia_codigo == codGer){
                    if(codDep == 0){
                        if(codCol == 0){
                            xDATA.push(element);
                        } else if(element.tarjeta_personal_documento == codCol){
                            xDATA.push(element);
                        }

                    } else if(element.tipo_departamento_codigo == codDep){
                        if(codCol == 0){
                            xDATA.push(element);
                        } else if(element.tarjeta_personal_documento == codCol){
                            xDATA.push(element);
                        }
                    }
                }
            }
        });
    }

    return xDATA;
}

function getTPersonaId(codElem){
    if (localStorage.getItem('tpersonaJSON') === null){
        getJSON('tpersonaJSON', '200/tarjetapersonal/listado');
    }

    var xJSON = JSON.parse(localStorage.getItem('tpersonaJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            if (element.tarjeta_personal_codigo == codElem) {
                xDATA.push(element);
            }
        });
    }
    
    return xDATA;
}

function getTPersonalDocumento(codDocu){
    if (localStorage.getItem('tpersonalDocumentoJSON') === null){
        getJSON('tpersonalDocumentoJSON', '200/tarjetapersonal/documento/'+ codDocu);
    }

    var xJSON = JSON.parse(localStorage.getItem('tpersonalDocumentoJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }
    
    return xDATA;
}

function getTPersonalUltimo(codDocu){
    if (localStorage.getItem('tpersonalUltimoJSON') === null){
        getJSON('tpersonalUltimoJSON', '200/tarjetapersonal/ultimo/'+ codDocu);
    }

    var xJSON = JSON.parse(localStorage.getItem('tpersonalUltimoJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }
    
    return xDATA;
}

function getTPersonalPrefijoId(codElem){
    if (localStorage.getItem('tpersonalPrefijoJSON') === null){
        getJSON('tpersonalPrefijoJSON', '200/tarjetapersonal/telefonoprefijo/codigo/'+ codElem);
    }
    
    var xJSON = JSON.parse(localStorage.getItem('tpersonalPrefijoJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
                xDATA.push(element);
        });
    }
    
    return xDATA;
}

function getTPersonalPrefijoDocumento(codElem){
    if (localStorage.getItem('tpersonalPrefijoJSON') === null){
        getJSON('tpersonalPrefijoJSON', '200/tarjetapersonal/telefonoprefijo/documento/'+ codElem);
    }
    
    var xJSON = JSON.parse(localStorage.getItem('tpersonalPrefijoJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }
    
    return xDATA;
}

function getTPersonalPrefijoTPersonal(codElem){
    if (localStorage.getItem('tpersonalPrefijoJSON') === null){
        getJSON('tpersonalPrefijoJSON', '200/tarjetapersonal/telefonoprefijo/tarjetapersonal/'+ codElem);
    }
    
    var xJSON = JSON.parse(localStorage.getItem('tpersonalPrefijoJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }
    
    return xDATA;
}

function getTPersonalRSocialDocumento(codElem){
    if (localStorage.getItem('tpersonalRSocialJSON') === null){
        getJSON('tpersonalRSocialJSON', '200/tarjetapersonal/redsocial/documento/'+ codElem);
    }

    var xJSON = JSON.parse(localStorage.getItem('tpersonalRSocialJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA;
}

function getTPersonalRSocialTPersonal(codElem){
    if (localStorage.getItem('tpersonalRSocialJSON') === null){
        getJSON('tpersonalRSocialJSON', '200/tarjetapersonal/redsocial/tarjetapersonal/'+ codElem);
    }

    var xJSON = JSON.parse(localStorage.getItem('tpersonalRSocialJSON'));
    var xDATA = [];

    if (xJSON['code'] == 200) {
        xJSON['data'].forEach(element => {
            xDATA.push(element);
        });
    }

    return xDATA;
}

function getQR(var01){
    var html     =
        '<div style="width:auto;">'+
        '   <div class="card" style="background-color:transparent;">'+
        '       <div class="el-card-item">'+
        '           <div class="el-card-avatar el-overlay-1"> <img src="http://permisos.conmebol.com/uploads/perfil/'+var01+'.png" alt="user" />'+
        '           </div>'+
        '       </div>'+
        '   </div>'+
        '</div>';
    $("#modalcontent").empty();
    $("#modalcontent").append(html);
}

function buscaQR(var02){    
    var codQR = document.getElementById(var02);
    var imgQR = document.getElementById('imgView');
    imgQR.style.display = '';
    imgQR.src = 'http://permisos.conmebol.com/uploads/perfil/'+codQR.value+'.png';
}

function setEstado(rowSel, rowEst, rowAcc, rowFun, rowCar, rowPage){
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

        case 6:
            titEst  = 'Modificar Autorizante';
            colEst  = '#6c757d;';
            colBtn  = 'btn-secondary';
            titMen  = '';
            rowEst  = 'I';
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

        case 3:
            rowAcc = 'X';
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
                    '               <input id="workPage" name="workPage" value="'+ rowPage +'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
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
                    if (rowAcc == 'X') {
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
                            '               <input id="workPage" name="workPage" value="'+ rowPage +'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                            '               <input id="var01" name="var01" value="'+rowEst+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                            '           </div>'+
                            '           <div class="row">'+
                            '               <div class="col-sm-12">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var03">DOCUMENTO DEL AUTORIZANTE</label>'+
                            '                       <input id="var03" name="var03" class="form-control" type="text" style="text-transform:uppercase; height:40px;" required>'+
                            '                    </div>'+
                            '               </div>'+
                            '               <div class="col-sm-12">'+
                            '                   <div class="form-group">'+
                            '                       <label for="var02">COMENTARIO</label>'+
                            '                       <textarea id="var02" name="var02" class="form-control" rows="3" style="text-transform:uppercase;" required></textarea>'+
                            '                   </div>'+
                            '               </div>'+
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
                            '   <form id="form" data-parsley-validate method="post" action="../class/crud/solicitudes_estado.php">'+
                            '	    <div class="modal-header" style="color:#fff; background:'+colEst+';">'+
                            '		    <h4 class="modal-title" id="vcenter"> '+titEst+' </h4>'+
                            '		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                            '	    </div>'+
                            '	    <div class="modal-body" >'+
                            '           <div class="form-group">'+
                            '               <input id="workCodigo" name="workCodigo" value="'+codRow.id+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                            '               <input id="workAccion" name="workAccion" value="'+rowAcc+'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
                            '               <input id="workPage" name="workPage" value="'+ rowPage +'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
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
                    }
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
                '               <input id="workPage" name="workPage" value="'+ rowPage +'" class="form-control" type="hidden" placeholder="Codigo" required readonly>'+
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

function selectSolicitud(var01) {
    var xJSON       = getTipoSolicitud();
    var selOption   = document.getElementById(var01);
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    xJSON.forEach(element => {
        if (element.tipo_estado_codigo == 'A'){
            var option      = document.createElement('option');
            option.value    = element.tipo_permiso_codigo;
            option.text     = element.tipo_solicitud_nombre + ' - ' + element.tipo_permiso_nombre;
            selOption.add(option, null);
        }
    });
}

function selectEstado(var01) {
    var selOption   = document.getElementById(var01);
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    var option  = document.createElement('option');
    option.value    = 'T';
    option.text     = 'TODOS';
    option.selected = true;
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'I';
    option.text     = 'INGRESADO';
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'A';
    option.text     = 'AUTORIZADO';
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'P';
    option.text     = 'APROBADO';
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'C';
    option.text     = 'ANULADO';
    selOption.add(option, null);
}

function selectMes(var01, var02) {
    var xJSON       = getDominio('SISTEMAMES');
	var selOption1	= document.getElementById(var01);
	var selOption2	= document.getElementById(var02);
    
    while (selOption1.length > 0) {
        selOption1.remove(0);
	}
	
	while (selOption2.length > 0) {
        selOption2.remove(0);
    }

    xJSON.forEach(element => {
        if (element.tipo_estado_codigo == 1){
            var option      = document.createElement('option');
            option.value    = element.tipo_codigo;
            option.text     = element.tipo_nombre_castellano;

            if (element.tipo_codigo == 24) {
                option.selected = true;
            }

            selOption1.add(option, null);
        }
    });

    xJSON.forEach(element => {
        if (element.tipo_estado_codigo == 1){
            var option      = document.createElement('option');
            option.value    = element.tipo_codigo;
            option.text     = element.tipo_nombre_castellano;

            if (element.tipo_codigo == 35) {
                option.selected = true;
            }

            selOption2.add(option, null);
        }
    });
}

function calCSS(totSOL, canTOT) {
    var retCSS  = '';
    var porSOL  = Math.round(((canTOT * 100) / totSOL));

    if(porSOL == 0){
        retCSS  = 'css-bar-0';
    } else if (porSOL > 0 && porSOL < 6) {
        retCSS  = 'css-bar-5';
    } else if (porSOL > 5 && porSOL < 11) {
        retCSS  = 'css-bar-10';
    } else if (porSOL > 10 && porSOL < 16) {
        retCSS  = 'css-bar-15';
    } else if (porSOL > 15 && porSOL < 21) {
        retCSS  = 'css-bar-20';
    } else if (porSOL > 20 && porSOL < 26) {
        retCSS  = 'css-bar-25';
    } else if (porSOL > 25 && porSOL < 31) {
        retCSS  = 'css-bar-30';
    } else if (porSOL > 30 && porSOL < 36) {
        retCSS  = 'css-bar-35';
    } else if (porSOL > 35 && porSOL < 41) {
        retCSS  = 'css-bar-40';
    } else if (porSOL > 40 && porSOL < 46) {
        retCSS  = 'css-bar-45';
    } else if (porSOL > 45 && porSOL < 51) {
        retCSS  = 'css-bar-50';
    } else if (porSOL > 50 && porSOL < 56) {
        retCSS  = 'css-bar-55';
    } else if (porSOL > 55 && porSOL < 61) {
        retCSS  = 'css-bar-60';
    } else if (porSOL > 60 && porSOL < 66) {
        retCSS  = 'css-bar-65';
    } else if (porSOL > 65 && porSOL < 71) {
        retCSS  = 'css-bar-70';
    } else if (porSOL > 70 && porSOL < 76) {
        retCSS  = 'css-bar-75';
    } else if (porSOL > 75 && porSOL < 81) {
        retCSS  = 'css-bar-80';
    } else if (porSOL > 80 && porSOL < 86) {
        retCSS  = 'css-bar-85';
    } else if (porSOL > 85 && porSOL < 91) {
        retCSS  = 'css-bar-90';
    } else if (porSOL > 90 && porSOL < 96) {
        retCSS  = 'css-bar-95';
    } else if (porSOL > 95 && porSOL < 101) {
        retCSS  = 'css-bar-100';
    }

    return retCSS;
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}