$(document).ready(function() {
    /*var codCom	= document.getElementById('var01').value;
    var codPer	= document.getElementById('var02').value;
    var codMeD	= document.getElementById('var03').value;
    var codMeH  = document.getElementById('var04').value;
    var codGer  = document.getElementById('var05').value;
    var codDep  = document.getElementById('var06').value;
    var codDoc  = document.getElementById('var07').value;
    var codEst  = document.getElementById('var08').value;*/
    var dataJSON	= getTarjetaPersona();
    
    //codCom, codPer, codMeD, codMeH, codGer, codDep, codDoc, codEst
	$('#tableLoad').DataTable({
		processing	: true,
		destroy		: true,
		searching	: true,
		paging		: true,
		lengthChange: true,
		info		: true,
		order: [[1, "desc"]],
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
            { targets			: [0],	visible : true,searchable : true,	orderData : [0, 0] },
            { targets			: [1],	visible : true,	searchable: true,	orderData : [1, 0] },
			{ targets			: [2],	visible : true,searchable : true,	orderData : [2, 0] },
			{ targets			: [3],	visible : true,	searchable: true,	orderData : [3, 0] },
    
        ],
		
		columns		: [
            { data				: 'tarjeta_personal_nombre',    name : 'tarjeta_personal_nombre'},
            { data				: 'auditoria_fecha_hora',       name : 'auditoria_fecha_hora'},
            { data				: 'tipo_cantidad_castellano',   name : 'tipo_cantidad_castellano'},
            { render			: 
				function (data, type, full, meta) {
					var btnCON = '';
					var btnUPD = '';
					
						if (full.tipo_estado_parametro == 1 ){
							btnCON = '<button type="button" class="btn btn-success" onclick="getTarjetas('+full.tarjeta_personal_codigo+', '+full.tarjeta_personal_documento+', 2);" data-toggle="modal" data-target="#modaldiv" title="Generar"><i class="fa fa-check-square"></i></button>';
							btnUPD = '<button type="button" class="btn btn-danger"  onclick="getTarjetas('+full.tarjeta_personal_codigo+', '+full.tarjeta_personal_documento+', 3);" data-toggle="modal" data-target="#modaldiv" title="Rechazar"><i class="fa fa-window-close"></i></button>';
						}
					
						return ( btnCON + '&nbsp' + btnUPD);	
				}
			},
            
		]
    });
   // console.log(_parm07BASE);

   /* $('.form-group').change(function() {
        var codCom	    = document.getElementById('var01').value;
        var codPer	    = document.getElementById('var02').value;
        var codMeD	    = document.getElementById('var03').value;
        var codMeH      = document.getElementById('var04').value;
        var codGer      = document.getElementById('var05').value;
        var codDep      = document.getElementById('var06').value;
        var codDoc      = document.getElementById('var07').value;
        var codEst      = document.getElementById('var08').value;
        var xDATA	    = getComprobanteAll(codCom, codPer, codMeD, codMeH, codGer, codDep, codDoc, codEst);
        var tableData   = $('#tableLoad').DataTable();

        tableData.clear().rows.add(xDATA).draw();
    });*/
});

