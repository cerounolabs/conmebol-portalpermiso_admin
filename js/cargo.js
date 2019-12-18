$(document).ready(function() {
	var codigo		= document.getElementById('tableCodigo').className;	
	var urlDominio	= 'http://api.conmebol.com/portalpermiso/public/v1/000/cargo';

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
			{ targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] },
			{ targets			: [4],	visible : true,	searchable : true,	orderData : [4, 0] },
			{ targets			: [5],	visible : true,	searchable : true,	orderData : [5, 0] },
			{ targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] },
			{ targets			: [7],	visible : true,	searchable : true,	orderData : [7, 0] },
			{ targets			: [8],	visible : true,	searchable : true,	orderData : [8, 0] }
		],
		columns		: [
			{ data				: 'tipo_cargo_codigo', name : 'tipo_cargo_codigo'},
			{ data				: 'tipo_cargo_codigo_nombre', name : 'tipo_cargo_codigo_nombre'},
			{ data				: 'tipo_cargo_codigo_referencia', name : 'tipo_cargo_codigo_referencia'},
			{ data				: 'tipo_superior_cargo_nombre', name : 'tipo_superior_cargo_nombre'},
			{ data				: 'tipo_cargo_nombre', name : 'tipo_cargo_nombre'},
			{ data				: 'tipo_cargo_puesto_cantidad', name : 'tipo_cargo_puesto_cantidad'},
			{ data				: 'tipo_cargo_puesto_ocupado', name : 'tipo_cargo_puesto_ocupado'},
			{ data				: 'tipo_cargo_libre', name : 'tipo_cargo_libre'},
			{ data				: 'tipo_cargo_grado', name : 'tipo_cargo_grado'},
		]
	});
});