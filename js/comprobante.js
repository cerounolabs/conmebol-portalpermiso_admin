$(document).ready(function() {
    var codDoc  = document.getElementById('tableCodigo').className;
	var dataJSON	= getComprobanteId(codDoc);
	
	$('#tableLoad').DataTable({
		processing	: true,
		destroy		: true,
		searching	: true,
		paging		: true,
		lengthChange: true,
		info		: true,
		order: [[ 0, "desc" ]],
		orderCellsTop: true,
		fixedHeader	: true,
		language	: {
            lengthMenu: "Mostrar _MENU_ registros por pagina",
            zeroRecords: "No hay registros disponibles.",
            info: "Mostrando pagina _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles.",
			infoFiltered: "(Filtrado de _MAX_ registros totales)",
			sZeroRecords: "No se encontraron resultados",
			sSearch: "buscar",
			oPaginate: {
				sFirst:    "Primero",
				sLast:     "Último",
				sNext:     "Siguiente",
				sPrevious: "Anterior"
			},
        },
		data		: dataJSON,
		columnDefs	: [
			{ targets			: [0],	visible : false,searchable : false,	orderData : [0, 0] },
			{ targets			: [1],	visible : true,	searchable : true,	orderData : [1, 0] },
			{ targets			: [2],	visible : true,	searchable : true,	orderData : [2, 0] },
			{ targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] },
			{ targets			: [4],	visible : true,	searchable : true,	orderData : [4, 0] },
			{ targets			: [5],	visible : true,	searchable : true,	orderData : [5, 0] }
		],
		columns		: [
            { data				: 'comprobante_codigo', name : 'comprobante_codigo'},
            { render			: function (data, type, full, meta) {
                var btn = '<a href="../uploads/comprobante/'+ full.comprobante_adjunto +'" id="'+ full.comprobante_codigo +'" onclick="setComprobanteEstado(this.id, 40);" target="_blank" role="button" class="btn btn-primary"><i class="ti-import"></i></a>';
                return btn;
			}},
			{ data				: 'tipo_estado_nombre', name : 'tipo_estado_nombre'},
			{ data				: 'tipo_comprobante_nombre', name : 'tipo_comprobante_nombre'},
			{ data				: 'comprobante_periodo', name : 'comprobante_periodo'},
			{ data				: 'tipo_mes_nombre', name : 'tipo_mes_nombre'},
			{ data				: 'comprobante_observacion', name : 'comprobante_observacion'},
		]
    });
});

function setComprobante(codElem, codAcc){
	var xJSON0      = getDominio('COMPROBANTETIPO');
    var xJSON1      = getDominio('SISTEMAMES');
	var xJSON2      = getColaborador(0, 0);
	var xJSON3      = getDominio('COMPROBANTEESTADO');
	var html        = '';
	var bodyCol     = '';
	var bodyTit     = '';
	var bodyMod     = '';
	var bodyOnl     = '';
	var bodyBot     = '';
    var selEstado   = '';
    var selCompb    = '';
    var selectMes   = '';
	var selColab    = '';
	var selCEst    	= '';
    var rowDominio	= '';

    selCompb    	= selCompb + '                               <option value="" selected disabled> SELECCIONAR... </option>';
    selectMes   	= selectMes + '                               <option value="" selected disabled> SELECCIONAR... </option>';
	selColab    	= selColab + '                               <option value="" selected disabled> SELECCIONAR... </option>';

	switch (codAcc) {
		case 1:
			bodyTit = 'PROCESAR';
			bodyCol = '#163562;';
			bodyMod = 'C';
			bodyOnl = '';
			bodyBot = '           <button type="submit" id="submit" name="submit" class="btn btn-info">Ejecutar</button>';
			break;

		case 2:
			bodyTit = 'VER';
			bodyCol = '#6929d5;';
			bodyMod = 'R';
			bodyOnl = 'readonly';
			bodyBot = '';
			break;

		case 3:
			bodyTit = 'EDITAR';
			bodyCol = '#007979;';
			bodyMod = 'U';
			bodyOnl = '';
			bodyBot = '           <button type="submit" class="btn btn-success">Actualizar</button>';
			break;

		case 4:
			bodyTit = 'ELIMINAR';
			bodyCol = '#ff2924;';
			bodyMod = 'D';
			bodyOnl = 'readonly';
			bodyBot = '           <button type="submit" class="btn btn-danger">Eliminar</button>';
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

	if (codAcc == 1) {
        xJSON0.forEach(element1 => {
            selCompb	= selCompb + '                               <option value="'+ element1.tipo_codigo +'"> '+ element1.tipo_nombre_castellano +' </option>';
        });

        xJSON1.forEach(element1 => {
            selectMes	= selectMes + '                               <option value="'+ element1.tipo_codigo +'"> '+ element1.tipo_nombre_castellano +' </option>';
        });

        xJSON2.forEach(element1 => {
            selColab	= selColab + '                               <option value="'+ element1.documento +'"> '+ element1.nombre_completo +' </option>';
		});
		
		xJSON3.forEach(element1 => {
			if (element1.tipo_codigo == 39) {
				selCEst		= selCEst + '                               <option value="'+ element1.tipo_codigo +'"> '+ element1.tipo_nombre_castellano +' </option>';
			}
        });

		html = 
			'<div class="modal-content">'+
			'   <form id="form" data-parsley-validate method="post" enctype="multipart/form-data" action="../class/crud/comprobante_masivo.php">'+
			'	    <div class="modal-header" style="color:#fff; background:'+ bodyCol +'">'+
			'		    <h4 class="modal-title" id="vcenter"> '+ bodyTit +' </h4>'+
			'		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
			'	    </div>'+
			'	    <div class="modal-body" >'+
			'           <div class="form-group">'+
			'               <input id="workCodigo" name="workCodigo" value="0" class="form-control" type="hidden" required readonly>'+
			'               <input id="workModo" name="workModo" value="'+ bodyMod +'" class="form-control" type="hidden" required readonly>'+
			'               <input id="workPage" name="workPage" value="comprobante" class="form-control" type="hidden" required readonly>'+
			'           </div>'+
			'           <div class="row pt-3">'+
			'               <div class="col-sm-12 col-md-6">'+
			'                   <div class="form-group">'+
			'                       <label for="var01">ESTADO</label>'+
			'                       <select id="var01" name="var01" class="select2 form-control custom-select" style="width:100%; height:40px;" '+ bodyOnl +'>'+
			'                           <optgroup label="Estado">'+ selCEst +
			'                           </optgroup>'+
			'                       </select>'+
			'                   </div>'+
			'               </div>'+
			'               <div class="col-sm-12 col-md-6">'+
			'                   <div class="form-group">'+
			'                       <label for="var02">COMPROBANTE</label>'+
            '                       <select id="var02" name="var02" class="select2 form-control custom-select" style="width:100%; height:40px;" required>'+
            '                           <optgroup label="Comprobrante">'+ selCompb +
            '                           </optgroup>'+
            '                       </select>'+
			'                   </div>'+
			'               </div>'+
			'               <div class="col-sm-12 col-md-6">'+
			'                   <div class="form-group">'+
			'                       <label for="var03">PERIODO</label>'+
			'                       <input id="var03" name="var03" value="" class="form-control" type="number" style="text-transform:uppercase; height:40px;" min="2019" max="2030" required '+ bodyOnl +'>'+
			'                   </div>'+
			'               </div>'+
			'               <div class="col-sm-12 col-md-6">'+
			'                   <div class="form-group">'+
			'                       <label for="var04">MES</label>'+
            '                       <select id="var04" name="var04" class="select2 form-control custom-select" style="width:100%; height:40px;" required>'+
            '                           <optgroup label="Mes">'+ selectMes +
            '                           </optgroup>'+
            '                       </select>'+
			'                   </div>'+
            '               </div>'+
			'               <div class="col-sm-12">'+
			'                   <div class="form-group">'+
			'                       <label for="var07">COMENTARIO</label>'+
			'                       <textarea id="var07" name="var07" value="" class="form-control" rows="5" style="text-transform:uppercase;" '+ bodyOnl +'></textarea>'+
			'                   </div>'+
			'               </div>'+
			'           </div>'+
			'	    </div>'+
			'	    <div class="modal-footer">'+ bodyBot +
			'		    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>'+
			'	    </div>'+
			'   </form>'+
			'</div>';
	} else if (codAcc > 1 && codAcc < 5) {

	} else if (codAcc == 5) {

	}

	$("#modalcontent").empty();
	$("#modalcontent").append(html);
}