function getVCARD(codDoc){
    var xJSON1  = getTPersonalUltimo(codDoc);
    var xJSON2  = getTPersonalPrefijoDocumento(codDoc);
    var xJSON3  = getTPersonalRSocialDocumento(codDoc);
    var bodyTit = 'NUEVO';
    var bodyCol = '#163562;';
    var bodyMod = 'R';
    var bodyOnl = '';
    var bodyBot = '           <button type="submit" class="btn text-center text-white" style="background-color:'+ bodyCol +'">Generar Solicitud</button>';
    var rowVCARD= '';
    var rowTef  = '';
    var html    = '';
    var hWindows= window.innerWidth;
    var wWindows= document.body.clientWidth;

    xJSON1.forEach(element => {
        var vcardTEL = '';
        var vcardURL = '';

        xJSON2.forEach(element1 => {
            if(element1.tarjeta_personal_codigo == element.tarjeta_personal_codigo && element1.tarjeta_personal_telefono_visualizar == 'S'){
                vcardTEL= element1.tarjeta_personal_telefono_completo;
                rowTef  = '                       <span style="color:#205aa7;"> <i class="fa fa-mobile-alt" style="color:#74b8e5;"></i>&nbsp;&nbsp;&nbsp;&nbsp;'+ element1.tarjeta_personal_telefono_completo +' </span>';
            }  
        });

        xJSON3.forEach(element1 => {
            if(element1.tarjeta_personal_codigo == element.tarjeta_personal_codigo && element1.tarjeta_personal_red_social_visualizar == 'S'){
                vcardURL = element1.tarjeta_personal_red_social_direccion;
            }  
        });

        rowVCARD = rowVCARD + 
            'BEGIN:VCARD' + "\n" + 
            'VERSION:3.0' + "\n" + 
            'N:' + element.tarjeta_personal_nombre + "\n" + 
            'FN:' + element.tarjeta_personal_nombre + "\n" +
            'ORG:Confederación Sudamericana de Fútbol - CONMEBOL' + "\n" +
            'ADR;TYPE=WORK:Autopista Silvio Pettirossi y Valois Rivarola - Luque - Paraguay ' + "\n" +
            'ROLE:' + element.tipo_cargo_nombre + "\n" + 
            'EMAIL;TYPE=WORK:' + element.tarjeta_personal_email + "\n" + 
            'TEL;TYPE=WORK;CELL:' + vcardTEL + "\n" +
            'URL:' + vcardURL + "\n" +
            'END:VCARD';

        if (wWindows < 700){
            html    =
                '<div class="modal-content" style="text-align:center; border-radius:20px;">'+
                '   <form id="form" data-parsley-validate method="post" enctype="multipart/form-data" action="javascript:void(0);">'+
                '	    <div class="modal-body">'+
                '           <div class="row">'+
                '               <div class="col-sm-12">'+
                '                   <div class="form-group" style="margin-bottom:0px;">'+
                `                       <img src="../assets/images/logo_index_3.png" style="background-position:center; background-repeat:no-repeat; background-size:contain; height:100px;" />`+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12">'+
                '                   <div class="form-group">'+
                '                       <span style="font-size:1.50rem; color:#205aa7; font-weight: bold;"> '+ element.tarjeta_personal_nombre +' </span>' +
                '<br>'+
                '                       <span style="font-size:1rem; color:#205aa7;"> '+ element.tipo_cargo_nombre +' </span>' +
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12" style="margin-bottom:0px;">'+
                '                   <div class="form-group" style="font-size:0.75rem !important;">'+
                '                       <span style="color:#205aa7;"> <i class="fa fa-envelope" style="color:#74b8e5;"></i>&nbsp;&nbsp;&nbsp;'+ element.tarjeta_personal_email +' </span>' +
                '<br>'+
                '                       <span style="color:#205aa7;"> <i class="fa fa-phone" style="color:#74b8e5; transform:rotate(90deg);"></i>&nbsp;&nbsp;&nbsp;+595 215172000 </span>' +
                '<br>' + rowTef +
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12" style="margin-bottom:1rem;">'+
                '                   <div class="form-group" style="margin-bottom:0px;">'+
                '                       <img src="https://api.qrserver.com/v1/create-qr-code/?data='+ encodeURIComponent(rowVCARD) +'&size=200x200&color=32-90-167" />'+
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12">'+
                '                   <div class="form-group">'+
                '                       <span style="font-size:0.75rem; color:#205aa7; text-align:center; padding:0px 90px; display:block;"> Autopista Silvio Pettirossi y Valois Rivarola. Luque, Paraguay. </span>' +
                '<br>'+
                '                       <span style="font-size:1rem; color:#205aa7; font-weight:bold;"> www.conmebol.com </span>' +
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
        } else {
            html    =
                `<div class="modal-content" style="background-image:url('../assets/images/background/tarjeta_personal.png'); background-position:left; background-repeat:no-repeat; background-size:contain; border-radius:20px;">`+
                '   <form id="form" data-parsley-validate method="post" enctype="multipart/form-data" action="javascript:void(0);">'+
                '	    <div class="modal-body">'+
                '           <div class="row" style="margin-left:250px;">'+
                '               <div class="col-sm-12">'+
                '                   <div class="form-group">'+
                '                       <span style="font-size:3.0rem; color:#205aa7; font-weight: bold;"> '+ element.tarjeta_personal_nombre +' </span>' +
                '<br>'+
                '                       <span style="font-size:1.75rem; color:#205aa7;"> '+ element.tipo_cargo_nombre +' </span>' +
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12" style="margin-bottom:1rem;">'+
                '                   <div class="form-group" style="font-size:1.0rem;">'+
                '                       <span style="color:#205aa7;"> <i class="fa fa-envelope" style="color:#74b8e5;"></i>&nbsp;&nbsp;&nbsp;'+ element.tarjeta_personal_email +' </span>' +
                '<br>'+
                '                       <span style="color:#205aa7;"> <i class="fa fa-phone" style="color:#74b8e5; transform:rotate(90deg);"></i>&nbsp;&nbsp;&nbsp;+595 215172000 </span>' +
                '<br>' + rowTef +
                '                   </div>'+
                '               </div>'+
                ''+
                '               <div class="col-sm-12">'+
                '                   <div class="row">'+
                '                       <div class="col-sm-6">'+
                '                           <div class="form-group" style="margin-bottom:0px;">'+
                '                               <img src="https://api.qrserver.com/v1/create-qr-code/?data='+ encodeURIComponent(rowVCARD) +'&size=200x200&color=32-90-167" />'+
                '                           </div>'+
                '                       </div>'+
                '                   </div>'+
                '               </div>'+
                '           </div>'+
                '	    </div>'+
                '   </form>'+
                '</div>';
        }
    });

    $("#modalcontent").empty();
    $("#modalcontent").append(html);
}