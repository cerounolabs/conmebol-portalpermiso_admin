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

    charView(selFil01, selFil02, selFil03, selFil04, selFil05, selFil06, selFil07);
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

function viewVacaciones(parm01, parm02, parm03, parm04) {
    var rowView = document.getElementById(parm01);
    var selTipo = document.getElementById(parm02).value;
    var selAnho = formatDate(document.getElementById(parm03).value).substring(0, 4);;
    var selFunc = document.getElementById(parm04).value;

    if (selTipo == 22 && selFunc != 0) {
        rowView.style.display = 'flex';

        var titCOR02= document.getElementById('titCOR02');
        var titUSU02= document.getElementById('titUSU02');
        var titDIS02= document.getElementById('titDIS02');
    
        var valCOR02= document.getElementById('valCOR02');
        var valUSU02= document.getElementById('valUSU02');
        var valDIS02= document.getElementById('valDIS02');
    
        var canCOR02= 0;
        var canUSU02= 0;
        var canDIS02= 0;
    
        var cssCOR02= 'css-bar-0';
        var cssUSU02= 'css-bar-0';
        var cssDIS02= 'css-bar-0';

        var xJSON   = getVacacion(selFunc, selAnho);

        xJSON.forEach(element => {
            canCOR02 = element.vacacion_cantidad_dia;
            canUSU02 = element.vacacion_cantidad_usuado;
            canDIS02 = element.vacacion_cantidad_restante;
        });

        titCOR02.innerHTML  = canCOR02;
        titUSU02.innerHTML  = canUSU02;
        titDIS02.innerHTML  = canDIS02;

        cssCOR02            = calCSS(canCOR02, canCOR02);
        cssUSU02            = calCSS(canCOR02, canUSU02);
        cssDIS02            = calCSS(canCOR02, canDIS02);

        valCOR02.setAttribute('data-label', '100%');
        valCOR02.setAttribute('class', 'css-bar m-b-0 css-bar-info ' + cssCOR02);
        valUSU02.setAttribute('data-label', '30%');
        valUSU02.setAttribute('class', 'css-bar m-b-0 css-bar-danger ' + cssUSU02);
        valDIS02.setAttribute('data-label', '40%');
        valDIS02.setAttribute('class', 'css-bar m-b-0 css-bar-success ' + cssDIS02);
    } else {
        rowView.style.display = 'none';
    }
}