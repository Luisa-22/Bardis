<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

  $cedula = $_SESSION['administrador'];
  $query = mysqli_query($conexion, "SELECT * FROM tbl_administrador WHERE `cedula_administrador` = '$cedula'");

  $row = mysqli_fetch_array($query);
  $correo = $row['correo_administrador'];
  $cedula = $row['cedula_administrador'];

  $perfiles = mysqli_query($conexion, "SELECT * FROM tbl_administrador WHERE `correo_administrador` =  '$correo'");

  if (isset($_POST['submit'])) {

    $correoFormulario = $_POST['correo'];
    $celular = $_POST['celular'];

    $actualizar = mysqli_query($conexion, "UPDATE `tbl_administrador` SET `correo_administrador` = '$correoFormulario', `celular1_administrador` = '$celular' where  `cedula_administrador` = '$cedula'");
    header('Location: perfiladministrador.php');
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
    <link rel="stylesheet" href="../css/modificardatos.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Administrador-Modificar Perfil</title>
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
            <h3><?php echo $nombre . " " . $apellido;  ?>
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
      <div class="div-modificar-perfil" id="modificar-perfil" onclick="quitarsubmenu()">
        <form action="" method="post">
          <?php foreach ($perfiles as $perfil) : ?>
            <h2>Modificar perfil</h2>
            <input type="email" name="correo" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Correo" value="<?php echo $perfil['correo_administrador']; ?>">
            <input type="text" name="celular" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Celular" value="<?php echo $perfil['celular1_administrador']; ?>">

            <center><a href="cambiarclaveadmin.php">Cambiar contraseña</a></center>
            <input type="submit" name="submit" value="Actualizar">
          <?php endforeach ?>
        </form>
      </div>
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
      <script type="text/javascript" src="../js/modificardatos.js"></script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>