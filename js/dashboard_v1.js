function verDashboard() {
    var xJSON   = getSolicitudes();

    var selFil01= document.getElementById('var01').value;
    var selFil02= formatDate(document.getElementById('var02').value);
    var selFil03= formatDate(document.getElementById('var03').value);
    var selFil04= document.getElementById('var04').value;
    var selFil05= document.getElementById('var05').value;
    var selFil06= document.getElementById('var06').value;
    var selFil07= document.getElementById('var07').value;

    var titING01= document.getElementById('titING01');
    var titAUT01= document.getElementById('titAUT01');
    var titAPR01= document.getElementById('titAPR01');
    var titANU01= document.getElementById('titANU01');

    var valING01= document.getElementById('valING01');
    var valAUT01= document.getElementById('valAUT01');
    var valAPR01= document.getElementById('valAPR01');
    var valANU01= document.getElementById('valANU01');

    var canING01= 0;
    var canAUT01= 0;
    var canAPR01= 0;
    var canANU01= 0;
    var canSOL01= 0;

    var cssING01= 'css-bar-0';
    var cssAUT01= 'css-bar-0';
    var cssAPR01= 'css-bar-0';
    var cssANU01= 'css-bar-0';

    xJSON.forEach(element => {
        if (element.tipo_permiso_codigo == selFil01 && element.solicitud_fecha_desde_1 >= selFil02 && element.solicitud_fecha_hasta_1 <= selFil03) {
            if (selFil04 == 'T') {
                if (selFil05 == 0){
                    if (selFil06 == 0){
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    } else if (selFil06 == element.departamento_codigo) {
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    }
                } else if (selFil05 == element.gerencia_codigo) {
                    if (selFil06 == 0){
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    } else if (selFil06 == element.departamento_codigo) {
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    }
                }
            } else if (selFil04 == element.solicitud_estado_codigo) {
                if (selFil05 == 0){
                    if (selFil06 == 0){
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    } else if (selFil06 == element.departamento_codigo) {
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    }
                } else if (selFil05 == element.gerencia_codigo) {
                    if (selFil06 == 0){
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    } else if (selFil06 == element.departamento_codigo) {
                        if (selFil07 == 0){
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        } else if (selFil07 == element.solicitud_documento) {
                            switch (element.solicitud_estado_codigo) {
                                case 'I':
                                    canING01 = canING01 + 1;
                                    break;
                            
                                case 'A':
                                    canAUT01 = canAUT01 + 1;
                                    break;

                                case 'P':
                                    canAPR01 = canAPR01 + 1;
                                    break;

                                case 'C':
                                    canANU01 = canANU01 + 1;
                                    break;
                            }
                        }
                    }
                }   
            }
        }
    });

    canSOL01            = canING01 + canAUT01 + canAPR01 + canANU01;

    titING01.innerHTML  = canING01;
    titAUT01.innerHTML  = canAUT01;
    titAPR01.innerHTML  = canAPR01;
    titANU01.innerHTML  = canANU01;

    cssING01            = calCSS(canSOL01, canING01);
    cssAUT01            = calCSS(canSOL01, canAUT01);
    cssAPR01            = calCSS(canSOL01, canAPR01);
    cssANU01            = calCSS(canSOL01, canANU01);

    valING01.setAttribute('data-label', '100%');
    valING01.setAttribute('class', 'css-bar m-b-0 css-bar-info ' + cssING01);
    valAUT01.setAttribute('data-label', '30%');
    valAUT01.setAttribute('class', 'css-bar m-b-0 css-bar-success ' + cssAUT01);
    valAPR01.setAttribute('data-label', '40%');
    valAPR01.setAttribute('class', 'css-bar m-b-0 css-bar-warning ' + cssAPR01);
    valANU01.setAttribute('data-label', '50%');
    valANU01.setAttribute('class', 'css-bar m-b-0 css-bar-danger ' + cssANU01);

    charView01(selFil01, selFil02, selFil03, selFil04, selFil05);
    charView02(selFil01, selFil02, selFil03, selFil04, selFil05, selFil06);
}

function charView01(fil01, fil02, fil03, fil04, fil05){
    var xJSON   = getTipoGerencia();
    var objData  = [];

    xJSON.forEach(element => {
        if (fil05 == 0) {
            var cantAUX = cantGerencia(fil01, fil02, fil03, fil04, element.tipo_gerencia_codigo);
            var dataAUX = { "value": cantAUX, "name": element.tipo_gerencia_nombre};
    
            objData.push(dataAUX);
        }else if (element.tipo_gerencia_codigo == fil05) {
            var cantAUX = cantGerencia(fil01, fil02, fil03, fil04, element.tipo_gerencia_codigo);
            var dataAUX = { "value": cantAUX, "name": element.tipo_gerencia_nombre};
    
            objData.push(dataAUX);
        }
    });

    $(function() {
        "use strict";
        var cha01 = echarts.init(document.getElementById('char01'));
        
        var opt01 = 
            {
                title: {
                text: '',
                subtext: '',
                x: 'center'
            },

            // Add tooltip
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: Solicitudes {c} ({d}%)"
            },

            color: ['#ffbc34', '#4fc3f7', '#212529', '#f62d51', '#2962FF', '#FFC400', '#006064', '#FF1744', '#1565C0', '#FFC400', '#64FFDA', '#607D8B'],

            // Display toolbox
            toolbox: {
                show: true,
                orient: 'vertical',
                feature: {
                    mark: {
                        show: true,
                        title: {
                            mark: 'Markline switch',
                            markUndo: 'Undo markline',
                            markClear: 'Clear markline'
                        }
                    },
                    dataView: {
                        show: false,
                        readOnly: false,
                        title: 'View data',
                        lang: ['View chart data', 'Close', 'Update']
                    },
                    magicType: {
                        show: true,
                        title: {
                            pie: 'Switch to pies',
                            funnel: 'Switch to funnel',
                        },
                        type: ['pie', 'funnel']
                    },
                    restore: {
                        show: false,
                        title: 'Restore'
                    },
                    saveAsImage: {
                        show: false,
                        title: 'Same as image',
                        lang: ['Save']
                    }
                }
            },

            // Enable drag recalculate
            calculable: true,

            // Add series
            series: [
                {
                    name: 'GERENCIA',
                    type: 'pie',
                    radius: ['15%', '73%'],
                    center: ['50%', '57%'],
                    roseType: 'area',

                    // Funnel
                    width: '40%',
                    height: '78%',
                    x: '30%',
                    y: '17.5%',
                    max: 450,
                    sort: 'ascending',

                    data: objData
                }
            ]
        };

        cha01.setOption(opt01);
    });
}

function charView02(fil01, fil02, fil03, fil04, fil05, fil06){
    var xJSON   = getTipoDepartamento(fil05);
    var objData  = [];

    xJSON.forEach(element => {
        if (fil06 == 0) {
            var cantAUX = cantDepartamento(fil01, fil02, fil03, fil04, fil05, element.tipo_departamento_codigo);
            var dataAUX = { "value": cantAUX, "name": element.tipo_departamento_nombre};
    
            objData.push(dataAUX);
        }else if (element.tipo_departamento_codigo == fil06) {
            var cantAUX = cantDepartamento(fil01, fil02, fil03, fil04, fil05, element.tipo_departamento_codigo);
            var dataAUX = { "value": cantAUX, "name": element.tipo_departamento_nombre};
    
            objData.push(dataAUX);
        }
    });

    $(function() {
        "use strict";
        var cha01 = echarts.init(document.getElementById('char02'));
        
        var opt01 = 
            {
                title: {
                text: '',
                subtext: '',
                x: 'center'
            },

            // Add tooltip
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: Solicitudes {c} ({d}%)"
            },

            color: ['#006064', '#FF1744', '#1565C0', '#FFC400', '#64FFDA', '#607D8B', '#ffbc34', '#4fc3f7', '#212529', '#f62d51', '#2962FF', '#FFC400'],

            // Display toolbox
            toolbox: {
                show: true,
                orient: 'vertical',
                feature: {
                    mark: {
                        show: true,
                        title: {
                            mark: 'Markline switch',
                            markUndo: 'Undo markline',
                            markClear: 'Clear markline'
                        }
                    },
                    dataView: {
                        show: false,
                        readOnly: false,
                        title: 'View data',
                        lang: ['View chart data', 'Close', 'Update']
                    },
                    magicType: {
                        show: true,
                        title: {
                            pie: 'Switch to pies',
                            funnel: 'Switch to funnel',
                        },
                        type: ['pie', 'funnel']
                    },
                    restore: {
                        show: false,
                        title: 'Restore'
                    },
                    saveAsImage: {
                        show: false,
                        title: 'Same as image',
                        lang: ['Save']
                    }
                }
            },

            // Enable drag recalculate
            calculable: true,

            // Add series
            series: [
                {
                    name: 'DEPARTAMENTO',
                    type: 'pie',
                    radius: ['15%', '73%'],
                    center: ['50%', '57%'],
                    roseType: 'area',

                    // Funnel
                    width: '40%',
                    height: '78%',
                    x: '30%',
                    y: '17.5%',
                    max: 450,
                    sort: 'ascending',

                    data: objData
                }
            ]
        };

        cha01.setOption(opt01);
    });
}

function cantGerencia(fil01, fil02, fil03, fil04, fil05){
    var xJSON   = getSolicitudes();
    var retCan  = 0;

    xJSON.forEach(element => {
        if (element.tipo_permiso_codigo == fil01 && element.solicitud_fecha_desde_1 >= fil02 && element.solicitud_fecha_hasta_1 <= fil03) {
            if (fil04 == 'T') {
                if (fil05 == 0) {
                    retCan = retCan + 1;
                } else if (element.gerencia_codigo == fil05) {
                    retCan = retCan + 1;
                }
            } else if (element.solicitud_estado_codigo == fil04) {
                if (fil05 == 0) {
                    retCan = retCan + 1;
                } else if (element.gerencia_codigo == fil05) {
                    retCan = retCan + 1;
                }
            }
        }
    });
    
    return retCan;
}

function cantDepartamento(fil01, fil02, fil03, fil04, fil05, fil06){
    var xJSON   = getSolicitudes();
    var retCan  = 0;

    xJSON.forEach(element => {
        if (element.tipo_permiso_codigo == fil01 && element.solicitud_fecha_desde_1 >= fil02 && element.solicitud_fecha_hasta_1 <= fil03) {
            if (fil04 == 'T') {
                if (fil05 == 0) {
                    if (fil06 == 0) {
                        retCan = retCan + 1;
                    } else {
                        if (fil06 == element.departamento_codigo) {
                            retCan = retCan + 1; 
                        }
                    }
                } else if (element.gerencia_codigo == fil05) {
                    if (fil06 == 0) {
                        retCan = retCan + 1;
                    } else {
                        if (fil06 == element.departamento_codigo) {
                            retCan = retCan + 1; 
                        }
                    }
                }
            } else if (element.solicitud_estado_codigo == fil04) {
                if (fil05 == 0) {
                    if (fil06 == 0) {
                        retCan = retCan + 1;
                    } else {
                        if (fil06 == element.departamento_codigo) {
                            retCan = retCan + 1; 
                        }
                    }
                } else if (element.gerencia_codigo == fil05) {
                    if (fil06 == 0) {
                        retCan = retCan + 1;
                    } else {
                        if (fil06 == element.departamento_codigo) {
                            retCan = retCan + 1; 
                        }
                    }
                }
            }
        }
    });
    
    return retCan;
}

function viewVacaciones(parm01, parm02, parm03, parm04, parm05, parm06) {
    var rowView = document.getElementById(parm01);
    var selTipo = document.getElementById(parm02).value;
    var selAnho = (document.getElementById(parm03).value).substring(0, 4);
    var selGer  = document.getElementById(parm04).value;
    var selDep  = document.getElementById(parm05).value;
    var selFunc = document.getElementById(parm06).value;

    if (selTipo == 22) {
        rowView.style.display = 'flex';

        var titPER02= document.getElementById('titPER02');
        var titCOR02= document.getElementById('titCOR02');
        var titUSU02= document.getElementById('titUSU02');
        var titDIS02= document.getElementById('titDIS02');
    
        var valPER02= document.getElementById('valPER02');
        var valCOR02= document.getElementById('valCOR02');
        var valUSU02= document.getElementById('valUSU02');
        var valDIS02= document.getElementById('valDIS02');
    
        var canPER02= 0;
        var canCOR02= 0;
        var canUSU02= 0;
        var canDIS02= 0;
    
        var cssPER02= 'css-bar-0';
        var cssCOR02= 'css-bar-0';
        var cssUSU02= 'css-bar-0';
        var cssDIS02= 'css-bar-0';

        var xJSON   = getColaborador(selGer, selDep);
        var xJSON1  = getVacacion(selAnho);

        xJSON.forEach(element => {
            if (selFunc == 0) {
                xJSON1.forEach(element1 => {
                    if (element.documento == element1.vacacion_colaborador_codigo) {
                        canCOR02 = canCOR02 + element1.vacacion_cantidad_dia;
                        canUSU02 = canUSU02 + element1.vacacion_cantidad_usuado;
                        canDIS02 = canDIS02 + element1.vacacion_cantidad_restante;
                    }
                });
            } else {
                if (element.documento == selFunc) {
                    xJSON1.forEach(element1 => {
                        if (element.documento == element1.vacacion_colaborador_codigo) {
                            canCOR02 = element1.vacacion_cantidad_dia;
                            canUSU02 = element1.vacacion_cantidad_usuado;
                            canDIS02 = element1.vacacion_cantidad_restante;
                        }
                    });
                }
            }
        });

        titPER02.innerHTML  = selAnho;
        titCOR02.innerHTML  = canCOR02;
        titUSU02.innerHTML  = canUSU02;
        titDIS02.innerHTML  = canDIS02;

        cssPER02            = calCSS(canCOR02, canCOR02);
        cssCOR02            = calCSS(canCOR02, canCOR02);
        cssUSU02            = calCSS(canCOR02, canUSU02);
        cssDIS02            = calCSS(canCOR02, canDIS02);

        valPER02.setAttribute('data-label', '100%');
        valPER02.setAttribute('class', 'css-bar m-b-0 css-bar-info ' + cssPER02);
        valCOR02.setAttribute('data-label', '100%');
        valCOR02.setAttribute('class', 'css-bar m-b-0 css-bar-success ' + cssCOR02);
        valUSU02.setAttribute('data-label', '30%');
        valUSU02.setAttribute('class', 'css-bar m-b-0 css-bar-danger ' + cssUSU02);
        valDIS02.setAttribute('data-label', '40%');
        valDIS02.setAttribute('class', 'css-bar m-b-0 css-bar-warning ' + cssDIS02);
    } else {
        rowView.style.display = 'none';
    }
}