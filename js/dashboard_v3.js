$(document).ready(function() {
   
    var codEst		= document.getElementById('var01').value;
	var codGer		= document.getElementById('var02').value;
	var codDep		= document.getElementById('var03').value;
	var codCol		= document.getElementById('var04').value;
	var dataJSON	= getTPersonaAll(codEst, codGer, codDep, codCol);
//	var dataJSON1	= getTPersonalPrefijo(_parm05BASE);

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
/*
					var rowTEFL		= '';
					dataJSON1		= getTPersonalPrefijoCodigo(full.tarjeta_personal_codigo);

					dataJSON1.forEach(element1 => {
						if (element1.tarjeta_personal_telefono_visualizar == 'S'){
							rowTEFL = rowTEFL + 'TEL;TYPE=WORK;CELL:+' + element1.tarjeta_personal_telefono_completo + "\n";
						}
					});
	
                    rowVCARD = rowVCARD + 
                    'BEGIN:VCARD' + "\n" + 
                    'VERSION:3.0' + "\n" + 
                    'N:' + full.tarjeta_personal_nombre + "\n" + 
                    'FN:' + full.tarjeta_personal_nombre + "\n" +
                    'ORG:Confederación Sudamericana de Fútbol - CONMEBOL' + "\n" + 
                    'ADR;TYPE=WORK:Autopista Silvio Pettirossi y Valois Rivarola - Luque - Paraguay' + "\n" +
                    'ROLE:' + full.tipo_cargo_nombre + "\n" + 
                    'TITLE:' + full.tipo_cargo_nombre + "\n" +
                    'TEL;TYPE=WORK;VOICE:+595215172000' + "\n" + rowTEFL +
                    'EMAIL;TYPE=WORK:' + full.tarjeta_personal_email + "\n" + 
                    'URL:https://www.conmebol.com/' + "\n" + 
                    'END:VCARD';
*/
                    rowVIEW = rowVIEW + '<div class="row" style="height:200px;">';
                    rowVIEW = rowVIEW + '<div class="col-sm-10">';
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
                    rowVIEW = rowVIEW + '<div class="col-sm-2">';
                    rowVIEW = rowVIEW + '<div id="qrcode'+ full.tarjeta_personal_codigo +'" style="float:right;">';
                    rowVIEW = rowVIEW + '</div>';
                    rowVIEW = rowVIEW + '</div>';
					rowVIEW = rowVIEW + '</div>';

//                    $('#qrcode'+ full.tarjeta_personal_codigo).html('<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=' + encodeURIComponent(rowVCARD) + '&choe=UTF-8" alt="QR code" />');
                    
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