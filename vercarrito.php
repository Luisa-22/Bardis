<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Se inicia la sesión
 */
session_start();

/**
 * Si existe la sesion del mesero haga lo sgte.
 */
if ($_SESSION['mesero']) {

  /**
   * 
   * Si la session del carrito existe entonces va a validar lo sgte.
   */
  if (isset($_SESSION['carrito'])) {

    /**
     * Si se trae el id del producto que se va a agregar al pedido,el cuál se está enviando desde el archvio 
     * categoriasnuevas.php entonces haga lo sgte.
     */
    if (isset($_GET['id'])) {

    /**
     * 
     * Se define una variable $arreglo para que almacene la información de la sesion del carrito
     */
     $arreglo = $_SESSION['carrito'];

      /**
       * Se definen dos variables, una que es $encontro de tipo booleano, inicializada en falso y
       * la otra es $posicion de tipo entero, inicializada en cero.
       * 
       * @var boolean $encontro 
       * @var integer $posicion 
       */
      $encontro = false; 
      $posicion = 0; 

      /**
       * 
       * Se valida si el id del producto que se envia por la url del archivo categoriasnuevas.php ya
       * le habían dado click, es decir si ya estaba agregado al pedido,para aumentar en +1 su cantidad
       * 
       * Ciclo for, donde i comienza en 0 hasta que i sea menor al numero de posiciones del arreglo
       */
      for ($i = 0; $i < count($arreglo); $i++) {

        /**
         * 
         * Si el id del producto que hay en el arreglo en la posición $i es igual al id del producto que 
         * se recibe por el método get del archivo categoriasnuevas.php entonces le damos el valor de 
         * verdadero la variable $encontro, ya que encontró un resultado
         *
         */
        if ($arreglo[$i]['Id'] == $_GET['id']) {
          $encontro = true;

          /**
           * Se almacena el valor de $i donde se encontró el resultado en la variable $posicion
           */
          $posicion = $i;
        }
      }

      /**
       * 
       * Se sale del ciclo
       * 
       * Y se valida si la variable $encontro es igual a verdadero
       */
      if ($encontro == true) {

        /**
         * 
         * Entonces al arreglo en la posición que se encontró el resultado, la cantidad es igual
         * a la misma cantidad más uno(1)
         */
        $arreglo[$posicion]['Cantidad'] =$arreglo[$posicion]['Cantidad']+1;

        /**
        * Se almacena en la sesion del carrito el arreglo, para que esté actualizado
        */
        $_SESSION['carrito']=$arreglo;

        /**
         * De lo contrario se almacena un nuevo producto en el arreglo
         */
      } else {

        /**
         * Se crean las variables para almacenar la información necesaria de un producto,el id del 
         * producto se trae por la url del archivo categoriasnuevas.php, el nombre se deja
         * vacío y es de tipo cadena de caracteres, el precio se inicializa en cero(0) y es de tipo 
         * decimal
         * 
         * @var integer $id       Id del producto
         * @var string $nombre    Nombre del producto
         * @var float $precio     Precio del producto
         */
        $id = $_GET['id'];
        $nombre = "";
        $precio = 0;

        /**
         * Consulta a la base de datos tabla producto
         * 
         * Se realiza la consulta '$productoC' a la tabla producto para traer toda la información 
         * correspondiente al producto con el id que se trae por la url de categoriasnuevas.php
         */
        $productoC = mysqli_query($conexion, "SELECT * FROM tbl_producto WHERE id_producto = '$id'");

        /**
         * 
         * Mientras hayan resultados almacenados en $rowC de la consulta $productoC, se almacenaran el 
         * nombre y el precio del producto en las variables $nombre y $precio
         */
        while ($rowC = mysqli_fetch_array($productoC)) {
          $nombre = $rowC['nombre_producto'];
          $precio = $rowC['precio_producto'];
        }

        /**
         * Creación de un arreglo nuevo
         *
         * Se crea un arreglo con el nombre de $arregloNuevo, el cual solo tendrá una posición, este
         * arreglo se le asigna al $arreglo
         */
        $arregloNuevo = array(
          'Id' => $id,
          'Nombre' => $nombre,
          'Precio' => $precio,
          'Cantidad' => 1
        );

        /**
         * Agregar arreglo a otro arreglo
         * 
         * Se utiliza la funcion array_push de php para asignarle la información del arregloNuevo al arreglo 
         */
        array_push($arreglo, $arregloNuevo);

        /**
         * Almacenar información a la sesión
         * 
         * Se llama la variable sesión y se le asignan los datos que hay en el arreglo
         */
        $_SESSION['carrito'] = $arreglo;
      }
    }
  }
   /**
    * De lo contrario se agrega un nuevo producto en el arreglo
    */
   else {

    /**
     * 
     * Si se trae el id del producto que se va a agregar al pedido,el cuál se está enviando desde el archvio 
     * categoriasnuevas.php entonces haga lo sgte.
     */
    if (isset($_GET['id'])) {

      /**
       * Se crean las variables para almacenar la información necesaria de un producto,el id del 
       * producto se trae por la url del archivo categoriasnuevas.php, el nombre se deja
       * vacío y es de tipo cadena de caracteres, el precio se inicializa en cero(0) y es de tipo 
       * decimal
       * 
       * @var integer $id       Id del producto
       * @var string $nombre    Nombre del producto
       * @var float $precio     Precio del producto
       */
      $id = $_GET['id'];
      $nombre = "";
      $precio = 0;

      /**
       * Consulta a la base de datos tabla producto
       * 
       * Se realiza la consulta '$productoC' a la tabla producto para traer toda la información 
       * correspondiente al producto con el id que se trae por la url de categoriasnuevas.php
       */
      $productoC = mysqli_query($conexion, "SELECT * FROM tbl_producto WHERE id_producto = '$id'");

      /**
       * 
       * Mientras hayan resultados almacenados en $rowC de la consulta $productoC, se almacenaran el 
       * nombre y el precio del producto en las variables $nombre y $precio
       */
      while ($rowC = mysqli_fetch_array($productoC)) {
        $nombre = $rowC['nombre_producto'];
        $precio = $rowC['precio_producto'];
      }

      /**
       * Se crea el arreglo con los corchetes [] para indicarle que será de varias posiciones, luego se
       * le indica lo que va a almacenar, el $id que se envío de categoriasnuevas.php, el nombre y el 
       * precio del producto resultados de la consulta a la base de datos y la cantidad inicia en uno(1)
       */
      $arreglo[] = array(
        'Id' => $id,
        'Nombre' => $nombre,
        'Precio' => $precio,
        'Cantidad' => 1
      );

      /**
       * Pasar el arreglo a la sesión
       * 
       * Se le asigna el arreglo, con toda su información a la sesión del carrito
       */
      $_SESSION['carrito'] = $arreglo;
    }
  }
?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Ver pedido</title>
    <link rel="stylesheet" href="../css/vercarrito.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <!--Se coloca el logo del sistema-->
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <!--Se crea una sección que contiene la imagen de un usuario en general y el nombre y apellido
            de el usuario que está en la sesión
          -->
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            /**
             * Traer el nombre del mesero
             * 
             * Se crea la variable cedula, para que almacene la sesion del mesero, la cuál tiene el 
             * número de documento de tipo cadena de caracteres
             * 
             * @var string $cedula    Cédula del mesero
             */
            $cedula = $_SESSION['mesero'];

            /**
             * Consulta a la base de datos tabla empleado
             * 
             * Se realiza la consulta '$query' para traer el nombre y el apellido correspondiente al 
             * empleado que se encuentra en la sesión, en este caso necesitamos el nombre y el apellido, 
             * para lo cual creamos dos variables, el nombre y el apellido las cuales son de tipo cadena 
             * de caracteres
             * 
             * @var string $nombre      Nombre del mesero
             * @var string $apellido    Apellido del mesero
             */
            $query = mysqli_query($conexion, "SELECT nombre1_empleado,apellido1_empleado FROM `tbl_empleado` where `cedula_empleado` = '$cedula'");

            /**
             * En $row se almacena el resultado de la consulta $query
             */
            $row = mysqli_fetch_array($query);

            /**
             * Se le asigna el resultado de la consulta a la variable $nombre y $apellido
             */
            $nombre = $row['nombre1_empleado'];
            $apellido = $row['apellido1_empleado'];
            ?>

            <!--Luego en el echo se muestran las variables que almacena la información del nombre y
              apellido del mesero
            -->
            <h3><?php echo $nombre . " " . $apellido; ?>

              <!--Se coloca el icono de una flecha hacia abajo para ver la otra sección con 
                otras opciones y se coloca el onclick correspondiente, el cuál ejecuta la función
                de mostrar esa sección.
              -->
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">

              <!--Se coloca el icono de una flecha hacia arriba para esconder la sección con
                opciones y se coloca el onclick correspondiente, el cuál ejecuta la función
                de esconder esa sección.
              -->
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
          </section>
          
          <!--Se crea la sección que se le muestra al usuario, la cuál tiene diferentes opciones -->
          <section id="section-opc">
            <ul>
              <li><a href="perfilmesero.php">Inicio</a></li>
              <li><a href="cambiarclavemesero.php">Cambiar contraseña</a></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>

      <!--Se crean dos div que contienen la tabla del pedido -->
      <div class="tabla-pedido">
        <div class="pedido">
          <center>
            <h2>Pedido</h2>
          </center>
          <!--Se crea la tabla -->
          <table>
            <!--Cabecera de la tabla -->
            <thead>
              <!--Las filas de la tabla -->
              <tr>
                <!--Celdas de la tabla -->
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
              <tr>
            </thead>
            <!--Cuerpo de la tabla -->
            <tbody>
              <?php
              /**
               * Se inicializa la variable total en cero(0) la cual es de tipo decimal
               * 
               * @var float total
               */
              $total = 0;

              /**
               * Verificar sesion
               * 
               * Si existe la sesion carrito, se dice que almacene los datos de la sesion en la
               * variable datos y que la variable total inicie en cero(0) la cual es de tipo decimal
               * 
               * @var float $total
               */
              if (isset($_SESSION['carrito'])) {
                $datos = $_SESSION['carrito'];
                $total=0;

                /**
                 * Creación ciclo for
                 * 
                 * Ciclo for, donde i comienza en 0 hasta que i sea menor al numero de posiciones del arreglo
                 */
                for ($i = 0; $i < count($datos); $i++) {
              ?>
              
              <!--Se crea un div que contiene las filas de la tabla del pedido -->
              <div class="producto">
                  <!--Filas de la tabla -->
                  <tr>
                    <!--Mostrar la información del carrito
                      Lo que se hace es que se pone el echo y se llama a la variable
                      datos en la posicion $i, es decir imprime el nombre que hay en esa posicion en la 
                      variable datos, así sucesivamente con los demás campos.
                    -->
                    <!--Celdas de la tabla, donde se muestra la información -->
                    <td><?php echo $datos[$i]['Nombre'];?></td>
                    <td><?php echo "$" . $datos[$i]['Precio'];?></td>
                    <td>
                      <!--En este campo se utilizan los data atributte de html, que nos permiten
                        incrustar atributos personalizados en los elementos, los cuales se utilizan
                        para actualizar la cantidad del producto en el archivo js/actualizarcarrito.js
                      -->
                      <input type="text" value="<?php echo $datos[$i]['Cantidad'];?>" 
                      data-precio="<?php echo $datos[$i]['Precio'];?>" 
                      data-id="<?php echo $datos[$i]['Id'];?>" 
                      class="cantidad">
                    </td>

                    <!--Calcular subtotal a pagar
                      Se realiza la multiplicación de la cantidad por el precio
                    -->
                    <td class="subtotal">Subtotal: <?php echo "$" . $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></td>

                    <td>
                      <!--Se envía la posición del producto al cuál se le dió click en "Eliminar",
                        la posición del producto se envía mediante 'Pos' que tiene el valor de $i que es la
                        que contiene la posición al recorrer el arreglo para eliminar ese producto 
                        del carrito
                      -->
                      <a id="eliminar-prod"href="../php/eliminardecarrito.php?Pos=<?php echo $i; ?>">
                        Eliminar</a>
                    </td>
                    </tr>
                </div>
              <?php
              /**
               * Total pedido
               * 
               * Lo que se realiza es la multiplicación de la cantidad por el precio más el total,
               * para dar el total final del pedido
               */
                  $total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
                }
              } 
              /**
               * De lo contrario
               */
              else {
                /** 
                 * Si no hay productos en el pedido se mostrará ese mensaje
                 */
                echo "El pedido está vacío";
              }
              ?>
            </tbody>
            <!--Cuerpo de la tabla -->
            <tfoot>
              <!--Fila de la tabla -->
              <tr>
                <!--Se crea un formulario con su página de acción al momento de enviar el formulario, 
                  en la carpeta php en el archivo enviarcarrito.php
                -->
                <form action="../php/enviarcarrito.php" method="post" onsubmit="return validarCarrito()">

                  <!--Se guarda el total del pedido y la cedula del mesero que está realizando dicho
                    pedido en un input oculto
                  -->
                  <input type="hidden" name="total_p" value="<?php echo $total; ?>">
                  <input type="hidden" name="ced_mesero" value="<?php echo $_SESSION['mesero']; ?>">

                  <!--Celda de la tabla donde se muestra el total del pedido -->
                  <td id="total" colspan="5">Total: <?php echo "$".$total; ?></td>

                  <!--Fila de la tabla  -->
                  <tr>
                    <!--Celdas de la tabla donde se muestra un enlace y se solicita que se ingrese una mesa
                      y donde está el input para enviar el pedido 
                    -->
                    <td colspan=""><a href="categoriasnuevas.php" id="Volver"/>Seguir pidiendo</a></td>
                    <td colspan="2">
                      <input type="number" name="mesa" id ="numeroMesa" placeholder="Número de la mesa">
                      <h5 id="alertaNumeroMesa"></h5>
                    </td>
                    <td colspan="2" style="padding:0 0 0 100px;">
                    <!--Se coloca el input submit para que se envie el formulario-->
                    <input type="submit" name="enviar" value="Enviar"></td>
                  </tr>
                </form>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
      <script type="text/javascript"  src="../js/perfilmesero.js"></script>
      <script type="text/javascript"  src="../js/jquery.js"></script>
      <script type="text/javascript"  src="../js/actualizarcarrito.js"></script>
      <script type="text/javascript"  src="../js/validaciones.js"></script>
       
  </body>

  </html>
<?php } else {
  /**
   * Si no está la sesion mesero lo que hace es que lleva al index
   */
  header('location: ../index.php');
} ?>