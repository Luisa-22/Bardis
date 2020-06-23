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
 * Si existe la sesion del cliente haga lo sgte.
 */
if ($_SESSION['cliente']) {

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/categoriacanciones_usuario.css">
    <title>Bardis || Cliente-Solicitud Canciones</title>
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <!--Se coloca el logo del sistema-->
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
           <!--Se crea una sección que contiene la imagen de un usuario en general y el nombre 
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
              <li><a href="modificardatos_usuario.php" target="_blank">Modificar perfil</a><br></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>

      <!--Se crea un div que contiene el formulario de solicitar canción -->
      <div class="form-producto">
        <!--Se pone un enlace para volver a la pestaña del perfil -->
        <a href="perfilusuario.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
        <!--Se crea un formulario para solicitar una cancion con su página de acción al momento de enviar 
            el formulario, en la carpeta php en el archivo registrarcanciones.php
        -->
        <form class="" action="../php/registrarcanciones.php" onsubmit="return validarFormularioCancion()" method="post">
          <h2>Solicitud de canciones</h2>
  
          <!-- Se captura la cédula del cliente que está solicitando la canción en un input oculto -->
          <input type="hidden" name="ced_cliente" value="<?php echo $_SESSION['cliente']; ?>">
          
          <!-- En algunos de los inputs se coloca:
              Onkeypress="" la función de este es validar los caracteres que acepta el input, realizando
              un llamado al evento "SoloNumeros", "SoloLetras" o "SoloNumerosyLetras" los cuales están en
              la carpeta js el archivo validaciones.js

            Onpaste="" la función de este es no permitir copiar y pegar texto en ese input
          -->
          <input type="text" id="nombreCancion" name="nombreCancion" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre de la canción">
          <h5 id="alertaNombreCancion"></h5>
          <input type="text" name="nombreInterprete" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre de artista (opcional)">
          <!--Se coloca un parrafo para hacer una aclaración al usuario -->
          <p>Para una mejor búsqueda de su canción<br> ingresa el nombre del artista.</p>

          <!--Se coloca el input submit para que se envie el formulario-->
          <input type="submit" name="submit" value="Solicitar canción">
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfildj.js"></script>
    <script type="text/javascript" src="../js/validaciones.js"></script>
  </body>

  </html>

<?php } else {
  /**
  * Si no está la sesion del cliente lo que hace es que lleva al index
  */
  header('location: ../index.php');
} ?>