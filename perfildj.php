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
    <link rel="stylesheet" href="../css/perfildj.css">
    <title>Bardis || DJ-Perfil</title>
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

      <!--Se crea un div para que muestre el botón Música, el cual tiene una imagen alusiva -->
      <div id="btn" onclick="quitarsubmenu()">
        <button><a href="categoriamusica_dj.php"><img src="../image/dj-mixer.png"></a><br>Música</button>
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