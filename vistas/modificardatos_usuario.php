<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['cliente']) {

  $cedula = $_SESSION['cliente'];
  $query = mysqli_query($conexion, "SELECT * FROM tbl_cliente WHERE `documento_cliente` = '$cedula'");
  $row = mysqli_fetch_array($query);
  $correo = $row['correo_cliente'];
  $cedula = $row['documento_cliente'];

  $perfiles = mysqli_query($conexion, "SELECT * FROM tbl_cliente WHERE `correo_cliente` =  '$correo'");

  if (isset($_POST['submit'])) {

    $nombre = $_POST['nombre'];
    $correoFormulario = $_POST['correo'];
    $edad = $_POST['edad'];

    $actualizar = mysqli_query($conexion, "UPDATE `tbl_cliente` SET `nombre_cliente` = '$nombre', `correo_cliente` = '$correoFormulario', `edad_cliente` = '$edad' where  `documento_cliente` = '$cedula'");
    header('Location: perfilusuario.php');
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
    <link rel="stylesheet" href="../css/modificardatos_usuario.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Cliente-Modificar Perfil</title>
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
      <div class="actualizar-datos">
        <form action="" method="post">
          <?php foreach ($perfiles as $perfil) : ?>
            <h2>Modificar perfil</h2>
            <input type="text" name="nombre" onkeypress="return SoloLetras(event)" onpaste="return false" value="<?php echo $perfil['nombre_cliente']; ?>" placeholder="Nombre de usuario">
            <input type="text" name="correo" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" value="<?php echo $perfil['correo_cliente']; ?>" placeholder="Correo">
            <input type="text" name="edad" onkeypress="return SoloNumeros(event)" onpaste="return false" value="<?php echo $perfil['edad_cliente']; ?>" placeholder="Edad">
            <center><a href="cambiarclaveusuario.php">Cambiar contraseña</a></center>
            <input type="submit" name="submit" value="Actualizar">
          <?php endforeach ?>
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