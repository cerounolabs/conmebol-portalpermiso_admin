$(document).ready(function() {
	var codigo		= document.getElementById('tableCodigo').className;	
	var urlDominio	= 'http://api.conmebol.com/portalpermiso/public/v1/000/gerencia';

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
			{ targets			: [0],	visible : false,searchable : false,	orderData : [0, 0] },
			{ targets			: [1],	visible : false,searchable : false,	orderData : [1, 0] },
			{ targets			: [2],	visible : false,searchable : false,	orderData : [2, 0] },
			{ targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] }
		],
		columns		: [
			{ data				: 'tipo_gerencia_codigo', name : 'tipo_gerencia_codigo'},
			{ data				: 'tipo_gerencia_codigo_nombre', name : 'tipo_gerencia_codigo_nombre'},
			{ data				: 'tipo_gerencia_codigo_referencia', name : 'tipo_gerencia_codigo_referencia'},
			{ data				: 'tipo_gerencia_nombre', name : 'tipo_gerencia_nombre'},
		]
	});
});