$(document).ready(function() {
	var codigo	= document.getElementById('tableCodigo').className;	
	var xJSON	= getTipoSolicitud();

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
		data		: xJSON,
		columnDefs	: [
			{ targets			: [0],	visible : true,	searchable : true,	orderData : [0, 0] },
			{ targets			: [1],	visible : true,	searchable : true,	orderData : [1, 0] },
			{ targets			: [2],	visible : true,	searchable : true,	orderData : [2, 0] },
			{ targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] },
			{ targets			: [4],	visible : true,	searchable : true,	orderData : [4, 0] },
			{ targets			: [5],	visible : true,	searchable : true,	orderData : [5, 0] },
			{ targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] },
			{ targets			: [7],	visible : true,	searchable : true,	orderData : [7, 0] },
			{ targets			: [8],	visible : true,	searchable : true,	orderData : [8, 0] },
			{ targets			: [9],	visible : false,searchable : false,	orderData : [9, 0] },
			{ targets			: [10],	visible : false,searchable : false,	orderData : [10, 0] },
			{ targets			: [11],	visible : false,searchable : false,	orderData : [11, 0] },
			{ targets			: [12],	visible : false,searchable : false,	orderData : [12, 0] },
			{ targets			: [13],	visible : true,	searchable : true,	orderData : [13, 0] }
		],
		columns		: [
			{ data				: 'tipo_permiso_codigo', name : 'tipo_permiso_codigo'},
			{ data				: 'tipo_estado_nombre', name : 'tipo_estado_nombre'},
			{ data				: 'tipo_solicitud_nombre', name : 'tipo_solicitud_nombre'},
			{ data				: 'tipo_orden_numero', name : 'tipo_orden_numero'},
			{ data				: 'tipo_permiso_nombre', name : 'tipo_permiso_nombre'},
			{ data				: 'tipo_dia_cantidad', name : 'tipo_dia_cantidad'},
			{ data				: 'tipo_dia_corrido', name : 'tipo_dia_corrido'},
			{ data				: 'tipo_dia_unidad', name : 'tipo_dia_unidad'},
			{ data				: 'tipo_archivo_adjunto', name : 'tipo_archivo_adjunto'},
			{ data				: 'tipo_observacion', name : 'tipo_observacion'},
			{ data				: 'auditoria_usuario', name : 'auditoria_usuario'},
			{ data				: 'auditoria_fecha_hora', name : 'auditoria_fecha_hora'},
			{ data				: 'auditoria_ip', name : 'auditoria_ip'},
			{ render			: function (data, type, full, meta) {
				return '<a href="javascript:void(0)" id="'+ full.tipo_permiso_codigo +'" role="button" class="btn btn-success" data-toggle="modal" data-target="#modaldiv" onclick="getTipoSolicitudId(this.id);"><i class="ti-pencil"></i>&nbsp;</a>&nbsp;';}},
		]
	});
});