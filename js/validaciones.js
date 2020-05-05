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
/**
 * Esta función permite validar que los campos del formulario de registro del cliente no se envien vacíos.
 */
function validarRegistro(){
    /**
     * Acá se crean las variables que almacenarán los elementos que están en el html.
     */
    /**
     * se obtiene el elemento h5 que almacenará el mensaje.
     */
    var alerta = document.getElementById("alert");

    /**
     * se obtiene los id's de los campos que corresponde al documento del cliente y al h5 del documento.
     */
    var documentoCliente = document.getElementById("documentoCliente");
    var alertDocumento = document.getElementById("alertDocumento");
    /**
     * se obtiene los id's de los campos que corresponde al nombre del cliente y al h5 del nombre.
     */
    var nombreUsuario = document.getElementById("nombreCliente");
    var alertNombre = document.getElementById('alertNombre');
    /**
     * se obtiene los id's de los campos que corresponde al correo del cliente y al h5 del correo.
     */
    var correoCliente = document.getElementById("correoCliente");
    var alertCorreo = document.getElementById("alertCorreo");
    /**
     * se obtiene los id's de los campos que corresponde a la edad del cliente y al h5 de la edad.
     */
    var edadCliente = document.getElementById("edadCliente");
    var alertEdad = document.getElementById("alertEdad");
    /**
     * se obtiene los id's de los campos que corresponde a la contraseña del cliente y al h5 de la contraseña.
     */
    var contrasena = document.getElementById("contrasena");
    var alertContrasena = document.getElementById("alertContrasena");
    /**
     * 
     */

     var confirmarContrasena = document.getElementById("ConfirmarContrasena");
     var alertConfirmarContrasena = document.getElementById("alertConfirmarContrasena");
     var alertContrasena2 = document.getElementById("alertContrasena2");
    /**
     * se crea un condicional para validar que el campo del documento no este vacío.
     */
    if(documentoCliente.value == "" && nombreUsuario.value == "" && correoCliente.value == "" && edadCliente.value == "" && 
        contrasena.value == "" && confirmarContrasena.value ==""){
            /**
             * se le hace un foco al campo documento para que el usuario pueda empezar a escribir;
             */
            documentoCliente.focus();
            /**
             * Al alert (h5) se le pone un color rojo y se pone un mensaje "*Todos los campos son obligatorios";
             */
            alerta.style.color = "rgba(231, 76, 60,0.8)";
            alerta.innerHTML = "*Todos lo campos son olbigatorios";
            /**
         * se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a la BD.
         */
            return false;
    }
    else if(documentoCliente.value == ""){
        /**
         * si el campo está vacío al campo del documento se le pone el borde rojo y una sombra para resaltarlo.
         */
        documentoCliente.style.border = "2px solid rgba(231, 76, 60,0.8)";
        documentoCliente.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Al h5 que corresponde al documento se le pone el mensaje "Este campo es obligatorio" y se pone de color rojo
         */
        alertDocumento.innerHTML = "*Este campo es obligatorio";
        alertDocumento.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a la BD.
         */
        return false;
    }
    /**
     * se crea un condicional para validar que el campo del nombre de usuario no este vacío.
     */
    else if(nombreUsuario.value == ""){
        /**
         * si el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
         */
        nombreUsuario.style.border = "2px solid rgba(231, 76, 60,0.8)";
        nombreUsuario.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Al h5 que corresponde al nombre de usuario se le pone el mensaje "Este campo es obligatorio" y se pone de color rojo.
         */
        alertNombre.innerHTML = "*Este campo es obligatorio";
        alertNombre.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a la BD.
         */
        return false;

    }
    /**
     * se crea un condicional para validar que el campo del correo no este vacío.
     */
    else if(correoCliente.value == ""){
        /**
        * sí el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
        */
        correoCliente.style.border = "2px solid rgba(231, 76, 60,0.8)";
        correoCliente.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Al h5 que corresponde al correo del usuario se le pone el mensaje "Este campo es obligatorio" y se pone de color rojo.
         */
        alertCorreo.innerHTML = "*Este campo es obligatorio";
        alertCorreo.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a la BD.
         */
        return false;
    }
    /**
     * se crea un condicional para validar que el campo de la edad no este vacío.
     */
    else if (edadCliente.value == ""){
        /**
        * sí el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
        */
        edadCliente.style.border = "2px solid rgba(231, 76, 60,0.8)";
        edadCliente.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Al h5 que corresponde a la edad del usuario se le pone el mensaje "Este campo es obligatorio" y se pone de color rojo.
         */
        alertEdad.innerHTML = "*Este campo es obligatorio";
        alertEdad.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a la BD.
         */
        return false;
    }
    
    /**
     * se crea un condicional para validar que el campo de la contraseña no este vacío.
     */
    else if (contrasena.value ==""){
        /**
        * sí el campo está vacío se le pone el borde rojo y una sombra para resaltarlo.
        */
        contrasena.focus();
        contrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
        contrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Al h5 que corresponde a la contraseña del usuario se le pone el mensaje "*Este campo es obligatorio" y se pone de color rojo.
         */
        alertContrasena.innerHTML = "*Este campo es obligatorio";
        alertContrasena.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * se retorna "false" para que no permita que el formulario haga un action y no se envie datos vacíos a la BD.
         */
        return false;
    }
    else if(confirmarContrasena.value == ""){
        confirmarContrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
        confirmarContrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        alertConfirmarContrasena.style.color = "rgba(231, 76, 60,0.8)";
        alertConfirmarContrasena.innerHTML = "*Este campo es obligatorio";
        return false;
    }
    else if(contrasena.value !== confirmarContrasena.value){
        contrasena.focus();
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
function validar(){
    /**
     * Acá se crean las variables que almacenarán los campos del formulario que están en documento index.php.
     */
    var nombres = document.getElementById("nombres");
    var apellidos = document.getElementById("apellidos");
    var correo = document.getElementById("correo");
    var mensaje = document.getElementById("mensaje");
    /**
     * se crean las variables que almacenarán los mensajes de alerta que esta en el hmtl.
     */
    var alerta = document.getElementById("textAlert");
    var alerta2 = document.getElementById("textAlert2");
    var alerta3 = document.getElementById("textAlert3");
    var alerta4 = document.getElementById("textAlert4");
    /**
     * se crea un condicional para validar que el campo que corresponde al nombre no este vacío.
     */
    if(nombres.value == ""){
        /**
        * sí el campo está vacío...
        */

       /**
        * se hace un focus
        */
        nombres.focus();
        /**
         * y al campo se le pone el borde rojo y una sombra de color rojo para resaltarlo.
         */
        nombres.style.border = "2px solid rgba(231, 76, 60,0.8)";
        nombres.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * A los elementos h5 se le pone un mensaje que diga "Este campo es obligatorio".
         */
        alerta.innerHTML = "Este campo es obligatorio";
        /**
         * Y se le pone un color rojo con 0.8 de opacidad.
         */
        alerta.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se le pone una margen para que este bien posicionado
         */
        alerta.style.margin = "-20px 0 0 0";
        /**
         * se hace un return false para que el formulario no haga ningún action.
         */
        return false;
    }
    /**
     * se crea un condicional para validar que el campo que corresponde al apellido no este vacío.
     */
    else if(apellidos.value == ""){
        /**
        * sí el campo está vacío...
        */

        /**
        * se hace un focus
        */
        apellidos.focus();
        /**
         * y al campo se le pone el borde rojo y una sombra de color rojo para resaltarlo.
         */
        apellidos.style.border = "2px solid rgba(231, 76, 60,0.8)";
        apellidos.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * A los elementos h5 se le pone un mensaje que diga "Este campo es obligatorio".
         */
        alerta2.innerHTML = "Este campo es obligatorio";
        /**
         * Y se le pone un color rojo con 0.8 de opacidad.
         */
        alerta2.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se le pone una margen para que este bien posicionado
         */
        alerta2.style.margin = "-20px 0 0 0";
        /**
         * se hace un return false para que el formulario no haga ningún action.
         */
        return false;
    }
    /**
     * se crea un condicional para validar que el campo que corresponde al correo no este vacío.
     */
    else if(correo.value ==""){
        /**
        * sí el campo está vacío...
        */

        /**
        * se hace un focus
        */
        correo.focus();
        /**
         * y al campo se le pone el borde rojo y una sombra de color rojo para resaltarlo.
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
        * Se le pone una margen para que este bien posicionado
        */
        alerta3.style.margin = "-20px 0 0 0";
        /**
        * se hace un return false para que el formulario no haga ningún action.
        */
        return false;
    }
    /**
     * se crea un condicional para validar que el campo que corresponde al mensaje no este vacío.
     */
    else if(mensaje.value ==""){
        /**
        * sí el campo está vacío...
        */

        /**
        * se hace un focus
        */
        mensaje.focus();
        /**
        * y al campo se le pone el borde rojo y una sombra de color rojo para resaltarlo.
        */
        mensaje.style.border = "2px solid rgba(231, 76, 60,0.8)";
        mensaje.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * A los elementos h5 se le pone un mensaje que diga "Este campo es obligatorio".
         */
        alerta4.innerHTML = "Este campo es obligatorio";
        /**
        * Y se le pone un color rojo con 0.8 de opacidad.
        */
        alerta4.style.color = "rgba(231, 76, 60,0.8)";
        /**
        * Se le pone una margen para que este bien posicionado
        */
        alerta4.style.margin = "-20px 0 0 0";
        /**
        * se hace un return false para que el formulario no haga ningún action.
        */
        return false;
    }  
    /**
     * Si no se cumple ninguna de las condiciones se permitirá enviar los datos ingresados por el usuario.
     */
}
/**
 * la función validarInicioSesion permite validar que los campos del fomulario de inicio se sesión del documento 
 * iniciar_sesion.php no estén vacíos.
 */
function validarInicioSesion(){
    /**
    * Acá se crean las variables que almacenarán los campos del formulario que están en el documento iniciar_sesion.php.
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
    if(documento.value == "" && contrasena.value == "" && rol.value == "rol"){
        /**
         * si todos los campos están vacíos..
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
    else if(documento.value == ""){
        /**
         * si todos los campos están vacíos..
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
         * al campo documento se le pone un borde y una sombra de color rojo con 0.8 opacidad;
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
    else if(contrasena.value == "" || contrasena.value == null){
        /**
         * si todos los campos están vacíos..
         */

        /**
        * Se hace un foco al campo contraseña para que el usuario pueda empezar a escribir.
        */
        contrasena.focus();
        /**
         * al campo contraseña se le pone un borde y una sombra de color rojo con 0.8 opacidad;
         */
        contrasena.style.border = "2px solid rgba(231, 76, 60,0.8)";
        contrasena.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
        * Se mostrará un mensaje que diga "Este campo es obligatorio"
        */
        alertContrasena.innerHTML = "Este campo es obligatorio";
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
    else if(rol.value == "rol" || rol.value == null){
        /**
         * si todos los campos están vacíos..
         */

        /**
        * Se hace un foco al campo rol para que el usuario pueda empezar a escribir.
        */
        rol.focus();
        /**
         * al campo rol se le pone un borde y una sombra de color rojo con 0.8 opacidad;
         */
        rol.style.border = "2px solid rgba(231, 76, 60,0.8)";
        rol.style.boxShadow = "0 0 5px rgba(231, 76, 60,0.8)";
        /**
        * Se mostrará un mensaje que diga "Este campo es obligatorio"
        */
        alertRol.innerHTML = "Este campo es obligatorio";
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
* Se crea una función para validar que los campos del formulario que esta en el documento categorias.php no esten vacíos 
*/
function validarRegistroDeProductos(){
    /**
     * se obtiene los id's de los elementos y se guardan en variables
     */
    var alerta = document.getElementById('alert');
    var alertNombre = document.getElementById('alertNombre');
    var alertPrecio = document.getElementById('alertPrecio');
    var alertDescripcion = document.getElementById('alertDescripcion');
    var alertCategoria = document.getElementById('alertCategoria');
    var nombreProducto = document.getElementById('nombreProducto');
    var precioProducto = document.getElementById('precioProducto');
    var descripcionProducto = document.getElementById('descripcionProducto');
    var categoriaProducto = document.getElementById('categoriaProducto');
    /**
    * Se crea un condicional para saber si ningun campo está vacío
    */
   if(nombreProducto.value == "" && precioProducto.value == "" && descripcionProducto.value == "" && categoriaProducto.value == "cate"){
        /**
        * si todos lo campos están vacios..
        */
       /**
        * Se le hace un foco al primer campo que es "nombreProducto"
        */
        nombreProducto.focus();
        /**
         * al alert(h5) se le pone un color rojo 
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
    else if(nombreProducto.value == ""){
        /**
         * Si el está vacío...
         */
        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        nombreProducto.focus();
        /**
         * al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertNombre.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertNombre.innerHTML = "*Este campo es obligatorio";
        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        nombreProducto.style.border ="2px solid rgba(231, 76, 60,0.8)";
        nombreProducto.style.boxShadow ="0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    
    /**
     * Se crea un condicional para saber si el campo del precio del producto esta vacío.
     */
    else if(precioProducto.value == ""){
        /**
         * Si el está vacío...
         */
        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        precioProducto.focus();
        /**
         * al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertPrecio.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertPrecio.innerHTML = "*Este campo es obligatorio";
        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        precioProducto.style.border ="2px solid rgba(231, 76, 60,0.8)";
        precioProducto.style.boxShadow ="0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    
    /**
     * Se crea un condicional para saber si el campo de la descripción del producto esta vacío.
     */
    else if(descripcionProducto.value==""){
         /**
         * Si el está vacío...
         */
        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        descripcionProducto.focus();
        /**
         * al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertDescripcion.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertDescripcion.innerHTML = "*Este campo es obligatorio";
        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        descripcionProducto.style.border ="2px solid rgba(231, 76, 60,0.8)";
        descripcionProducto.style.boxShadow ="0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    /**
     * Se crea un condicional para saber si el campo de la descripción del producto esta vacío.
     */
    else if(categoriaProducto.value == "cate"){
        /**
         * Si el está vacío...
         */
        /**
         * Se le hace un foco al campo para que el usuario pueda empezar a escribir.
         */
        categoriaProducto.focus();
        /**
         * al alert(h5) se le pone un color rojo con 0.8 de opacidad
         */
        alertCategoria.style.color = "rgba(231, 76, 60,0.8)";
        /**
         * Se le pone un mensaje que diga "*Este campo es obligatorio"
         */
        alertCategoria.innerHTML = "*Este campo es obligatorio";
        /**
         * Al campo se le pone un borde y una sombra de color rojo con 0.8 de opacidad para que resalte
         */
        categoriaProducto.style.border ="2px solid rgba(231, 76, 60,0.8)";
        categoriaProducto.style.boxShadow ="0 0 5px rgba(231, 76, 60,0.8)";
        /**
         * Se retorna false para que el form no ejecute ningun action y no se envie nada vacío.
         */
        return false;
    }
    /**
     * Si no se cumple ninguna de las condiciones y no existe ningun campo vacío se puede enviar los datos del formulario.
     */
}