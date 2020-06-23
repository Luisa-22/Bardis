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
 * Si la sesión del cliente está iniciada permite realizar lo siguiente
 */
if (isset($_SESSION['cliente'])) {

  /**
   * Se crea la variable cedula, para que almacene la sesion del cliente la cual contiene 
   * la cédula del cliente que es de tipo cadena de caracteres
   * 
   * @var string $cedula                    Cédula del cliente
   */
  $cedula = $_SESSION['cliente'];

  /**
   * Consulta a la base de datos tabla cliente
   * 
   * Se realiza la consulta '$perfil' para traer la clave del cliente que va a cambiar su clave,
   * la cual se va a almacenar en la variable $clave
   * 
   * @var string $clave                     Clave del cliente tipo cadena de caracteres
   */
  $perfil = mysqli_query($conexion, "SELECT clave_cliente FROM tbl_cliente WHERE `documento_cliente` =  '$cedula'");

  /**
   * En $row se almacena el resultado de la consulta $perfil
   */
  $row = mysqli_fetch_array($perfil);

  /**
   * Se le asigna el resultado de la consulta a la variable $clave
   */
  $clave = $row['clave_cliente'];

  /**
   * Si se envia el formulario que se encuentra en este mismo archivo hará lo sgte.
   */
  if (isset($_POST['submit'])) {

    /**
     * Se crea la variable $password_actual que almacena el campo que tiene como nombre 'password_actual',
     * el cual se envia del formulario de este mismo archivo
     * 
     * @var string $password_actual         Clave actual del cliente tipo cadena de caracteres
     */
     $password_actual = $_POST['password_actual'];
    
    /**
     * Se crea la variable $password_nueva que almacena el campo que tiene como nombre 'password_nueva',
     * el cual se envia del formulario de este mismo archivo  
     * 
     * @var string $password_nueva          Clave nueva del cliente tipo cadena de caracteres
     */ 
     $password_nueva = $_POST['password_nueva'];
     
    /**
     * Se crea la variable $password_repetir que almacena el campo que tiene como nombre 'password_repetir',
     * el cual se envia del formulario de este mismo archivo 
     * 
     * @var string $password_repetir        Repetir clave nueva del cliente tipo cadena de caracteres
     */
     $password_repetir = $_POST['password_repetir'];

    /**
     * Se realiza la condición de que si la clave del cliente que hay en la base de datos
     * es igual a la clave actual que se está ingresando y también si la clave nueva es igual a
     * la clave que se ingrese para confirmar, si esto se cumple deja cambiar la clave
     */
    if ($clave == $password_actual && $password_nueva == $password_repetir) {

      /**
       * Actualizar clave cliente
       * 
       * Se ejecuta la sentencia de actualizar en la tabla cliente para actualizar la clave del
       * cliente, y se muestra la alerta de que se actualizó correctamente, y lleva 
       * al cliente a su perfil, de lo contrario muestra que ocurrió un error y se queda en 
       * la misma pestaña
       */
      $actualizar = mysqli_query($conexion, "UPDATE `tbl_cliente` 
      SET  `clave_cliente` = '$password_nueva' where  `documento_cliente` = '$cedula' 
      and `clave_cliente` = '$password_actual'");

      echo "<script type='text/javascript'>alert('Se actualizó correctamente su contraseña');</script>";
      echo "<script>window.location='../vistas/perfilusuario.php';</script>";
    } else {
      echo "<script type='text/javascript'>alert('Ocurrió un error, vuelva a intentar');</script>";
      echo "<script>window.location='../vistas/cambiarclaveusuario.php';</script>";
      
    }
  }
?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/cambiarcontraseña.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Cliente-Perfil</title>
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
             * Traer el nombre del cliente
             * 
             * Se crea la variable cedula, para que almacene la sesion del cliente la cuál 
             * tiene el número de documento de tipo cadena de caracteres
             * 
             * @var string $cedula    Cédula del cliente
             */
            $cedula = $_SESSION['cliente'];

            /**
            * Consulta a la base de datos tabla cliente
            * 
            * Se realiza la consulta '$query' para traer el nombre correspondiente al cliente
            * que se encuentra en la sesión, en este caso necesitamos el nombre, para lo cual se 
            * crea la variable nombre que es de tipo cadena de caracteres
            * 
            * @var string $nombre      Nombre del cliente
            */
            $query = mysqli_query($conexion, "SELECT nombre_cliente FROM `tbl_cliente` where `documento_cliente` = '$cedula'");
            
            /**
             * En $row se almacena el resultado de la consulta $query
             */
            $row = mysqli_fetch_array($query);

            /**
             * Se le asigna el resultado de la consulta a la variable $nombre
             */
            $nombre = $row['nombre_cliente'];
            ?>

            <!--Luego en el echo se muestra la variable que almacena la información del nombre del cliente -->
            <h3><?php echo $nombre ?>

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
              <li><a href="perfilusuario.php">Inicio</a></li>
              <li><a href="modificardatos_usuario.php">Modificar perfil</a><br></li>
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
            <!--En cada uno de los inputs se coloca:
              Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
              un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están en
              js/validaciones.js

              Onpaste="" la función de este es no permitir copiar y pegar texto en ese input
            -->
            <input type="password" name="password_actual" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña actual" required>
            <input type="password" name="password_nueva" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña nueva" required>
            <input type="password" name="password_repetir" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Confirmar contraseña" required>
            
            <!--Se coloca el input submit para que se envie el formulario-->
            <input type="submit" name="submit" value="Cambiar contraseña">
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfildj.js"></script>
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del cliente lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>