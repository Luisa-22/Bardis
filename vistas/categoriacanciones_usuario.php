<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['cliente']) {

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/categoriacanciones_usuario.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Cliente-Solicitud Canciones</title>
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            $cedula = $_SESSION['cliente'];
            $query = mysqli_query($conexion, "SELECT * FROM `tbl_cliente` where `documento_cliente` = '$cedula'");
            $row = mysqli_fetch_array($query);
            $nombre = $row['nombre_cliente'];
            ?>
            <h3><?php echo $nombre ?>
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
          </section>
          <section id="section-opc">
            <ul>
              <li><a href="perfilusuario.php">Inicio</a></li>
              <li><a href="modificardatos_usuario.php" target="_blank">Modificar perfil</a><br></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>
      <div class="form-producto">
        <a href="perfilusuario.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
        <form class="" action="../php/registrarcanciones.php" method="post">
          <h2>Solicitud de canciones</h2>

          <input type="hidden" name="ced_cliente" value="<?php echo $_SESSION['cliente']; ?>">
          
          <input type="text" name="nombreCancion" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre de la canción">
          <input type="text" name="nombreInterprete" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombre de artista (opcional)">
          <p>Para una mejor búsqueda de su canción<br> ingresa el nombre del artista.</p>
          <input type="submit" name="submit" value="Solicitar canción">
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfildj.js">

    </script>
  </body>

  </html>


<?php } else {
  header('location: ../index.php');
} ?>