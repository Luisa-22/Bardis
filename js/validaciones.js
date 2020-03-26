function SoloLetras(elEvento) {

    var permitidos = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ@´ ";
    var teclas_especiales = [8, 37, 39, 46, 13];
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);
    var tecla_especial = false; for (var i in teclas_especiales) {
        if (codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (permitidos.indexOf(caracter) == -1) {
        if (tecla_especial == false) {
            alert('Este campo solo acepta letras, por favor revise e intente nuevamente.');
        }
    }
    return permitidos.indexOf(caracter) != -1 || tecla_especial;

}

function SoloNumerosyLetras(elEvento) {
    var permitidos = "0123456789abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ@´ ";
    var teclas_especiales = [8, 37, 39, 46, 13];
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);

    var tecla_especial = false; for (var i in teclas_especiales) {
        if (codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (permitidos.indexOf(caracter) == -1) {
        if (tecla_especial == false) {
            alert('Este campo solo acepta numeros y/o letras , por favor revise e intente nuevamente.');
        }
    }
    return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

function SoloNumeros(elEvento) {
    var permitidos = "0123456789";
    teclas_especiales = [8, 37, 39, 46, 13];
    evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);
    var tecla_especial = false; for (var i in teclas_especiales) {
        if (codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (permitidos.indexOf(caracter) == -1) {
        if (tecla_especial == false) {
            alert('Este campo solo acepta números, por favor revise e intente nuevamente.');
        }
    }
    return permitidos.indexOf(caracter) != -1 || tecla_especial;
}