function selectSolicitud () {
    var xJSON       = getTipoSolicitud();
    var selOption   = document.getElementById('var01');
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    xJSON.forEach(element => {
        if (element.tipo_estado_codigo == 'A'){
            var option      = document.createElement('option');
            option.value    = element.tipo_permiso_codigo;
            option.text     = element.tipo_solicitud_nombre + ' - ' + element.tipo_permiso_nombre;
            selOption.add(option, null);
        }
    });
}

function selectEstado() {
    var selOption   = document.getElementById('var04');
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    var option  = document.createElement('option');
    option.value    = 'T';
    option.text     = 'TODOS';
    option.selected = true;
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'I';
    option.text     = 'INGRESADO';
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'A';
    option.text     = 'AUTORIZADO';
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'P';
    option.text     = 'APROBADO';
    selOption.add(option, null);

    var option  = document.createElement('option');
    option.value    = 'C';
    option.text     = 'ANULADO';
    selOption.add(option, null);
}

function selectGerencia() {
    var xJSON       = getTipoGerencia();
    var selOption   = document.getElementById('var05');
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    var option  = document.createElement('option');
    option.value    = 0;
    option.text     = 'TODOS';
    option.selected = true;
    selOption.add(option, null);

    xJSON.forEach(element => {
        var option      = document.createElement('option');
        option.value    = element.tipo_gerencia_codigo;
        option.text     = element.tipo_gerencia_nombre;
        selOption.add(option, null);
    });
}

function selectDepto() {
    var codGer      = document.getElementById('var05');
    var selOption   = document.getElementById('var06');
    var xJSON       = getTipoDepartamento(codGer.value);
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    var option  = document.createElement('option');
    option.value    = 0;
    option.text     = 'TODOS';
    option.selected = true;
    selOption.add(option, null);

    xJSON.forEach(element => {
        var option      = document.createElement('option');
        option.value    = element.tipo_departamento_codigo;
        option.text     = element.tipo_departamento_nombre;
        selOption.add(option, null);
    });
}

function selectColaborador() {
    var codGer      = document.getElementById('var05');
    var codDep      = document.getElementById('var06');
    var selOption   = document.getElementById('var07');
    var xJSON       = getColaborador(codGer.value, codDep.value);
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    var option  = document.createElement('option');
    option.value    = 0;
    option.text     = 'TODOS';
    option.selected = true;
    selOption.add(option, null);

    xJSON.forEach(element => {
        var option      = document.createElement('option');
        option.value    = element.documento;
        option.text     = element.nombre_completo;
        selOption.add(option, null);
    });
}

function verSolicitudes() {
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

    charView(selFil01, selFil02, selFil03, selFil04, selFil05, selFil06, selFil07);
}

function calCSS(totSOL, canTOT) {
    var retCSS  = '';
    var porSOL  = Math.round(((canTOT * 100) / totSOL));

    if(porSOL == 0){
        retCSS  = 'css-bar-0';
    } else if (porSOL > 0 && porSOL < 6) {
        retCSS  = 'css-bar-5';
    } else if (porSOL > 5 && porSOL < 11) {
        retCSS  = 'css-bar-10';
    } else if (porSOL > 10 && porSOL < 16) {
        retCSS  = 'css-bar-15';
    } else if (porSOL > 15 && porSOL < 21) {
        retCSS  = 'css-bar-20';
    } else if (porSOL > 20 && porSOL < 26) {
        retCSS  = 'css-bar-25';
    } else if (porSOL > 25 && porSOL < 31) {
        retCSS  = 'css-bar-30';
    } else if (porSOL > 30 && porSOL < 36) {
        retCSS  = 'css-bar-35';
    } else if (porSOL > 35 && porSOL < 41) {
        retCSS  = 'css-bar-40';
    } else if (porSOL > 40 && porSOL < 46) {
        retCSS  = 'css-bar-45';
    } else if (porSOL > 45 && porSOL < 51) {
        retCSS  = 'css-bar-50';
    } else if (porSOL > 50 && porSOL < 56) {
        retCSS  = 'css-bar-55';
    } else if (porSOL > 55 && porSOL < 61) {
        retCSS  = 'css-bar-60';
    } else if (porSOL > 60 && porSOL < 66) {
        retCSS  = 'css-bar-65';
    } else if (porSOL > 65 && porSOL < 71) {
        retCSS  = 'css-bar-70';
    } else if (porSOL > 70 && porSOL < 76) {
        retCSS  = 'css-bar-75';
    } else if (porSOL > 75 && porSOL < 81) {
        retCSS  = 'css-bar-80';
    } else if (porSOL > 80 && porSOL < 86) {
        retCSS  = 'css-bar-85';
    } else if (porSOL > 85 && porSOL < 91) {
        retCSS  = 'css-bar-90';
    } else if (porSOL > 90 && porSOL < 96) {
        retCSS  = 'css-bar-95';
    } else if (porSOL > 95 && porSOL < 101) {
        retCSS  = 'css-bar-100';
    }

    return retCSS;
}

function cantidadGer(fil01, fil02, fil03, fil04, fil05){
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

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

function charView(fil01, fil02, fil03, fil04, fil05, fil06, fil07){
    var xJSON   = getTipoGerencia();
    var xJSON1  = getSolicitudes();
    var edad01  = 0;
    var edad02  = 0;
    var edad03  = 0;
    var edad04  = 0;
    var edad05  = 0;
    var objGer  = [];
    var dataGer = [];
    var dataEda = [];

    xJSON.forEach(element => {
        if (fil05 == 0) {
            var cantAUX = cantidadGer(fil01, fil02, fil03, fil04, element.tipo_gerencia_codigo);
            var dataAUX = { "value": cantAUX, "name": element.tipo_gerencia_nombre};
    
            objGer.push(dataAUX);
            dataGer.push(element.tipo_gerencia_nombre);
        }else if (element.tipo_gerencia_codigo == fil05) {
            var cantAUX = cantidadGer(fil01, fil02, fil03, fil04, element.tipo_gerencia_codigo);
            var dataAUX = { "value": cantAUX, "name": element.tipo_gerencia_nombre};
    
            objGer.push(dataAUX);
            dataGer.push(element.tipo_gerencia_nombre);
        }
    });

    xJSON1.forEach(element => {
        if (element.tipo_permiso_codigo == fil01 && element.solicitud_fecha_desde_1 >= fil02 && element.solicitud_fecha_hasta_1 <= fil03) {
            if (fil04 == 'T') {
                if (fil05 == 0) {
                    if (fil06 == 0) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    } else if (element.departamento_codigo == fil06) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    }
                }  else if (element.gerencia_codigo == fil05) {
                    if (fil06 == 0) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    } else if (element.departamento_codigo == fil06) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    }
                }
            } else if (element.solicitud_estado_codigo == fil04) {
                if (fil05 == 0) {
                    if (fil06 == 0) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    } else if (element.departamento_codigo == fil06) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    }
                }  else if (element.gerencia_codigo == fil05) {
                    if (fil06 == 0) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    } else if (element.departamento_codigo == fil06) {
                        if (fil07 == 0) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        } else if (element.solicitud_documento == fil07) {
                            if (element.colaborador_edad < 21) {
                                edad01 = edad01 + 1;
                            } else if (element.colaborador_edad > 20 && element.colaborador_edad < 31) {
                                edad02 = edad02 + 1;
                            } else if (element.colaborador_edad > 30 && element.colaborador_edad < 41) {
                                edad03 = edad03 + 1;
                            } else if (element.colaborador_edad > 40 && element.colaborador_edad < 51) {
                                edad04 = edad04 + 1;
                            } else if (element.colaborador_edad > 50) {
                                edad05 = edad05 + 1;
                            }
                        }
                    }
                }
            }
        }
    });

    dataEda.push(edad01);
    dataEda.push(edad02);
    dataEda.push(edad03);
    dataEda.push(edad04);
    dataEda.push(edad05);

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

                    data: objGer
                }
            ]
        };

        cha01.setOption(opt01);
        
        new Chart(document.getElementById("char02"), {
            type: 'pie',
            data: {
                labels: [ "Menor que 20", "Entre 21 a 30", "Entre 31 a 40", "Entre 41 a 50", "Mayor que 50"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#36a2eb", "#ff6384", "#4bc0c0", "#ffcd56", "#07b107"],
                    data: dataEda
                }]
            },
            options: {
                title: {
                    display: false,
                    text: ''
                }
            }
        });
    });
}