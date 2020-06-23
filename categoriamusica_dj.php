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
 * Si la sesión del dj está iniciada permite visualizar la siguiente vista
 */
if (isset($_SESSION['dj'])) {

?>

<!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/categoriamusica_dj.css">
    <title>Bardis || DJ-Música</title>
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
             * Traer el nombre del dj
             * 
             * Se crea la variable cedula, para que almacene la sesion del dj la cuál 
             * tiene el número de documento de tipo cadena de caracteres
             * 
             * @var string $cedula    Cédula del dj
             */
            $cedula = $_SESSION['dj'];

            /**
             * Consulta a la base de datos tabla empleado
             * 
             * Se realiza la consulta '$query' para traer el nombre y el apellido correspondiente al 
             * empleado que se encuentra en la sesión, en este caso necesitamos el nombre y el apellido, 
             * para lo cual creamos dos variables, el nombre y el apellido las cuales son de tipo cadena 
             * de caracteres
             * 
             * @var string $nombre      Nombre del dj
             * @var string $apellido    Apellido del dj
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
              apellido del dj 
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
                  <li><a href="perfildj.php">Inicio</a></li>
                  <li><a href="cambiarclavedj.php">Cambiar contraseña</a></li>
                  <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
                </ul>
              </section>
        </div>
      </div>

      <!--Se crean varios div que contienen la tabla musica -->
      <div id="div-music" onclick="quitarsubmenu()">
        <!--Se pone un enlace para volver a la pestaña del perfil -->
        <a href="perfildj.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
        <div id="musica">
          <!--Se crea la tabla -->
          <table class="table-music">
            <!--Cabecera de la tabla -->
            <thead>
              <!--Fila de la tabla -->
              <tr>
                <!--Celdas de la tabla -->
                <th>Nombre</th>
                <th>Artista</th>
                <th>Canciones sonadas</th>
              </tr>
            </thead>
            <!--Cuerpo de la tabla -->
            <tbody>
              <!--Fila de la tabla -->
              <tr>
                <!--Se crea un formulario-->
                <form method="post">
                  <?php
                  /**
                   * Consulta a la base de datos tabla cancion
                   * 
                   * Se ejecuta la consulta '$musica' a la tabla cancion para que me muestre las
                   * canciones que se han solicitado
                   */
                  $musica = mysqli_query($conexion, "SELECT * FROM tbl_cancion");

                  /**
                   * Mientras hayan resultados de esa consulta, se muestra toda la información de los 
                   * canciones encontradas en la consulta $musica y almacenados en $rowMusica
                   */
                  while ($rowMusica = mysqli_fetch_array($musica)) {

                    /**
                     * Se imprime el nombre, el interprete y el id de la cancion
                     * realizando el llamado a $rowMusica que es quién almacena
                     * la información de la consulta $musica
                     * 
                     * Luego se crea un arreglo con el nombre id_canciones que almacenará
                     * todos los id de las canciones
                     */
                    echo '<tr>
                  <td>' . $rowMusica['nombre_cancion'] . '</td>
                  <td>' . $rowMusica['nombre_interprete'] . '</td>
                  <td colspan=""><input type="checkbox" id="' . $rowMusica['id_cancion'] . '" name="id_canciones[]" value="' . $rowMusica['id_cancion'] . '"/>
                  <label class"label-checkbox" for="' . $rowMusica['id_cancion'] . '"><span></span></label></td>
                  </tr>';
                  /**
                   * Se cierra el ciclo de la consulta a la tabla canción
                   */
                  }
                  ?>
              </tr>
            </tbody>
            <!-- Cuerpo de la tabla -->
            <tfoot>
              <tr>
                <td colspan="3" style="padding:5px 20px 0 0;">
                  <!--Se pone un input para que se envíe el formulario-->
                  <input name="eliminar-cancion" type="submit" value="Canciones sonadas" class="eliminar-cancion" />
                </td>
              </tr>
            </tfoot>

            <?php
            /**
             * Si se envia el formulario que se encuentra en este mismo archivo, entonces hará lo sgte.
             */
            if (isset($_POST['eliminar-cancion'])) {

              /**
               * Si el arreglo está vacío es decir si no se seleccionó un checkbox muestra
               * una alerta de que no hay ninguna canción seleccionada
               */
              if (empty($_POST['id_canciones'])) {
                echo "<script type='text/javascript'>alert('Ninguna canción seleccionada');</script>";
              }

              /**
               * De lo contrario
               */              
              else {
                /**
                 * Se recorre el arreglo 'id_canciones' y se crea la variable $id_borrar
                 * que almacenará el arreglo de todos los checkbox seleccionados
                 */
                foreach ($_POST['id_canciones'] as $id_borrar) {

                  /**
                   * Eliminar de la tabla cliente canción
                   * 
                   * Se ejecuta la sentencia de eliminar $borarIntermedia en la tabla cliente cancion
                   */
                  $borarIntermedia= mysqli_query($conexion, "DELETE FROM tbl_cliente_cancion WHERE id_cancion='$id_borrar'");

                  /**
                   * Si la variable $borarIntermedia se realizó correctamente entonces se realiza la otra
                   * sentencia
                   */
                  if ($borarIntermedia) {

                    /**
                    * Eliminar de la tabla canción
                    * 
                    * Se ejecuta la sentencia de eliminar $borrarCancion en la tabla cancion
                    */
                    $borrarCancion = mysqli_query($conexion, "DELETE FROM tbl_cancion WHERE id_cancion='$id_borrar'");

                    /**
                     * Si la variable $borrarCancion se realizó correctamente entonces deja al usuario
                     * administrador en esta vista de 'musica.php'
                     */
                    if ($borrarCancion) {
                      echo "<script>window.location='../vistas/categoriamusica_dj.php';</script>";
                    }
                    /**
                     * De lo contrario muestra una alerta de que no se pudo eliminar
                     */
                    else{
                      echo "<script>alert('No se pudo eliminar correctamente');</script>";
                    }
                  }
                  /**
                   * Se finaliza el recorrido del arreglo
                   */
                }
              }
            }
            ?>
            </form>
          </table>
        </div>
      </div>
    </div>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfildj.js"></script>
    
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del dj lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>