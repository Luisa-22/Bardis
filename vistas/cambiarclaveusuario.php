<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['cliente']) {

  $cedula = $_SESSION['cliente'];
  $query = mysqli_query($conexion, "SELECT * FROM tbl_cliente WHERE `documento_cliente` = '$cedula'");
  $row = mysqli_fetch_array($query);
  $correo = $row['correo_cliente'];
  $cedula = $row['documento_cliente'];

  $perfiles = mysqli_query($conexion, "SELECT * FROM tbl_cliente WHERE `documento_cliente` =  '$cedula'");

  if (isset($_POST['submit'])) {

    $password_actual = $_POST['password_actual'];
    $password_nueva = $_POST['password_nueva'];
    $password_repetir = $_POST['password_repetir'];

    if ($clave  = $password_actual and $password_nueva = $password_repetir) {

      $actualizar = mysqli_query($conexion, "UPDATE `tbl_cliente` 
SET  `clave_cliente` = '$password_nueva' where  `documento_cliente` = '$cedula' 
and `clave_cliente` = '$password_actual'");

      header('Location: perfilusuario.php');
    } else {
      $error = 'Contraseña erronea';
      echo "<script type='text/javascript'> alert($error);</script>";
    }
  }
?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/perfilusuario.css">
    <link rel="stylesheet" href="../css/cambiarcontraseña.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Cliente-Perfil</title>
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
              <li><a href="modificardatos_usuario.php">Modificar perfil</a><br></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>
      <div class="">
        <form class="" action="#" method="post">
          <?php foreach ($perfiles as $perfil) : ?>
            <h3>Cambiar contraseña</h3>
            <input type="password" name="password_actual" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña actual" required>
            <input type="password" name="password_nueva" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña nueva" required>
            <input type="password" name="password_repetir" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Confirmar contraseña" required>
            <input type="submit" name="submit" value="Cambiar contraseña">
          <?php endforeach ?>
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/modificardatos.js"></script>
  </body>

  </html>


<?php } else {
  header('location: ../index.php');
} ?>