$(document).ready(function() {
    var codEst		= document.getElementById('var01').value;
	var codGer		= document.getElementById('var02').value;
	var codDep		= document.getElementById('var03').value;
	var codCol		= document.getElementById('var04').value;
	var dataJSON	= getTPersonaAll(codEst, codGer, codDep, codCol);

	$('#tableLoad').DataTable({
		processing	: true,
		destroy		: true,
		searching	: true,
		paging		: true,
		lengthChange: true,
		info		: true,
		order: [[0, "desc"]],
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
            { targets			: [1],	visible : true, searchable : true,	orderData : [1, 0] },
        ],
		
		columns		: [
            { data				: 'tarjeta_personal_codigo', name : 'tarjeta_personal_codigo'},
            { render			: 
				function (data, type, full, meta) {
                    var rowVCARD    = '';
					var rowVIEW     = '';
					
                    rowVIEW = rowVIEW + '<div class="row" style="height:200px;">';
                    rowVIEW = rowVIEW + '<div class="col-sm-9">';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Código Solicitud:</span> ' + full.tarjeta_personal_codigo;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Estado Solicitud:</span> ' + full.tipo_estado_castellano;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Fecha Solicitud:</span> ' + full.auditoria_fecha_hora;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Cargo Solicitud:</span> ' + full.tipo_cargo_nombre;
					rowVIEW = rowVIEW + '<br>';
					rowVIEW = rowVIEW + '<span style="font-weight:bold;">Colaborador Solicitud:</span> ' + full.tarjeta_personal_nombre;
					rowVIEW = rowVIEW + '<br>';
					rowVIEW = rowVIEW + '<span style="font-weight:bold;">Documento Solicitud:</span> ' + full.tarjeta_personal_documento;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Cantidad Solicitud:</span> ' + full.tipo_cantidad_castellano;
					rowVIEW = rowVIEW + '<br>';
					rowVIEW = rowVIEW + '<div class="row" style="position:absolute; bottom:0px;">';
					rowVIEW = rowVIEW + '<button onclick="setTPersonal('+ full.tarjeta_personal_codigo +', 2);" type="button" class="btn btn-primary" style="margin-right:5px;" data-toggle="modal" data-target="#modaldiv" title="Ver"><i class="fa fa-eye"></i></button>';

					if (full.tipo_estado_parametro == 1){
						rowVIEW = rowVIEW + '<button onclick="setTPersonal('+ full.tarjeta_personal_codigo +', 3);" type="button" class="btn btn-success" style="margin-right:5px;" data-toggle="modal" data-target="#modaldiv" title="Generar"><i class="fa fa-check-square"></i></button>';
						rowVIEW = rowVIEW + '<button onclick="setTPersonal('+ full.tarjeta_personal_codigo +', 4);" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldiv" title="Anular"><i class="fa fa-window-close"></i></button>';
					}

					rowVIEW = rowVIEW + '</div>';
                    rowVIEW = rowVIEW + '</div>';
                    rowVIEW = rowVIEW + '<div class="col-sm-3 center">';
//                    rowVIEW = rowVIEW + '<img style="float:right;" src="https://api.qrserver.com/v1/create-qr-code/?data='+ encodeURIComponent(rowVCARD) +'&size=200x200" />';
                    rowVIEW = rowVIEW + '</div>';
                    rowVIEW = rowVIEW + '</div>';
                    
					return rowVIEW;	
				}
			},
		]
	});
	
   	$('.form-group').change(function() {
		var codEst		= document.getElementById('var01').value;
		var codGer		= document.getElementById('var02').value;
		var codDep		= document.getElementById('var03').value;
		var codCol		= document.getElementById('var04').value;
		var xDATA		= getTPersonaAll(codEst, codGer, codDep, codCol);
		var tableData   = $('#tableLoad').DataTable();

		tableData.clear().rows.add(xDATA).draw();
    });
});