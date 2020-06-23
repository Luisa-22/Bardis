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
   * Se crea la variable cedula, para que almacene la sesion del mesero la cual contiene 
   * la cédula del mesero que es de tipo cadena de caracteres
   * 
   * @var string $cedula                    Cédula del mesero
   */
  $cedula = $_SESSION['mesero'];

  /**
   * Consulta a la base de datos tabla empleado
   * 
   * Se realiza la consulta '$perfil' para traer la clave del mesero que va a cambiar su clave,
   * la cual se va a almacenar en la variable $clave
   * 
   * @var string $clave                     Clave del mesero tipo cadena de caracteres
   */
  $perfil = mysqli_query($conexion, "SELECT clave_empleado FROM tbl_empleado WHERE `cedula_empleado` =  '$cedula'");

  /**
   * En $row se almacena el resultado de la consulta $perfil
   */
  $row = mysqli_fetch_array($perfil);

  /**
   * Se le asigna el resultado de la consulta a la variable $clave
   */
  $clave = $row['clave_empleado'];
  
  /**
   * Si se envia el formulario que se encuentra en este mismo archivo hará lo sgte.
   */
  if (isset($_POST['submit'])) {

    /**
     * Se crea la variable $password_actual que almacena el campo que tiene como nombre 'password_actual',
     * el cual se envia del formulario de este mismo archivo
     * 
     * @var string $password_actual         Clave actual del mesero tipo cadena de caracteres
     */ 
     $password_actual = $_POST['password_actual'];

    /**
     * Se crea la variable $password_nueva que almacena el campo que tiene como nombre 'password_nueva',
     * el cual se envia del formulario de este mismo archivo 
     * 
     * @var string $password_nueva          Clave nueva del mesero tipo cadena de caracteres
     */
     $password_nueva = $_POST['password_nueva'];

    /**
     * Se crea la variable $password_repetir que almacena el campo que tiene como nombre 'password_repetir',
     * el cual se envia del formulario de este mismo archivo 
     * 
     * @var string $password_repetir        Repetir clave nueva del mesero tipo cadena de caracteres
     */
     $password_repetir = $_POST['password_repetir'];

    /**
     * Se realiza la condición de que si la clave del mesero que hay en la base de datos
     * es igual a la clave actual que se está ingresando y también si la clave nueva es igual a
     * la clave que se ingrese para confirmar, si esto se cumple deja cambiar la clave
     */
    if ($clave == $password_actual && $password_nueva == $password_repetir) {

      /**
       * Actualizar clave mesero
       * 
       * Se ejecuta la sentencia de actualizar en la tabla empleado para actualizar la clave del
       * mesero, y se muestra la alerta de que se actualizó correctamente, y lleva 
       * al mesero a su perfil, de lo contrario muestra que ocurrió un error y se queda en 
       * la misma pestaña
       */
      $actualizar = mysqli_query($conexion, "UPDATE `tbl_empleado` 
      SET  `clave_empleado` = '$password_nueva' where  `cedula_empleado` = '$cedula' 
      and `clave_empleado` = '$password_actual'");

      echo "<script type='text/javascript'>alert('Se actualizó correctamente su contraseña');</script>";
      echo "<script>window.location='../vistas/perfilmesero.php';</script>";
    } else {
      echo "<script type='text/javascript'>alert('Ocurrió un error, vuelva a intentar');</script>";
      echo "<script>window.location='../vistas/cambiarclavemesero.php';</script>";
    }
  }

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Cambiar contraseña</title>
    <link rel="stylesheet" href="../css/cambiarcontraseña.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <!--Se coloca el logo del sistema-->
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <!--Se crea una sección que contiene la imagen de un usuario en general y el nombre 
            del usuario que está en la sesión
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

      <!--Se crea un div que contiene el formulario de cambiar la contraseña -->
      <div class="">
        <!--Se crea el formulario de cambiar la contraseña con su página de accion en este mismo archivo -->
        <form class="" action="#" method="post">
            <h3>Cambiar contraseña</h3>
            <input type="password" name="password_actual" placeholder="Contraseña actual" required>
            <input type="password" name="password_nueva" placeholder="Contraseña nueva" required>
            <input type="password" name="password_repetir" placeholder="Confirmar contraseña" required>

            <!--Se coloca el input submit para que se envie el formulario-->
            <input type="submit" name="submit" value="Cambiar contraseña">
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfilmesero.js"></script>
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del mesero lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>