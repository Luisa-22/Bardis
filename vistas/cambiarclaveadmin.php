<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

  $cedula = $_SESSION['administrador'];
  $query = mysqli_query($conexion, "SELECT * FROM tbl_administrador WHERE `cedula_administrador` = '$cedula'");
  $row = mysqli_fetch_array($query);
  $correo = $row['correo_administrador'];
  $cedula = $row['cedula_administrador'];

  $perfiles = mysqli_query($conexion, "SELECT * FROM tbl_administrador WHERE `cedula_administrador` =  '$cedula'");

  if (isset($_POST['submit'])) {

    $password_actual = $_POST['password_actual'];
    $password_nueva = $_POST['password_nueva'];
    $password_repetir = $_POST['password_repetir'];

    if ($clave  = $password_actual and $password_nueva = $password_repetir) {

      $actualizar = mysqli_query($conexion, "UPDATE `tbl_administrador` 
SET  `clave_administrador` = '$password_nueva' where  `cedula_administrador` = '$cedula' 
and `clave_administrador` = '$password_actual'");

      echo "<script type='text/javascript'>alert('Se actualizó correctamente su contraseña');</script>";
      echo "<script>window.location='../vistas/perfiladministrador.php';</script>";
    } else {
      echo "Error al actualizar";
    }
  }

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Cambiar contraseña</title>
    <link rel="stylesheet" href="../css/cambiarcontraseña.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            $cedula = $_SESSION['administrador'];
            $query = mysqli_query($conexion, "SELECT * FROM `tbl_administrador` where `cedula_administrador` = '$cedula'");
            $row = mysqli_fetch_array($query);
            $nombre = $row['nombre_administrador'];
            $apellido = $row['apellido_administrador'];
            ?>
            <h3><?php echo $nombre . " " . $apellido; ?>
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
          </section>
          <section id="section-opc">
            <ul>
              <li><a href="perfiladministrador.php">Inicio</a></li>
              <li><a href="mesas.php">Mesas</a></li>
              <li><a href="empleados.php">Empleados</a></li>
              <li><a href="modificardatos.php" target="_blank">Modificar perfil</a><br></li>
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