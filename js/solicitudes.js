$(document).ready(function() {
	var codigo		= document.getElementById('tableCodigo').className;	
	var urlDominio	= 'http://api.conmebol.com/portalpermiso/public/v1/200/solicitud/'+codigo;

	$('#tableLoad').DataTable({
		processing	: true,
		destroy		: true,
		searching	: true,
		paging		: true,
		lengthChange: true,
		info		: true,
		orderCellsTop: false,
        fixedHeader	: false,
		language	: {
            lengthMenu: "Mostrar _MENU_ registros por pagina",
            zeroRecords: "Nothing found - sorry",
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
		ajax		: {
			type				: 'GET',
			cache				: false,
			crossDomain			: true,
			crossOrigin			: true,
			contentType			: 'application/json; charset=utf-8',
			dataType			: 'json',
			url				: urlDominio,
			dataSrc				: 'data'
		},
		columnDefs	: [
			{ targets			: [0],	visible : true,	searchable : true,	orderData : [0, 0] },
			{ targets			: [1],	visible : true,	searchable : true,	orderData : [1, 0] },
			{ targets			: [2],	visible : true,	searchable : true,	orderData : [2, 0] },
			{ targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] },
			{ targets			: [4],	visible : true,	searchable : true,	orderData : [4, 0] },
			{ targets			: [5],	visible : true,	searchable : true,	orderData : [5, 0] },
			{ targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] },
			{ targets			: [7],	visible : true,	searchable : true,	orderData : [7, 0] },
			{ targets			: [8],	visible : true,	searchable : true,	orderData : [8, 0] }
		],
		columns		: [
			{ data				: 'solicitud_estado_nombre', name : 'solicitud_estado_nombre'},
			{ data				: 'solicitud_documento', name : 'solicitud_documento'},
			{ data				: 'solicitud_persona', name : 'solicitud_persona'},
			{ data				: 'tipo_permiso_nombre', name : 'tipo_permiso_nombre'},
			{ data				: 'solicitud_fecha_cantidad', name : 'solicitud_fecha_cantidad'},
			{ data				: 'solicitud_hora_cantidad', name : 'solicitud_hora_cantidad'},
			{ data				: 'solicitud_usuario_aprobador', name : 'solicitud_usuario_aprobador'},
			{ data				: 'solicitud_usuario_talento', name : 'solicitud_usuario_talento'},
			{ render			: function (data, type, full, meta) {return '<a href="javascript:void(0)" id="'+ full.solicitud_codigo +'" value="'+ full.solicitud_estado_codigo +'" value2="'+ full.solicitud_documento +'" role="button" class="btn btn-success" title="Aprobar/Rechazar" data-toggle="modal" data-target="#modaldiv" onclick="setEstado(this.id);"><i class="ti-settings"></i>&nbsp;</a>&nbsp;';}},
		]
	});
});