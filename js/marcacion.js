$(document).ready(function() {
	var codigo	= document.getElementById('tableCodigo').className;	  
	var xJSON	= getMarcacion(docFunc);

	$('#tableLoad').DataTable({
		processing	: true,
		destroy		: true,
		searching	: true,
		paging		: true,
		lengthChange: true,
		info		: true,
		order: [[ 0, "desc" ]],
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
			{ targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] }
		],
		columns		: [
			{ data				: 'marcacion_codigo', name : 'marcacion_codigo'},
			{ data				: 'marcacion_entrada_oficina_fecha', name : 'marcacion_entrada_oficina_fecha'},
			{ data				: 'marcacion_entrada_oficina_hora', name : 'marcacion_entrada_oficina_hora'},
			{ data				: 'marcacion_salida_almuerzo_hora', name : 'marcacion_salida_almuerzo_hora'},
			{ data				: 'marcacion_entrada_almuerzo_hora', name : 'marcacion_entrada_almuerzo_hora'},
			{ data				: 'marcacion_salida_oficina_hora', name : 'marcacion_salida_oficina_hora'},
			{ data				: 'marcacion_comentario', name : 'marcacion_comentario'},
		]
	});
});