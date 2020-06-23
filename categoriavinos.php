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
 * Si la sesión del administrador está iniciada permite visualizar la siguiente vista
 */
if (isset($_SESSION['administrador'])) {

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Vinos</title>
    <link rel="stylesheet" href="../css/categoriavinos.css">
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
             * Traer el nombre del administrador
             * 
             * Se crea la variable cedula, para que almacene la sesion del administrador la cuál 
             * tiene el número de documento de tipo cadena de caracteres
             * 
             * @var string $cedula    Cédula del administrador
             */
            $cedula = $_SESSION['administrador'];

            /**
            * Consulta a la base de datos tabla administrador
            * 
            * Se realiza la consulta '$query' para traer el nombre y el apellido correspondiente al 
            * administrador que se encuentra en la sesión, en este caso necesitamos el nombre y el apellido, 
            * para lo cual creamos dos variables, el nombre y el apellido las cuales son de tipo cadena 
            * de caracteres
            * 
            * @var string $nombre      Nombre del administrador
            * @var string $apellido    Apellido del administrador
            */
            $query = mysqli_query($conexion, "SELECT nombre1_administrador, apellido1_administrador FROM `tbl_administrador` where `cedula_administrador` = '$cedula'");

            /**
             * En $row se almacena el resultado de la consulta $query
             */
            $row = mysqli_fetch_array($query);

            /**
             * Se le asigna el resultado de la consulta a la variable $nombre y $apellido
             */
            $nombre = $row['nombre1_administrador'];
            $apellido = $row['apellido1_administrador'];
            ?>

            <!--Luego en el echo se muestran las variables que almacena la información del nombre y
              apellido del administrador 
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
              <li><a href="perfiladministrador.php">Inicio</a></li>
              <li><a href="empleados.php">Empleados</a></li>
              <li><a href="modificardatos.php" target="_blank">Modificar perfil</a><br></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>

      <!--Se pone un enlace para volver a la pestaña de las categorias -->
      <a href="categorias.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
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
          <?php
          /**
           * Consulta a la base de datos tabla producto
           * 
           * Se ejecuta la consulta '$producto' a la tabla producto para que me muestre toda la información
           * de los productos que hay asociados a una categoria en específica, en este caso a las categoria 
           * C06 que es la categoria de vinos
           */
          $producto = mysqli_query($conexion, "SELECT * FROM tbl_producto where `id_categoria`='C06'");

           /**
					 * Mientras hayan resultados de esa consulta, se muestran los productos
           * encontrados en la consulta $producto y almacenados en $rowProducto
           */
          while ($rowProducto = mysqli_fetch_array($producto)) {
          ?>
            <!--Cuerpo de la tabla -->
            <tbody>
                <!--Fila de la tabla -->
                <tr>
                  <!-- Se imprime cada uno de los campos de un producto en las celdas,
                    realizando el llamado a $rowProducto que es quién almacena
                    la información de la consulta $producto
                  -->
                  <td><?php echo $rowProducto['id_producto']; ?></td>
                  <td><?php echo $rowProducto['nombre_producto']; ?></td>
                  <td><?php echo $rowProducto['precio_producto']; ?></td>
                  <td><?php echo $rowProducto['descripcion_producto']; ?></td>

                  <!-- En la celda de la tabla se pone un enlace con un botón, el cuál al darle click 
                    por medio de la variable 'producto' que es igual al id del producto que se envia 
                    al archivo que está en la carpeta vistas en el archivo modificarproductos.php,
                    el cuál permite modificar la información de ese producto
                  -->
                  <td><a style="color:#fff;text-decoration: none;" class="enlace-btn" href="../vistas/modificarproductos.php?producto=<?php echo $rowProducto['id_producto']; ?>">
                  <!--Botón para modificar producto -->
                  <button class="btn-modificar">Modificar</a></button>

                  <!-- En la celda de la tabla se pone un enlace con un botón, el cuál al darle click 
                    por medio de la variable 'producto' que es igual al id del produto que se envia 
                    al archivo que está en la carpeta php en el archivo eliminarproducto.php, el cual 
                    permite eliminar ese producto
                  -->
                  <a style="color:#fff;text-decoration: none;" href="../php/eliminarproducto.php?producto=<?php echo $rowProducto['id_producto']; ?>">
                  <!--Botón para eliminar un producto -->
                  <button class="btn-eliminar">Eliminar</a></button></td>
                  </td>
                </tr>
            </tbody>
          <?php
          /**
					 * Se cierra el ciclo de la consulta de la tabla producto
					 */
          }
          ?>
        </table>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js"></script>
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del administrador lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>