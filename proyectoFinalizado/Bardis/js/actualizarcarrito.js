var inicio = function() {
    /**
     * Se trae el nombre de la clase del inpunt en este caso "cantidad", el cual captura un evento
     * key up del usuario en la funcion 'e', ese input está en el archivo vercarrito.php
     */
    $(".cantidad").keyup(function(e) {
        /**
         * Primero se valida si el campo está vacio o no 
         */
        if ($(this).val() != '') {
            /**
             * Si el evento 'e' es igual a 13, es decir a la tecla enter
             */
            if (e.keyCode == 13) {
                /**
                 * Se crean tres variables en las que se captura los atributos que se colocaron en el html
                 * 
                 * @var id              Id del producto
                 * @var precio          Precio del producto
                 * @var cantidad        Cantidad del producto
                 */
                var id = $(this).attr('data-id');
                var precio = $(this).attr('data-precio');
                var cantidad = $(this).val();

                /**
                 * Con this se hace referencia a cantidad, luego se indica que navegue hasta el div que sea
                 * producto, y luego de ese producto busque el objeto que por clase sea subtotal, y que le 
                 * cambie su contenido por el nuevo subtotal
                 */
                $(this).parentsUntil('.producto').find('.subtotal').text('Subtotal: ' + (precio * cantidad));
                /**
                 * Con una petición post se va al archivo modificar cantidad, se le pasan por parametros el
                 * id, el precio y la cantidad, y se dice que se va a recibir una función 
                 */
                $.post('../php/modificarcantidad.php', {
                        Id: id,
                        Precio: precio,
                        Cantidad: cantidad
                    },
                    /**
                     * En la variable 'e' se captura el total, para actualizar el total en el td del html
                     */
                    function(e) {
                        $("#total").text('Total: ' + e);
                    });
            }
        }
    });
}