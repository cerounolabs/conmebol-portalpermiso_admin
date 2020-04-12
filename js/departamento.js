$(document).ready(function() {
	var codigo	= document.getElementById('tableCodigo').className;	
	var xJSON	= getTipoDepartamento();

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
			{ targets			: [4],	visible : true,	searchable : true,	orderData : [4, 0] }
		],
		columns		: [
			{ data				: 'tipo_departamento_codigo', name : 'tipo_departamento_codigo'},
			{ data				: 'tipo_departamento_codigo_nombre', name : 'tipo_departamento_codigo_nombre'},
			{ data				: 'tipo_departamento_codigo_referencia', name : 'tipo_departamento_codigo_referencia'},
			{ data				: 'tipo_gerencia_nombre', name : 'tipo_gerencia_nombre'},
			{ data				: 'tipo_departamento_nombre', name : 'tipo_departamento_nombre'},
		]
	});
});