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
 * Si la sesión del mesero está iniciada permite visualizar la siguiente vista
 */
if (isset($_SESSION['mesero'])) {
?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Pedidos</title>
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/categoriapedidosmesero.css">
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <!--Se coloca el logo del sistema-->
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <!--Se crea una sección que contiene la imagen de un usuario en general y el nombre del
            usuario que está en la sesión
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

      <!--Se crea un div que contienen la tabla del pedido -->
      <div id="pedido-mesero">
        <!--Se pone un enlace para volver a la pestaña del perfil -->
        <a href="perfilmesero.php"><img src="../icons/espalda.png" id="arrow-left" /></a>

        <!--Se crea un div que contiene todos los pedidos -->
        <div class="contenedor-cartas">
          <?php
          /**
           * Consulta a la base de datos tabla estado y pedido
           * 
           * Se ejecuta la consulta '$registro2' a la tabla estado y pedido para que muestre toda
           * la información donde el estado de un pedido sea el mismo
           */
          $registro2 = mysqli_query($conexion, "SELECT * FROM tbl_estado, tbl_pedido 
             WHERE tbl_estado.id_estado = tbl_pedido.id_estado") or die('error con el dato');

          /**
           * Consulta a la base de datos tabla pedido
           * 
           * Se ejecuta la consulta '$registro' a la tabla pedido para que muestre el numero de mesa,
           * el id del pedido, el total y el estado del pedido, pero solo los pedidos que ha realizado
           * un mesero
           */
          $registro = mysqli_query($conexion, "SELECT numero_mesa,id_pedido,total,id_estado 
            FROM tbl_pedido WHERE cedula_empleado='$cedula'") or die('error con el dato');

          /**
           * Mientras hayan resultados de esa consulta, se muestra la información solicitada
           * encontrada en la consulta $registro2 y almacenados en $row2
           */
          while ($row2 = mysqli_fetch_array($registro2)) {

            /**
            * Mientras hayan resultados de esa consulta, se muestra la información solicitada
            * encontrada en la consulta $registro y almacenados en $row
            */
            while ($row = mysqli_fetch_array($registro)) {
          ?>
              <!--Se crean varios div que contienen toda la información de un pedido -->
              <div class="carta-pedido">
                <div class="img-pedido">
                  <center>
                  <!--Se muestra la mesa de un pedido, realizando el llamado a $row
                    que es quién almacena la información de la consulta $registro
                  -->
                    <h3>Mesa <?php echo $row['numero_mesa']; ?></h3>
                  </center>
                  <!--Se muestra una imagen de una mesa -->
                  <img src="../image/table.png">
                </div>
                <!--Se crea un div que contiene el resto de información de un pedido -->
                <div class="texto-pedido">
                  <!--Se coloca el estado de ese pedido en color azul -->
                  <label>Estado:<font color="#1e90ff">
                    <!--En negrita se colo el estado de dicho pedido,realizando el llamado a $row
                      que es quién almacena la información de la consulta $registro
                    -->
                      <b>
                        <?php
                          /**
                           * Si el estado del pedido es 'E02' muestra que el estado es Atendido
                           */
                          if ($row['id_estado'] == 'E02') {
                            echo 'Atendido';
                          } 
                          /**
                           * De lo contrario, si el estado del pedido es 'E01' muestra que el estado es
                           * Proceso
                           */
                          else if ($row['id_estado'] == 'E01') {
                            echo 'Proceso';
                          }
                        ?>
                      </b></font>
                  </label>
                  <!--En encabezados se muestra el total y  la descripción de ese pedido,
                    realizando el llamado a $row que es quién almacena la información de la 
                    consulta $registro
                  -->
                  <h3>Total:<?php echo " $" . $row['total'] ?></h3><br>
                  <h4>Descripción</h4>
                  <?php 
                    /**
                     * Se captura y se almacena en una variable el Id de cada pedido, el cual es de tipo
                     * entero
                     * 
                     * @var integer $idPedido       Id del pedido
                     */
                    $idPedido = $row['id_pedido'];

                    /**
                    * Consulta a la base de datos tabla pedido producto 
                    * 
                    * Se ejecuta la consulta '$sql' a la tabla pedido producto para que me muestre el id de un
                    * producto y la cantidad que solicitaron de ese producto en un pedido
                    */
                    $sql = mysqli_query($conexion, "SELECT id_producto,cantidad FROM tbl_pedido_producto WHERE id_pedido=$idPedido");

                    /**
                     * Mientras hayan resultados de esa consulta, se muestra la información solicitada
                     * encontrada en la consulta $sql y almacenados en $producto
                     */
                    while ($producto = mysqli_fetch_array($sql)) {
                  ?>
                    <?php 
                    /**
                    * Se almacena en una variable el Id de cada producto el 
                    * cual es de tipo entero, entonces se le asigna a la variable $idP el resultado
                    * de la consulta $sql almacendado en $producto 
                    * 
                    * @var integer $idP     Id del producto
                    */
                    $idP = $producto['id_producto'];

                    /**
                     * Consulta a la base de datos tabla producto 
                     * 
                     * Se ejecuta la consulta '$selectP' a la tabla producto para que muestre el nombre
                     * y el precio de un producto determinado
                     */
                    $selectP = mysqli_query($conexion, ("SELECT nombre_producto,precio_producto FROM tbl_producto WHERE id_producto=$idP"));

                    /**
                     * Mientras hayan resultados de esa consulta, se muestra la información solicitada
                     * encontrada en la consulta $selectP y almacenados en $rowPro
                     */
                    while ($rowPro = mysqli_fetch_array($selectP)) {
                    ?>
                      <!-- Se imprime el nombre y cantidad del producto en un parrafo,
                        realizando el llamado a $rowPro que es quién almacena
                        la información de la consulta $selectP
                      -->
                      <p><?php echo $producto['cantidad'] . " " . $rowPro['nombre_producto'] ?></p>
                    <?php
                    /**
                     * Se cierra el ciclo de la consulta de la tabla producto
                     */
                    }
                    ?>
                  <?php
                  /**
                   * Se cierra el ciclo de la consulta de la tabla pedido_producto
                   */
                  }
                  ?>
                </div>
              </div>
          <?php
            /**
            * Se cierra el ciclo de la consulta de la tabla pedido
            */
            }

          /**
          * Se cierra el ciclo de la consulta de las tablas pedido y estado
          */  
          }
          ?>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfilmesero.js"></script>

  </body>

<?php } else {
/**
* Si no está la sesion del mesero lo que hace es que lleva al index
*/
header('location: ../index.php');
} ?>