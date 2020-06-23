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
   * @var string $cedula        Cédula del cliente tipo cadena de caracteres
   */
  $cedula = $_SESSION['cliente'];

  /**
   * Consulta a la tabla cliente
   * 
   * Se ejecuta la consulta '$perfil_c' en la tabla cliente para traer toda la información referente a ese 
   * cliente
   */
  $perfil_c = mysqli_query($conexion, "SELECT * FROM tbl_cliente WHERE `documento_cliente` = '$cedula'");
 
  /**
   * Si se envia el formulario que se encuentra en esta misma página hará lo sgte.
   */
  if (isset($_POST['submit'])) {

    /**
     * Se crea la variable $nombre que almacena el campo que tiene como nombre 'nombre',
     * el cual se envia del formulario de este mismo archivo
     * 
     * @var string $nombre              Nombre del cliente de tipo cadena de caracteres
     */
     $nombre = $_POST['nombre'];
    
    /**
     * Se crea la variable $correoFormulario que almacena el campo que tiene como nombre 'correo',
     * el cual se envia del formulario de este mismo archivo
     * 
     * @var string $correoFormulario    Correo del cliente de tipo cadena de caracteres
     */
     $correoFormulario = $_POST['correo'];

    /**
     * Se crea la variable $edad que almacena el campo que tiene como nombre 'edad',
     * el cual se envia del formulario de este mismo archivo
     * 
     * @var integer $edad               Edad del cliente de tipo entero
     */
     $edad = $_POST['edad'];

    /**
     * Actualizar cliente en la base de datos
     * 
     * Se ejecuta la sentencia de actualizar en la tabla cliente para actualizar los datos que se
     * cambiaron del cliente, los campos que se pueden actualizar son el nombre, correo y la edad
     */
    $actualizar = mysqli_query($conexion, "UPDATE `tbl_cliente` SET `nombre_cliente` = '$nombre', `correo_cliente` = '$correoFormulario', `edad_cliente` = '$edad' where  `documento_cliente` = '$cedula'");

    /**
    * Si la variable $actualizar se realiza correctamente muestra una alerta de que se actualizó correctamente
    * y lleva al usuario a la vista de su perfil
    */
    if ($actualizar) {
      echo "<script>alert('Se actualizó correctamente');</script>";
      echo "<script>window.location='../vistas/perfilusuario.php';</script>";
    }

    /**
     * De lo contrario muestra una alerta de error
     */
    else{
      echo "<script>alert('No se pudo actualizar, intente de nuevo');</script>";
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
    <link rel="stylesheet" href="../css/modificardatos_usuario.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Cliente-Modificar Perfil</title>
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

      <!--Se crea un div que contiene el formulario para actualizar información del usuario -->
      <div class="actualizar-datos">
        <!--Se crea el formulario con su pagina de accion en esta misma página -->
        <form action="" method="post">
          <?php 
            /**
             * Se recorré la consulta $perfil_c y se guarda la información en $perfil, para 
             * mostrarla al usuario
             */
            foreach ($perfil_c as $perfil) : 
          ?>
            <h2>Modificar perfil</h2>
             <!-- En cada uno de los inputs se coloca:
              Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
              un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están en
              la carpeta js el archivo validaciones.js

              Onpaste="" la función de este es no permitir copiar y pegar texto en ese input

              Y se muestra la información del perfil para lo que se pone el echo y se llama a la 
              variable $perfil que es quién almacenó la información de la consulta $perfil_c, y luego
              se pone el campo que se quiere mostrar
            -->
            <input type="text" name="nombre" onkeypress="return SoloLetras(event)" onpaste="return false" value="<?php echo $perfil['nombre_cliente']; ?>" placeholder="Nombre de usuario">
            <input type="text" name="correo" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" value="<?php echo $perfil['correo_cliente']; ?>" placeholder="Correo">
            <input type="text" name="edad" onkeypress="return SoloNumeros(event)" onpaste="return false" value="<?php echo $perfil['edad_cliente']; ?>" placeholder="Edad">

            <!--Enlace para cambiar contraseña -->
            <center><a href="cambiarclaveusuario.php">Cambiar contraseña</a></center>
            <!--Se coloca el input submit para que se envie el formulario-->
            <input type="submit" name="submit" value="Actualizar">
          <?php 
          /**
           * Fin del recorrido de la consulta $perfil_c
           */
          endforeach 
          ?>
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfildj.js"></script>
    
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del administrador lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>