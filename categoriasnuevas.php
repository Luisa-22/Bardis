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
 * Si la sesión del mesero está iniciada permite realizar lo siguiente 
 */
if (isset($_SESSION['mesero'])) {

  /**
   * Se crea una variable llamada where tipo cadena de caracteres
   * 
   * @var string $where       
   */
  $where = '';

  /**
   * Si se envia el formulario que se encuentra en este mismo archivo hará lo sgte.
   */
  if (isset($_POST['id'])) {

    /**
     * Se recibe el id de la categoria por la cual se quieren filtrar los productos
     * asociados a esa categoria, para eso se crea una variable $id para almacenar el 'id' enviado
     * por el formualrio de este mismo archivo
     * 
     * @var string $id          Id de la categoria tipo cadena de caracteres
     */
    $id = $_POST['id'];

    /**
     * Consulta a la base de datos tabla categoria
     * 
     * Se realiza la consulta '$categoria' a la tabla categoria para traer el id de la categoria,
     * para lo cual se crea una variable $idCat de tipo cadena de caracteres que almacena el id de
     * la categoria
     * 
     * @var string $idCat     Id de la categoria de los productos, cadena de caracteres
     */
    $categoria = mysqli_query($conexion, "SELECT id_categoria FROM `tbl_categoria` WHERE id_categoria = '$id'");

    /**
     * En $rowCat se almacena el resultado de la consulta $categoria
     */
    $rowCat = mysqli_fetch_array($categoria);

    /**
     * Se le asigna el resultado de la consulta a la variable $idCat
     */
    $idCat = $rowCat['id_categoria'];

    /**
     * Se le asigna una condición a la variable $where que creamos anteriormente, la
     * condición es que: donde el id_categoria de la base de datos sea igual al $idCat 
     * que se está trayendo de la consulta $categoria
     */
    $where = "WHERE id_categoria = '$idCat'";
  }

  /**
   * Consulta a la base de datos tabla producto
   * 
   * Se realiza la consulta '$consultarProductos' a la tabla producto para traer toda la información 
   * de los productos de una categoria correspondiente
   */
  $consultarProductos = mysqli_query($conexion, "SELECT * FROM `tbl_producto` $where");

  /**
   * Se crean dos variables, una para que almacene el número de resultados de la 
   * consulta $consultarProductos y la otra variable que es contadora
   * 
   * @var integer $cont         Número de resultados de la consulta, tipo entero
   * @var integer $i            Variable contadora, tipo entero
   *
   */
  $cont = mysqli_num_rows($consultarProductos);
  $i = 0;

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Categorias</title>
    <link rel="stylesheet" href="../css/categorianueva.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <!--Se coloca el logo del sistema-->
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <!--Se crea una sección que contiene la imagen de un usuario en general, el nombre y el 
            apellido del usuario que está en la sesión
          -->
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            /**
             * Traer el nombre del mesero
             * 
             * Se crea la variable cedula, para que almacene la sesion del mesero la cuál 
             * tiene el número de documento de tipo cadena de caracteres
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
            <h3><?php echo $nombre . " " . $apellido;  ?>

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

      <!--Se pone un enlace para volver a la pestaña del perfil-->
      <a href="perfilmesero.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
      <!--Se crean varios div que contienen todos los productos, pero también se pueden buscar 
        los productos de una categoria especifica
      -->
      <div id="div-categorias">
        <div class="">
          <div class="realizar-pedidos">
            <h2>Realizar pedidos</h2>
            <div class="btn-categorias">
              <!--Se crea el formulario para capturar la categoria por la que se quieren filtrar
                los productos, el accion del formulario se encuentra en este mismo archivo
              -->
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <!--Se coloca un select para que se seleccione la categoria del producto -->
                <select name="id" id="id">
                  <option disabled selected value="">Categorias</option>
                  <?php
                  /**
                   * Consulta a la base de datos tabla categoria 
                   * 
                   * Se realiza la consulta '$query' a la tabla categoria para que me muestre toda la 
                   * información de las categorias existentes
                   */
                  $query = mysqli_query($conexion, "SELECT * FROM tbl_categoria");

                  /**
					         * Mientras hayan resultados de esa consulta, se muestran las categorias
                   * encontradas en la consulta $query y almacenados en $row
                   */
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                    <!-- Se imprime el nombre de las categorias, realizando el llamado a $row que es quién 
							        almacena la información de la consulta $query
                    -->
                    <option value="<?php echo $row['id_categoria']; ?>"> <?php echo $row['nombre_categoria']; ?></option>
                  <?php
                  /**
                   * Se cierra el ciclo de la consulta de la tabla categoria
                   */
                  }
                  ?>
                </select>
                <!--Botón para buscar los productos de cierta categoria -->
                <button type="submit">Buscar<img src="../icons/search.png"></button>
              </form>
            </div>
            <!--Se crea un div que contiene la tabla producto -->
            <div class="tabla-producto">
              <!--Se crea la tabla -->
              <table>
                <!--Cabecera de la tabla -->
                <thead>
                  <!--Celdas de la tabla -->
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Descripción</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                  /**
                   * Mientras $cont (el número de resultados de la consulta '$consultarProductos') 
                   * sea mayor a la variable contadora $i va a mostrar los resultados de la consulta
                   * $consultarProductos que están almacenados en $row
                   */
                  while ($cont > $i) {
                    $row = mysqli_fetch_array($consultarProductos);
                  ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <tr>
                         <!-- Se imprime cada uno de los campos de un producto en las celdas,
                          realizando el llamado a $row que es quién almacena
                          la información de la consulta $consultarProductos
                        -->
                        <td><?php echo $row['id_producto']; ?></td>
                        <td><?php echo $row['nombre_producto']; ?></td>
                        <td><?php echo $row['precio_producto']; ?></td>
                        <td><?php echo $row['descripcion_producto']; ?></td>
                        <td>
                          <!-- En la celda de la tabla se pone un enlace con un botón, el cuál al darle click 
                            por medio de la variable 'id' que es igual al id del produto que se envia 
                            al archivo que está en la carpeta vistas en el archivo vercarrito.php, el cual 
                            permite agregar ese producto al pedido
                          -->
                          <a id="agregar-producto" href="vercarrito.php?id=<?php echo $row['id_producto']; ?>">Agregar</a>
                        </td>
                      </tr>
                    <?php
                    /**
                     * Se aumenta la variable contadora $i en uno(1)
                     */
                    $i = $i + 1;
                    /**
                     * Se cierra el ciclo
                     */
                  }
                    ?>
                    </form>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!--Se crea un div que contiene un icono de un carrito de compras y un enlace a la 
          carpeta vistas en el archivo vercarrito.php para ver los productos que se han agregado 
          a un pedido, si no se ha agregado nada muestra que el pedido esta vacío 
        -->
        <div class="tabla-pedido">
          <div><object id="carrito" width="30" height="30" data="../icons/supermarket.svg" type="image/svg+xml"></object></div>
          <div><a href="../vistas/vercarrito.php">Pedidos</a></div>
        </div>
      </div>
    </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfilmesero.js"></script>
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del administrador lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>