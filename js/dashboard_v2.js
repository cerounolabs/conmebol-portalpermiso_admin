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
		order: [[ 5, "desc" ]],
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
            { targets			: [5],	visible : false,searchable : false,	orderData : [5, 0] },
            { targets			: [6],	visible : true,	searchable : true,	orderData : [6, 0] },
            { targets			: [7],	visible : true,	searchable : true,	orderData : [7, 0] },
            { targets			: [8],	visible : true,	searchable : true,	orderData : [8, 0] }
		],
		columns		: [
            { data				: 'comprobante_codigo', name : 'comprobante_codigo'},
            { render			: function (data, type, full, meta) {
                var btnDSP = '';
                var btnUPD = '';

                if (full.tipo_estado_codigo == 39 || full.tipo_estado_codigo == 40) {
                    btnDSP = '<a href="../uploads/comprobante/'+full.comprobante_adjunto+'" target="_blank" role="button" class="btn btn-primary"><i class="ti-import"></i></a>';
                    btnUPD = '<a href="javascript:void(0)" id="'+ full.comprobante_codigo +'" onclick="setComprobanteEstado(this.id, 41, 2);" role="button" class="btn btn-warning"><i class="fa fa-check"></i></a>';
                } else {
                    btnDSP = '<a href="../uploads/comprobante/'+full.comprobante_adjunto+'" target="_blank" role="button" class="btn btn-primary"><i class="ti-import"></i></a>';
                    btnUPD = '';
                }
                return btnDSP + '&nbsp; &nbsp;' + btnUPD;
            }},
            { data				: 'tipo_estado_nombre', name : 'tipo_estado_nombre'},
			{ data				: 'tipo_comprobante_nombre', name : 'tipo_comprobante_nombre'},
            { data				: 'comprobante_periodo', name : 'comprobante_periodo'},
            { data				: 'tipo_mes_codigo', name : 'tipo_mes_codigo'},
            { data				: 'tipo_mes_nombre', name : 'tipo_mes_nombre'},
            { data				: 'comprobante_colaborador', name : 'comprobante_colaborador'},
			{ data				: 'comprobante_observacion', name : 'comprobante_observacion'},
		]
    });
    
    $('.form-group').change(function() {
        var codCom	    = document.getElementById('var01').value;
        var codPer	    = document.getElementById('var02').value;
        var codMeD	    = document.getElementById('var03').value;
        var codMeH      = document.getElementById('var04').value;
        var codGer      = document.getElementById('var05').value;
        var codDep      = document.getElementById('var06').value;
        var codDoc      = document.getElementById('var07').value;
        var xDATA	    = getComprobanteAll(codCom, codPer, codMeD, codMeH, codGer, codDep, codDoc);
        var tableData   = $('#tableLoad').DataTable();

        tableData.clear().rows.add(xDATA).draw();
    });
});

function verDashboard() {
    var selFil01= document.getElementById('var01').value;
    var selFil02= document.getElementById('var02').value;
    var selFil03= document.getElementById('var03').value;
    var selFil04= document.getElementById('var04').value;
    var selFil05= document.getElementById('var05').value;
    var selFil06= document.getElementById('var06').value;
    var selFil07= document.getElementById('var07').value;
    var xJSON	= getComprobanteAll(selFil01, selFil02, selFil03, selFil04, selFil05, selFil06, selFil07);

    var titPEN01= document.getElementById('titPEN01');
    var titDES01= document.getElementById('titDES01');
    var titENT01= document.getElementById('titENT01');

    var valPEN01= document.getElementById('valPEN01');
    var valDES01= document.getElementById('valDES01');
    var valENT01= document.getElementById('valENT01');

    var canPEN01= 0;
    var canDES01= 0;
    var canENT01= 0;
    var canCOM01= 0;

    var cssPEN01= 'css-bar-0';
    var cssDES01= 'css-bar-0';
    var cssENT01= 'css-bar-0';
    
    xJSON.forEach(element => {
        if (element.tipo_comprobante_codigo == selFil01 && element.comprobante_periodo >= selFil02 && element.tipo_mes_codigo >= selFil03 && element.tipo_mes_codigo <= selFil04) {
            if (selFil05 == 0){
                if (selFil06 == 0){
                    if (selFil07 == 0){
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    } else if (selFil07 == element.comprobante_documento) {
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    }
                } else if (selFil06 == element.tipo_departamento_codigo) {
                    if (selFil07 == 0){
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    } else if (selFil07 == element.comprobante_documento) {
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    }
                }
            } else if (selFil05 == element.tipo_gerencia_codigo) {
                if (selFil06 == 0){
                    if (selFil07 == 0){
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    } else if (selFil07 == element.comprobante_documento) {
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    }
                } else if (selFil06 == element.tipo_departamento_codigo) {
                    if (selFil07 == 0){
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    } else if (selFil07 == element.comprobante_documento) {
                        switch (element.tipo_estado_codigo) {
                            case 39:
                                canPEN01 = canPEN01 + 1;
                                break;
                        
                            case 40:
                                canDES01 = canDES01 + 1;
                                break;

                            case 41:
                                canENT01 = canENT01 + 1;
                                break;
                        }
                    }
                }
            }
        }
    });

    canCOM01            = canPEN01 + canDES01 + canENT01;

    titPEN01.innerHTML  = canPEN01;
    titDES01.innerHTML  = canDES01;
    titENT01.innerHTML  = canENT01;

    cssPEN01            = calCSS(canCOM01, canPEN01);
    cssDES01            = calCSS(canCOM01, canDES01);
    cssENT01            = calCSS(canCOM01, canENT01);

    valPEN01.setAttribute('data-label', '100%');
    valPEN01.setAttribute('class', 'css-bar m-b-0 css-bar-info ' + cssPEN01);
    valDES01.setAttribute('data-label', '30%');
    valDES01.setAttribute('class', 'css-bar m-b-0 css-bar-success ' + cssDES01);
    valENT01.setAttribute('data-label', '40%');
    valENT01.setAttribute('class', 'css-bar m-b-0 css-bar-warning ' + cssENT01);
}