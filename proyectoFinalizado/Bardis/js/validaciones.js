function SoloLetras(elEvento) {

    /**
     * Variable que define los caracteres permitidos
     * 
     * @var permitidos 
     */
    var permitidos = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ@´ ";

    /**
     * Teclas especiales que se aceptan
     * 
     * 8 = BackSpace 
     * 13=Enter 
     * 37 = flecha izquierda 
     * 39 = flecha derecha
     * 46 = Supr 
     * 
     * @var teclas_especiales
     */
    var teclas_especiales = [8, 37, 39, 46, 13];

    /**
     * Obtener la tecla pulsada
     * 
     * @var evento
     * @var codigoCaracter
     * @var caracter
     */
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);

    /**
     * Comprobar si la tecla pulsada es alguna de las teclas especiales
     * 
     * @var tecla_especial
     */
    var tecla_especial = false;
    for (var i in teclas_especiales) {
        if (codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    /**
     * Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
     */
    if (permitidos.indexOf(caracter) == -1) {
        if (tecla_especial == false) {
            alert('Este campo solo acepta letras, por favor revise e intente nuevamente.');
        }
    }
    return permitidos.indexOf(caracter) != -1 || tecla_especial;

}

function SoloNumerosyLetras(elEvento) {

    /**
     * Variable que define los caracteres permitidos
     * 
     * @var permitidos 
     */
    var permitidos = "0123456789abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ@´ ";

    /**
     * Teclas especiales que se aceptan
     * 
     * 8 = BackSpace 
     * 13=Enter 
     * 37 = flecha izquierda 
     * 39 = flecha derecha
     * 46 = Supr 
     * 
     * @var teclas_especiales
     */
    var teclas_especiales = [8, 37, 39, 46, 13];

    /**
     * Obtener la tecla pulsada
     * 
     * @var evento
     * @var codigoCaracter
     * @var caracter
     */
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);

    /**
     * Comprobar si la tecla pulsada es alguna de las teclas especiales
     * 
     * @var tecla_especial
     */
    var tecla_especial = false;
    for (var i in teclas_especiales) {
        if (codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    /**
     * Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
     */
    if (permitidos.indexOf(caracter) == -1) {
        if (tecla_especial == false) {
            alert('Este campo solo acepta numeros y/o letras , por favor revise e intente nuevamente.');
        }
    }
    return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

function SoloNumeros(elEvento) {

    /**
     * Variable que define los caracteres permitidos
     * 
     * @var permitidos 
     */
    var permitidos = "0123456789";

    /**
     * Teclas especiales que se aceptan
     * 
     * 8 = BackSpace 
     * 13=Enter 
     * 37 = flecha izquierda 
     * 39 = flecha derecha
     * 46 = Supr 
     * 
     * @var teclas_especiales
     */
    teclas_especiales = [8, 37, 39, 46, 13];

    /**
     * Obtener la tecla pulsada
     * 
     * @var evento
     * @var codigoCaracter
     * @var caracter
     */
    evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);

    /**
     * Comprobar si la tecla pulsada es alguna de las teclas especiales
     * 
     * @var tecla_especial
     */
    var tecla_especial = false;
    for (var i in teclas_especiales) {
        if (codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    /**
     * Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
     */
    if (permitidos.indexOf(caracter) == -1) {
        if (tecla_especial == false) {
            alert('Este campo solo acepta números, por favor revise e intente nuevamente.');
        }
    }
    return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

/**
* Esta función permite validar que los campos del formulario de registro del cliente no se envien vacíos.
* este formulario se encuentra en el archivo vistas/registro.php
*/
function validarRegistro() {
    /**
    * Se crean las variables que almacenarán los elementos que están en el html.
    */
    /** 
    * Se obtiene id del elemento 'h5' que se llama 'alert' y este valor se guarda en la variable 'alerta'
    */
    var alerta = document.getElementById("alert");

    /** 
    * Se obtiene id del elemento 'input' que se llama 'documentoCliente' 
    * y este valor se guarda en la variable 'documentoCliente'
    * 
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertDocumento' 
    * y este valor se guarda en la variable 'alertDocumento'
    */
    var documentoCliente = document.getElementById("documentoCliente");
    var alertDocumento = document.getElementById("alertDocumento");

    /**
    * Se obtiene id del elemento 'input' que se llama 'nombreCliente' 
    * y este valor se guarda en la variable 'nombreUsuario'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertNombre' 
    * y este valor se guarda en la variable 'alertNombre'
    */
    var nombreUsuario = document.getElementById("nombreCliente");
    var alertNombre = document.getElementById('alertNombre');

    /**
    * Se obtiene id del elemento 'input' que se llama 'correoCliente' 
    * y este valor se guarda en la variable 'correoCliente'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertCorreo' 
    * y este valor se guarda en la variable 'alertCorreo'
    */
    var correoCliente = document.getElementById("correoCliente");
    var alertCorreo = document.getElementById("alertCorreo");

    /**
    * Se obtiene id del elemento 'input' que se llama 'edadCliente' 
    * y este valor se guarda en la variable 'edadCliente'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertEdad' 
    * y este valor se guarda en la variable 'alertEdad'
    */
    var edadCliente = document.getElementById("edadCliente");
    var alertEdad = document.getElementById("alertEdad");

    /**
    * Se obtiene id del elemento 'input' que se llama 'contrasena' 
    * y este valor se guarda en la variable 'contrasena'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertContrasena' 
    * y este valor se guarda en la variable 'alertContrasena'
    */
    var contrasena = document.getElementById("contrasena");
    var alertContrasena = document.getElementById("alertContrasena");

    /**
    * Se obtiene id del elemento 'input' que se llama 'ConfirmarContrasena' 
    * y este valor se guarda en la variable 'ConfirmarContrasena'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertConfirmarContrasena' 
    * y este valor se guarda en la variable 'alertConfirmarContrasena'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertContrasena2' 
    * y este valor se guarda en la variable 'alertContrasena2'
    */
    var confirmarContrasena = document.getElementById("ConfirmarContrasena");
    var alertConfirmarContrasena = document.getElementById("alertConfirmarContrasena");
    var alertContrasena2 = document.getElementById("alertContrasena2");

    /**
     * Se crea un condicional para validar que el campo del documento no este vacío.
     */
    if (documentoCliente.value == "" && nombreUsuario.value == "" && correoCliente.value == "" && edadCliente.value == "" &&
        contrasena.value == "" && confirmarContrasena.value == "") {

        /**
         * Se le hace un foco al campo documento para que el usuario pueda empezar a escribir;
         */
        documentoCliente.focus();

        /**
         * Al alert (h5) se le pone un color rojo y se pone un mensaje "*Todos los campos son obligatorios";
         */
        alerta.style.color = "rgba(231, 76, 60,0.8)";
        alerta.innerHTML = "*Todos los campos son olbigatorios";

        /**
         * Se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos 
         * a la base de datos.
         */
        return false;
    } else if (documentoCliente.value == "") {

        /**
         * Si el campo está vacío al campo del documento se le pone el borde rojo y una sombra para resaltarlo.
         */
        documentoCliente.style.border = "2px solid rgba(231, 76, 60,0.8)";
        documentoCliente.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Al h5 que corresponde al documento se le pone el mensaje "Este campo es obligatorio" y se pone de 
         * color rojo
         */
        alertDocumento.innerHTML = "*Este campo es obligatorio";
        alertDocumento.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos 
         * a la base de datos.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo del nombre de usuario no este vacío.
     */
    else if (nombreUsuario.value == "") {

        /**
         * Si el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
         */
        nombreUsuario.style.border = "2px solid rgba(231, 76, 60,0.8)";
        nombreUsuario.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Al h5 que corresponde al nombre de usuario se le pone el mensaje "Este campo es obligatorio" y 
         * se pone
         * de color rojo.
         */
        alertNombre.innerHTML = "*Este campo es obligatorio";
        alertNombre.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a 
         * la base de datos.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo del correo no este vacío.
     */
    else if (correoCliente.value == "") {
        /**
         * Sí el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
         */
        correoCliente.style.border = "2px solid rgba(231, 76, 60,0.8)";
        correoCliente.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Al h5 que corresponde al correo del usuario se le pone el mensaje "Este campo es obligatorio" y 
         * se pone de color rojo.
         */
        alertCorreo.innerHTML = "*Este campo es obligatorio";
        alertCorreo.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos 
         * a la base de datos.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo de la edad no este vacío.
     */
    else if (edadCliente.value == "") {

        /**
         * Sí el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
         */
        edadCliente.style.border = "2px solid rgba(231, 76, 60,0.8)";
        edadCliente.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Al h5 que corresponde a la edad del usuario se le pone el mensaje "Este campo es obligatorio" y 
         * se pone de color rojo.
         */
        alertEdad.innerHTML = "*Este campo es obligatorio";
        alertEdad.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos 
         * a la base de datos.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo de la contraseña no este vacío.
     */
    else if (contrasena.value == "") {

        /**
         * Sí el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
         */
        contrasena.focus();
        contrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
        contrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Al h5 que corresponde a la contraseña del usuario se le pone el mensaje "*Este campo es obligatorio" 
         * y se pone de color rojo.
         */
        alertContrasena.innerHTML = "*Este campo es obligatorio";
        alertContrasena.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a la BD.
         */
        return false;

    } 
    /**
     * Se crea un condicional para validar que el campo de la confirmar contraseña no este vacío.
     */
    else if (confirmarContrasena.value == "") {
        /**
         * Sí el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
         */
        confirmarContrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
        confirmarContrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Al h5 que corresponde a la contraseña del usuario se le pone el mensaje "*Este campo es obligatorio" 
         * y se pone de color rojo.
         */
        alertConfirmarContrasena.style.color = "rgba(231, 76, 60,0.8)";
        alertConfirmarContrasena.innerHTML = "*Este campo es obligatorio";
        return false;
    } 
    /**
     * Se crea un condicional para validar si las contraseñas son diferentes
     */
    else if (contrasena.value !== confirmarContrasena.value) {
        /**
         * si las contraseñas son diferentes
         */
        
        /**
         * Se selecciona la variable contrasena
         */
        contrasena.focus();
        /**
         * Al h5 que corresponde a la contraseña del usuario se le pone el mensaje "*las contraseñas no coinciden" 
         * y se pone de color rojo.
         */
        alertContrasena2.innerHTML = "*Las contraseñas no coinciden";
        alertContrasena2.style.color = "rgba(231, 76, 60,0.8)";
        return false;
    }
    /**
     * Si no se cumple ninguna de las condiciones se permitirá enviar los datos ingresados por el usuario.
     */
}

/**
 * Función para validar el registro de contacto que se encuentra en el documento index.php.
 */
function validar() {
    /**
    * Acá se crean las variables que almacenarán los campos del formulario que están en documento index.php.
    * 
    * Se obtiene id del elemento 'input' que se llama 'nombres' 
    * y este valor se guarda en la variable 'nombres' 
    * 
    * Se obtiene id del elemento 'input' que se llama 'apellidos' 
    * y este valor se guarda en la variable 'apellidos' 
    * 
    * Se obtiene id del elemento 'input' que se llama 'correo' 
    * y este valor se guarda en la variable 'correo' }
    * Se obtiene id del elemento 'input' que se llama 'mensaje' 
    * y este valor se guarda en la variable 'mensaje' 
    */
    var nombres = document.getElementById("nombres");
    var apellidos = document.getElementById("apellidos");
    var correo = document.getElementById("correo");
    var mensaje = document.getElementById("mensaje");

    /**
    * Se obtiene id del elemento 'h5' que se llama 'alert' 
    * y este valor se guarda en la variable 'alertA'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'textAlert' 
    * y este valor se guarda en la variable 'alert'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'textAlert2' 
    * y este valor se guarda en la variable 'alerta2'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'textAlert3' 
    * y este valor se guarda en la variable 'alerta3'
    *
    * Se obtiene id del elemento 'h5' que se llama 'textAlert4' 
    * y este valor se guarda en la variable 'alerta4'
     */
    var alertA = document.getElementById("alert");
    var alerta = document.getElementById("textAlert");
    var alerta2 = document.getElementById("textAlert2");
    var alerta3 = document.getElementById("textAlert3");
    var alerta4 = document.getElementById("textAlert4");

    /**
     * Se crea un condicional para validar sí todos los campos que estan dentro del formulario no esten vacios.
     */
    if(nombres.value == "" && apellidos.value == "" && correo.value == "" && mensaje.value == ""){
        /**
         * Si los campos estan vacios se selecciona el elemento 'alert' y con la función innerHTML escribimos 
         * el mensaje '*Todos los campos son obligatorios'
         * también se le pone un color rojo con la función 'style.color'
         */
        alertA.innerHTML = "*Todos los campos son obligatorios"
        alertA.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se returna flase para que el formulario no permita dejar en viar los campos vacios
         */
        return false
    }
    /**
     * Se crea un condicional para validar que el campo que corresponde al nombre no este vacío.
     */
    else if (nombres.value == "") {
        /**
         * Sí el campo está vacío...
         */

        /**
         * Se hace un focus
         */
        nombres.focus();

        /**
         * Y al campo se le pone el borde rojo y una sombra de color rojo para resaltarlo.
         */
        nombres.style.border = "2px solid rgba(231, 76, 60,0.8)";
        nombres.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * A los elementos h5 se le pone un mensaje que diga "Este campo es obligatorio".
         */
        alerta.innerHTML = "*Este campo es obligatorio";

        /**
         * Y se le pone un color rojo con 0.8 de opacidad.
         */
        alerta.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se hace un return false para que el formulario no haga ningún action.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo que corresponde al apellido no este vacío.
     */
    else if (apellidos.value == "") {
        /**
         * Sí el campo está vacío...
         */

        /**
         * Se hace un focus
         */
        apellidos.focus();

        /**
         * Y al campo se le pone el borde rojo y una sombra de color rojo para resaltarlo.
         */
        apellidos.style.border = "2px solid rgba(231, 76, 60,0.8)";
        apellidos.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * A los elementos h5 se le pone un mensaje que diga "Este campo es obligatorio".
         */
        alerta2.innerHTML = "*Este campo es obligatorio";

        /**
         * Y se le pone un color rojo con 0.8 de opacidad.
         */
        alerta2.style.color = "rgba(231, 76, 60,0.8)";


        /**
         * Se hace un return false para que el formulario no haga ningún action.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo que corresponde al correo no este vacío.
     */
    else if (correo.value == "") {
        /**
         * Sí el campo está vacío...
         */

        /**
         * Se hace un focus
         */
        correo.focus();

        /**
         * Y al campo se le pone el borde rojo y una sombra de color rojo para resaltarlo.
         */
        correo.style.border = "2px solid rgba(231, 76, 60,0.8)";
        correo.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * A los elementos h5 se le pone un mensaje que diga "Este campo es obligatorio".
         */
        alerta3.innerHTML = "Este campo es obligatorio";

        /**
         * Y se le pone un color rojo con 0.8 de opacidad.
         */
        alerta3.style.color = "rgba(231, 76, 60,0.8)";


        /**
         * Se hace un return false para que el formulario no haga ningún action.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo que corresponde al mensaje no este vacío.
     */
    else if (mensaje.value == "" ) {
        /**
         * Sí el campo está vacío...
         */

        /**
         * Se hace un focus
         */
        mensaje.focus();

        /**
         * Y al campo 'mensaje' se le pone el borde rojo y una sombra de color rojo para resaltarlo.
         */
        mensaje.style.border = "2px solid rgba(231, 76, 60,0.8)";
        mensaje.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        alerta4.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * A los elementos h5 se le pone un mensaje que diga "Este campo es obligatorio".
         */
        alerta4.innerHTML = "*Este campo es obligatorio";

        /**
         * Se le pone una margen para que este bien posicionado
         */
        alerta4.style.margin = "-20px 0 0 0";

        /**
         * Se hace un return false para que el formulario no haga ningún action.
         */
        return false;
    }
    /**
     * Si no se cumple ninguna de las condiciones se permitirá enviar los datos ingresados por el usuario.
     */
}

/**
 * La función validarInicioSesion permite validar que los campos del fomulario de inicio se sesión del documento 
 * iniciar_sesion.php no estén vacíos.
 */
function validarInicioSesion() {

    /**
    * Acá se crean las variables que almacenarán los campos del formulario que están en el documento iniciar_sesion.php.
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alert' 
    * y este valor se guarda en la variable 'alert' 
    * 
    * Se obtiene id del elemento 'input' que se llama 'documento' 
    * y este valor se guarda en la variable 'documento'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertDocumento' 
    * y este valor se guarda en la variable 'alertDocumento' 
    * 
    * Se obtiene id del elemento 'input' que se llama 'contrasena' 
    * y este valor se guarda en la variable 'contrasena' 
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertContrasena' 
    * y este valor se guarda en la variable 'alertContrasena'
    * 
    * Se obtiene id del elemento 'input' que se llama 'rol' 
    * y este valor se guarda en la variable 'rol'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertRol' 
    * y este valor se guarda en la variable 'alertRol'    
    */
    var alert = document.getElementById('alert');
    var documento = document.getElementById('documento');
    var alertDocumento = document.getElementById('alertDocumento');
    var contrasena = document.getElementById('contrasena');
    var alertContrasena = document.getElementById('alertContrasena');
    var rol = document.getElementById('rol');
    var alertRol = document.getElementById('alertRol');

    /**
     * Se crea un condicional para validar que ningúno de los campos estén vacíos.
     */
    if (documento.value == "" && contrasena.value == "" && rol.value == "rol") {

        /**
         * Si todos los campos están vacíos..
         */

        /**
         * Se mostrará un mensaje que diga "*Todos los campos son olbigatorios"
         */
        alert.innerHTML = "*Todos los campos son obligatorios";

        /**
         * Y se le pone un color rojo con 0.8 de opacidad.
         */
        alert.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se hace un foco al campo documento para que el usuario pueda empezar a escribir.
         */
        documento.focus();

        /**
         * Se retorna un false para que el formulario no ejecute un action.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo documento no este vacio.
     */
    else if (documento.value == "") {
        /**
         * Si todos los campos están vacíos..
         */

        /**
         * Se hace un foco al campo documento para que el usuario pueda empezar a escribir.
         */
        documento.focus();

        /**
         * Se mostrará un mensaje que diga "Este campo es obligatorio"
         */
        alertDocumento.innerHTML = "Este campo es obligatorio";

        /**
         * Se le pone un color rojo con 0.8 de opacidad .
         */
        alertDocumento.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Al campo documento se le pone un borde y una sombra de color rojo con 0.8 opacidad;
         */
        documento.style.border = "2px solid rgba(231, 76, 60,0.8)";
        documento.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Se retorna un false para que el formulario no ejecute un action.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo documento no este vacio.
     */
    else if (contrasena.value == "" || contrasena.value == null) {
        /**
         * Si todos los campos están vacíos..
         */

        /**
         * Se hace un foco al campo contraseña para que el usuario pueda empezar a escribir.
         */
        contrasena.focus();

        /**
         * Al campo contraseña se le pone un borde y una sombra de color rojo con 0.8 opacidad;
         */
        contrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
        contrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Se mostrará un mensaje que diga "*Este campo es obligatorio"
         */
        alertContrasena.innerHTML = "*Este campo es obligatorio";

        /**
         * Se le pone un color rojo con 0.8 de opacidad .
         */
        alertContrasena.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se retorna un false para que el formulario no ejecute un action.
         */
        return false;
    }
    /**
     * Se crea un condicional para validar que el campo rol no este vacio.
     */
    else if (rol.value == "rol" || rol.value == null) {

        /**
         * Si todos los campos están vacíos..
         */

        /**
         * Se hace un foco al campo rol para que el usuario pueda empezar a escribir.
         */
        rol.focus();

        /**
         * Al campo rol se le pone un borde y una sombra de color rojo con 0.8 opacidad;
         */
        rol.style.border = "2px solid rgba(231, 76, 60,0.8)";
        rol.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Se mostrará un mensaje que diga "*Este campo es obligatorio"
         */
        alertRol.innerHTML = "*Este campo es obligatorio";

        /**
         * Se le pone un color rojo con 0.8 de opacidad .
         */
        alertRol.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se retorna un false para que el formulario no ejecute un action.
         */
        return false;
    }
    /**
     * Si no se cumple ninguna de las condiciones se permitirá enviar los datos ingresados por el usuario.
     */
}
/**
 * Se crea la función 'validarRecuperarContrasena' para validar los campos que tien el formulario de 
 * recuperar contraseña
 */

function validarRecuperarContrasena(){
    /**
     * Acá se crean las variables que almacenarán los campos del formulario que están en el documento iniciar_sesion.php.
    *
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertContrasena2' 
    * y este valor se guarda en la variable 'alertContrasena2'
    * 
    * Se obtiene id del elemento 'input' que se llama 'rolRecuperarContrasena' 
    * y este valor se guarda en la variable 'rolRecuperarContrasena'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertRecuperarContrasena' 
    * y este valor se guarda en la variable 'alertRecuperarContrasena'
    * 
    * Se obtiene id del elemento 'input' que se llama 'correoRecuperarContrasena' 
    * y este valor se guarda en la variable 'correoRecuperarContrasena'
    *
    * Se obtiene id del elemento 'h5' que se llama 'alertCorreo' 
    * y este valor se guarda en la variable 'alertCorreo'
    */
    var alertContrasena2 = document.getElementById("alertContrasena2");
    var rolRecuperarContrasena = document.getElementById("rolRecuperarContrasena");
    var alertRecuperarContrasena = document.getElementById("alertRecuperarContrasena");
    var correoRecuperarContrasena = document.getElementById("correoRecuperarContrasena");
    var alertCorreo = document.getElementById("alertCorreo");

    /**
     * Se crea un condicional para validar que ningúno de los campos estén vacíos.
     */
    if(rolRecuperarContrasena.value == "rolcontrasena" && correoRecuperarContrasena.value == ""){
        /**
         * Se mostrará un mensaje que diga "*Este campo es obligatorio"
         */
        alertContrasena2.innerHTML = "*Todos los campos son obligatorios";
        /**
         * Se le pone un color rojo con 0.8 de opacidad .
         */
        alertContrasena2.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se retorna un false para que el formulario no ejecute un action.
         */
        return false;
        
    }
    /**
     * Se crea un codicional para validar que el campo de opcion multiple 'rol' no este vacio
     */
    else if(rolRecuperarContrasena.value == "rolcontrasena"){
        /**
         * Se mostrará un mensaje que diga "*Este campo es obligatorio"
         */
        alertRecuperarContrasena.innerHTML = "*Este campo es obligatorio";
        /**
         * Se le pone un color rojo con 0.8 de opacidad .
         */
        alertRecuperarContrasena.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Al campo rol se le pone un borde y una sombra de color rojo con 0.8 opacidad;
         */
        rolRecuperarContrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
        /**
         * Se le agrega una cosmbra alredor del campo y es de color rojo
         */
        rolRecuperarContrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Se retorna un false para que el formulario no ejecute un action.
         */
        return false;
        
    }
    /**
     * Se crea un condicional para validar que el campo 'correo' no quede vacio  
     */
    else if(correoRecuperarContrasena.value == ""){
        /**
         * Se le agrega una posición relativa para poder acomodarlo y que sea mas visible
         */
        alertCorreo.style.position = "relative";
        alertCorreo.style.top = "-20px";
        /**
         * Se mostrará un mensaje que diga "*Este campo es obligatorio"
         */
        alertCorreo.innerHTML = "*Este campo es obligatorio";
        /**
         * Se le pone un color rojo con 0.8 de opacidad .
         */
        alertCorreo.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Al campo rol se le pone un borde y una sombra de color rojo con 0.8 opacidad;
         */
        correoRecuperarContrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
         /**
         * Se le agrega una cosmbra alredor del campo y es de color rojo
         */
        correoRecuperarContrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Se retorna un false para que el formulario no ejecute un action.
         */
        return false
    }
}
/**
 * Se crea una función para validar que los campos del formulario que esta en el documento categorias.php no 
 * esten vacíos 
 */
function validarRegistroDeProductos() {
    /**
    * Se obtiene id del elemento 'h5' que se llama 'alert' 
    * y este valor se guarda en la variable 'alerta'
    *
    * Se obtiene id del elemento 'h5' que se llama 'alertNombre' 
    * y este valor se guarda en la variable 'alertNombre'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertPrecio' 
    * y este valor se guarda en la variable 'alertPrecio'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertDescripcion' 
    * y este valor se guarda en la variable 'alertDescripcion'
    * 
    * Se obtiene id del elemento 'h5' que se llama 'alertCategoria' 
    * y este valor se guarda en la variable 'alertCategoria'  
     */
    var alerta = document.getElementById('alert');
    var alertNombre = document.getElementById('alertNombre');
    var alertPrecio = document.getElementById('alertPrecio');
    var alertDescripcion = document.getElementById('alertDescripcion');
    var alertCategoria = document.getElementById('alertCategoria');
    /**
    * 
    * Se obtiene id del elemento 'input' que se llama 'nombreProducto' 
    * y este valor se guarda en la variable 'nombreProducto'
    * 
    * Se obtiene id del elemento 'input' que se llama 'precioProducto' 
    * y este valor se guarda en la variable 'precioProducto'
    * 
    * Se obtiene id del elemento 'input' que se llama 'descripcionProducto' 
    * y este valor se guarda en la variable 'descripcionProducto'
    * 
    * Se obtiene id del elemento 'input' que se llama 'categoriaProducto' 
    * y este valor se guarda en la variable 'categoriaProducto'
    */
    var nombreProducto = document.getElementById('nombreProducto');
    var precioProducto = document.getElementById('precioProducto');
    var descripcionProducto = document.getElementById('descripcionProducto');
    var categoriaProducto = document.getElementById('categoriaProducto');

    /**
     * Se crea un condicional para saber si ningun campo está vacío
     */
    if (nombreProducto.value == "" && precioProducto.value == "" && descripcionProducto.value == "" && categoriaProducto.value == "cate") {

        /**
         * Si todos lo campos están vacios..
         */
        /**
         * Se le hace un foco al primer campo que es "nombreProducto"
         */
        nombreProducto.focus();

        /**
         * Al alert(h5) se le pone un color rojo 
         */
        alerta.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se le pone un mensaje "*Todos los campos son obligatorios"
         */
        alerta.innerHTML = "*Todos los campos son obligatorios";

        /**
         * Se retorna false para que no deje que el formulario haga un action
         */
        return false;
    }
    /**
     * Se crea un condicional para saber si el campo del nombre del producto esta vacío.
     */
    else if (nombreProducto.value == "") {

        /**
         * Si el está vacío...
         */

        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        nombreProducto.focus();

        /**
         * Al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertNombre.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertNombre.innerHTML = "*Este campo es obligatorio";

        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        nombreProducto.style.border = "2px solid rgba(231, 76, 60,0.8)";
        nombreProducto.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    /**
     * Se crea un condicional para saber si el campo del precio del producto esta vacío.
     */
    else if (precioProducto.value == "") {

        /**
         * Si el está vacío...
         */

        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        precioProducto.focus();

        /**
         * Al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertPrecio.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertPrecio.innerHTML = "*Este campo es obligatorio";

        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        precioProducto.style.border = "2px solid rgba(231, 76, 60,0.8)";
        precioProducto.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    /**
     * Se crea un condicional para saber si el campo de la descripción del producto esta vacío.
     */
    else if (descripcionProducto.value == "") {
        /**
         * Si el está vacío...
         */

        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        descripcionProducto.focus();

        /**
         * Al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertDescripcion.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertDescripcion.innerHTML = "*Este campo es obligatorio";
        alertDescripcion.style.margin = "-15px 0 10px";
        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        descripcionProducto.style.border = "2px solid rgba(231, 76, 60,0.8)";
        descripcionProducto.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    /**
     * Se crea un condicional para saber si el campo de la descripción del producto esta vacío.
     */
    else if (categoriaProducto.value == "cate") {
        /**
         * Si el está vacío...
         */

        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        categoriaProducto.focus();
        /**
         * Al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertCategoria.style.color = "rgba(231, 76, 60,0.8)";

        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertCategoria.innerHTML = "*Este campo es obligatorio";

        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        categoriaProducto.style.border = "2px solid rgba(231, 76, 60,0.8)";
        categoriaProducto.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";

        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    /**
     * Si no se cumple ninguna de las condiciones y no existe ningun campo vacío se puede enviar los datos del formulario.
     */
}
function validarFormularioEvento(){
    /**
    * Se obtiene id del elemento 'input' que se llama 'nombreEvento' 
    * y este valor se guarda en la variable 'nombreEvento'
    */
    var nombreEvento = document.getElementById("nombreEvento");
    if(nombreEvento.value == ""){
    /**
    * Se le pone un mensaje que diga "*Este campo es obligatorio"
    */
    alertNombreEvento.innerHTML = "*Este campo es obligatorio";
    /**
    * Al alert(h5) se le pone un color rojo con 0.8 de opacidad
    */
     alertNombreEvento.style.color = "rgba(231, 76, 60,0.8)";
        
    /**
    * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
    */
    nombreEvento.style.border = "2px solid rgba(231, 76, 60,0.8)";
    nombreEvento.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
    /**
    * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
    */
    return false;
    }
}
/**
 * Se crea la función validarFormularioCancion() la cual permite que validar que el campo donde el usuario ingresa 
 * el nombre de la canción, no se envie vacío. El archivo de este formulario se encuentra en el la carpeta.
 * vistas/categoriacanciones_usuario.php.
 */
function validarFormularioCancion(){
    /**
    *
    * Se obtiene id del elemento 'input' que se llama 'nombreCancion' 
    * y este valor se guarda en la variable 'nombreCancion'
    * 
    */
    var nombreCancion = document.getElementById("nombreCancion");
    /**
    * Se obtiene id del elemento 'h5' que se llama 'alertaNombreCancion' 
    * y este valor se guarda en la variable 'alertaNombreCancion'  
    */
    var alertaNombreCancion = document.getElementById("alertaNombreCancion"); 
    if(nombreCancion.value == ""){
        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        nombreCancion.style.border = "2px solid rgba(231, 76, 60,0.8)";
        nombreCancion.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
         /**
            * Se le pone un mensaje que diga "*Este campo es obligatorio"
        */
        alertaNombreCancion.innerHTML = "*Este campo es obligatorio";
        /**
            * Al alert(h5) se le pone un color rojo con 0.8 de opacidad
        */
        alertaNombreCancion.style.color = "rgba(231, 76, 60,0.8)";
        /**
        * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
        */
        return false;
    }
}
function validarCarrito(){
    var numeroMesa = document.getElementById("numeroMesa");
    var alertaNumeroMesa = document.getElementById("alertaNumeroMesa");
    if(numeroMesa.value == ""){
         /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        numeroMesa.style.border = "2px solid rgba(231, 76, 60,0.8)";
        numeroMesa.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
        * Al alert(h5) se le pone un color rojo con 0.8 de opacidad
        */
        alertaNumeroMesa.innerHTML = "*Este campo es obligatorio";
        alertaNumeroMesa.style.color = "rgba(231, 76, 60,0.8)";
        return false;
    }
}