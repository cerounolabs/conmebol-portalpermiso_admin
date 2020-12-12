function selectGerencia(var01) {
    var xJSON       = getTipoGerencia();
    var selOption   = document.getElementById(var01);
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }

    var option      = document.createElement('option');
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

function selectDepartamento(var01, var02) {
    var codGer      = document.getElementById(var01);
    var selOption   = document.getElementById(var02);
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

function selectColaborador(var01, var02, var03) {
    var codGer      = document.getElementById(var01);
    var codDep      = document.getElementById(var02);
    var selOption   = document.getElementById(var03);

    if (codGer != null || codDep != null) {
        var xJSON       = getColaborador(codGer.value, codDep.value);
    } else {
        var xJSON       = getColaborador(0, 0);
    }

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

function selectDominio(var01, var02, var03) {
    var selOption   = document.getElementById(var01);
    var xJSON       = getDominio(var02);
    
    while (selOption.length > 0) {
        selOption.remove(0);
    }
    
    if (var03 == true) {
        var option  = document.createElement('option');
        option.value    = 0;
        option.text     = 'TODOS';
        option.selected = true;
        selOption.add(option, null);
    }

    xJSON.forEach(element => {
        if (element.tipo_estado_codigo == 1){
            var option      = document.createElement('option');
            option.value    = element.tipo_codigo;
            option.text     = element.tipo_nombre_castellano;
            selOption.add(option, null);
        }
    });
}