<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['mesero']) {

  $cedula = $_SESSION['mesero'];
  $query = mysqli_query($conexion, "SELECT * FROM tbl_empleado WHERE `cedula_empleado` = '$cedula'");
  $row = mysqli_fetch_array($query);
  $correo = $row['correo_empleado'];
  $cedula = $row['cedula_empleado'];

  $perfiles = mysqli_query($conexion, "SELECT * FROM tbl_empleado WHERE `cedula_empleado` =  '$cedula'");

  if (isset($_POST['submit'])) {

    $password_actual = $_POST['password_actual'];
    $password_nueva = $_POST['password_nueva'];
    $password_repetir = $_POST['password_repetir'];

    if ($clave = $password_actual and $password_nueva = $password_repetir) {

      $actualizar = mysqli_query($conexion, "UPDATE `tbl_empleado` 
SET  `clave_empleado` = '$password_nueva' where  `cedula_empleado` = '$cedula' 
and `clave_empleado` = '$password_actual'");

      echo "<script type='text/javascript'>alert('Se actualizó correctamente su contraseña');</script>";
      echo "<script>window.location='../vistas/perfilmesero.php';</script>";
    } else {
      echo "Error al actualizar";
    }
  }

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Cambiar contraseña</title>
    <link rel="stylesheet" href="../css/cambiarcontraseña.css">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            $cedula = $_SESSION['mesero'];
            $query = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `cedula_empleado` = '$cedula'");
            $row = mysqli_fetch_array($query);
            $nombre = $row['nombre_empleado'];
            $apellido = $row['apellido_empleado'];
            ?>
            <h3><?php echo $nombre . " " . $apellido;  ?>
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
          </section>
          <section id="section-opc">
            <ul>
              <li><a href="perfilmesero.php">Inicio</a></li>
              <li><a href="cambiarclavemesero.php">Cambiar contraseña</a></li>
              <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </section>
        </div>
      </div>
      <div class="">
        <form class="" action="#" method="post">
          <?php foreach ($perfiles as $perfil) : ?>
            <h3>Cambiar contraseña</h3>
            <input type="password" name="password_actual" placeholder="Contraseña actual" required>
            <input type="password" name="password_nueva" placeholder="Contraseña nueva" required>
            <input type="password" name="password_repetir" placeholder="Confirmar contraseña" required>
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