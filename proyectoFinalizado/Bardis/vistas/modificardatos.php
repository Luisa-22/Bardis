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
 * Si la sesión del administrador está iniciada permite realizar lo siguiente
 */
if (isset($_SESSION['administrador'])) {

  /**
   * Se crea la variable $cedula para almacenar la sesión del administrador la cual contiene 
   * la cédula del administrador que es de tipo cadena de caracteres
   * 
   * @var string $cedula               Cédula del administrador tipo cadena de caracteres
   */
  $cedula = $_SESSION['administrador'];

  /**
   * Consulta a la tabla administrador
   * 
   * Se realiza la consulta '$perfil_a' en la tabla administrador para traer la información referente a ese 
   * administrador
   */
  $perfil_a = mysqli_query($conexion, "SELECT * FROM tbl_administrador WHERE `cedula_administrador` = '$cedula'");

  /**
   * Si se envia el formulario que se encuentra en esta misma página hará lo sgte.
   */
  if (isset($_POST['submit'])) {

    /**
     * Se crea la variable $correoFormulario que almacena el campo que tiene como nombre 'correo',
     * el cual se envia del formulario de este mismo archivo
     * 
     * @var string $correoFormulario             Correo del administrador tipo cadena de caracteres
     */
     $correoFormulario = $_POST['correo'];

    /**
     * Se crea la variable $celular que almacena el campo que tiene como nombre 'celular',
     * el cual se envia del formulario de este mismo archivo  
     * 
     * @var string $celular                      Celular del administrador tipo cadena de caracteres
     * 
     */ 
     $celular = $_POST['celular'];

    /**
     * Actualizar administrador en la base de datos
     * 
     * Se ejecuta la sentencia de actualizar en la tabla administrador para actualizar los datos que se
     * cambiaron del administrador, los campos que se pueden actualizar son el correo y el celular
     */
    $actualizar = mysqli_query($conexion, "UPDATE `tbl_administrador` SET `correo_administrador` = '$correoFormulario', `celular1_administrador` = '$celular' where  `cedula_administrador` = '$cedula'");
    
    /**
    * Si la variable $actualizar se realiza correctamente muestra una alerta de que se actualizó correctamente
    * y lleva al usuario a la vista de su perfil
    */
    if ($actualizar) {
      echo "<script>alert('Se actualizó correctamente');</script>";
      echo "<script>window.location='../vistas/perfiladministrador.php';</script>";
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
    <link rel="stylesheet" href="../css/modificardatos.css">
    <title>Bardis || Administrador-Modificar Perfil</title>
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
              <li><a href="perfiladministrador.php">Inicio</a></li>
              <li><a href="empleados.php">Empleados</a></li>
              <li><a href="modificardatos.php" target="_blank">Modificar perfil</a><br></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>

      <!--Se crea un div que contiene el formulario para modificar un producto -->
      <div class="div-modificar-perfil" id="modificar-perfil" onclick="quitarsubmenu()">
        <!--Se crea el formulario con su página de accion en este mismo archivo -->
        <form action="" method="post">
          <?php 
            /**
             * Se recorré la consulta $perfil_a y se guarda la información en $perfil, para 
             * mostrarla al usuario
             */
            foreach ($perfil_a as $perfil) : 
          ?><br>
            <h2>Modificar perfil</h2>
            <!-- En cada uno de los inputs se coloca:
              Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
              un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están en
              la carpeta js el archivo validaciones.js

              Onpaste="" la función de este es no permitir copiar y pegar texto en ese input

              Y se muestra la información del perfil para lo que se pone el echo y se llama a la 
              variable $perfil que es quién almacenó la información de la consulta $perfil_a, y luego
              se pone el campo que se quiere mostrar
            -->
            <input type="email" name="correo" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Correo" value="<?php echo $perfil['correo_administrador']; ?>">
            <input type="text" name="celular" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Celular" value="<?php echo $perfil['celular1_administrador']; ?>">

            <!--Enlace para cambiar contraseña -->
            <center><a href="cambiarclaveadmin.php">Cambiar contraseña</a></center>
            <!--Se coloca el input submit para que se envie el formulario-->
            <input type="submit" name="submit" value="Actualizar">
          <?php 
          /**
           * Fin del recorrido de la consulta $perfil_a
           */
          endforeach 
          ?>
        </form>
      </div>
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
      <script type="text/javascript" src="../js/perfiladministrador.js"></script>
      <script type="text/javascript" src="../js/validaciones.js"></script>
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del administrador lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>