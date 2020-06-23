$(document).ready(function() {
    var codCom	= document.getElementById('var01').value;
    var codPer	= document.getElementById('var02').value;
    var codMeD	= document.getElementById('var03').value;
    var codMeH  = document.getElementById('var04').value;
    var codGer  = document.getElementById('var05').value;
    var codDep  = document.getElementById('var06').value;
    var codDoc  = document.getElementById('var07').value;

	var dataJSON	= getComprobanteAll(codCom, codPer, codMeD, codMeH, codGer, codDep, codDoc);
	
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
            { targets			: [5],	visible : true,	searchable : true,	orderData : [5, 0] },
            { targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] }
		],
		columns		: [
            { data				: 'comprobante_codigo', name : 'comprobante_codigo'},
            { render			: function (data, type, full, meta) {
                var btn = '<a href="../uploads/comprobante/'+full.comprobante_adjunto+'" target="_blank" role="button" class="btn btn-primary"><i class="ti-import"></i></a>';    
                return btn;
            }},
			{ data				: 'tipo_comprobante_nombre', name : 'tipo_comprobante_nombre'},
			{ data				: 'comprobante_periodo', name : 'comprobante_periodo'},
            { data				: 'tipo_mes_nombre', name : 'tipo_mes_nombre'},
            { data				: 'comprobante_colaborador', name : 'comprobante_colaborador'},
			{ data				: 'comprobante_observacion', name : 'comprobante_observacion'},
		]
    });
    
    $('.form-group').change(function() {
        var codCom	= document.getElementById('var01').value;
        var codPer	= document.getElementById('var02').value;
        var codMeD	= document.getElementById('var03').value;
        var codMeH  = document.getElementById('var04').value;
        var codGer  = document.getElementById('var05').value;
        var codDep  = document.getElementById('var06').value;
        var codDoc  = document.getElementById('var07').value;
        
        var xDATA	= getComprobanteAll(codCom, codPer, codMeD, codMeH, codGer, codDep, codDoc);

        var tableData   = $('#tableLoad').DataTable();
        tableData.clear().rows.add(xDATA).draw();
    });
});