$(document).ready(function() {
    var dataJSON = getTPersonalDocumento(_parm05BASE);

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

                    rowVCARD = rowVCARD + 
                    'BEGIN:VCARD' + "\n" + 
                    'VERSION:3.0' + "\n" + 
                    'N:' + full.tarjeta_personal_nombre + "\n" + 
                    'FN:' + full.tarjeta_personal_nombre + "\n" +
                    'ORG:Confederación Sudamericana de Fútbol - CONMEBOL' + "\n" + 
                    'ADR;TYPE=WORK:Autopista Silvio Pettirossi y Valois Rivarola - Luque - Paraguay' + "\n" +
                    'ROLE:' + full.tipo_cargo_nombre + "\n" + 
                    'TITLE:' + full.tipo_cargo_nombre + "\n" +
                    'TEL;TYPE=WORK;VOICE:+595215172000' + "\n" +
                    'TEL;TYPE=WORK;CELL:+' + "\n" + 
                    'TEL;TYPE=HOME;CELL:+' + "\n" + 
                    'EMAIL;TYPE=WORK:' + full.tarjeta_personal_email + "\n" + 
                    'URL:https://www.conmebol.com/' + "\n" + 
                    'END:VCARD';

                    rowVIEW = rowVIEW + '<div class="row">';
                    rowVIEW = rowVIEW + '<div class="col-sm-10">';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Código Solicitud:</span> ' + full.tarjeta_personal_codigo;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Estado Solicitud:</span> ' + full.tipo_estado_castellano;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Fecha Solicitud:</span> ' + full.auditoria_fecha_hora;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Cargo Solicitud:</span> ' + full.tipo_cargo_nombre;
                    rowVIEW = rowVIEW + '<br>';
                    rowVIEW = rowVIEW + '<span style="font-weight:bold;">Cantidad Solicitud:</span> ' + full.tipo_cantidad_castellano;
                    rowVIEW = rowVIEW + '</div>';
                    rowVIEW = rowVIEW + '<div class="col-sm-2">';
                    rowVIEW = rowVIEW + '<div id="qrcode'+ full.tarjeta_personal_codigo +'" style="float:right;">';
                    rowVIEW = rowVIEW + '</div>';
                    rowVIEW = rowVIEW + '</div>';
                    rowVIEW = rowVIEW + '</div>';

                    $('#qrcode'+ full.tarjeta_personal_codigo).html('<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=' + encodeURIComponent(rowVCARD) + '&choe=UTF-8" alt="QR code" />');
                    
					return rowVIEW;	
				}
			},
        ],
		createdRow : function( row, data, dataIndex ) {
			if (data['tipo_estado_parametro'] == 3) {        
				$(row).addClass('bg-danger text-white');
			}
		}
    });
});