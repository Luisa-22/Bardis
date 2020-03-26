<?php

include 'conexion.php';

if (isset($_GET['codigo'])) {

  $id = $_GET['codigo'];

  if (isset($_POST['submit'])) {
    $nuevaContraseña = $_POST['nuevaPassword'];
    $confirmarContraseña = $_POST['confirmarPassword'];
    $rol = $_POST['rol'];

    if ($rol == 'user') {
      if ($nuevaContraseña = $confirmarContraseña) {
        $contraseña = $nuevaContraseña;
        $cliente = mysqli_query($conexion, "UPDATE `tbl_cliente` SET `clave_cliente` = '$contraseña' WHERE `documento_cliente` = '$id'");
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } else {
        "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }

    if ($rol == 'admin') {
      if ($nuevaContraseña = $confirmarContraseña) {
        $contraseña = $nuevaContraseña;
        $administrador = mysqli_query($conexion, "UPDATE `tbl_administrador` SET `clave_administrador` = '$contraseña' WHERE `cedula_administrador` = '$id'");
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } else {
        echo "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }

    if ($rol == '001') {
      if ($nuevaContraseña = $confirmarContraseña) {
        $contraseña = $nuevaContraseña;
        $mesero = mysqli_query($conexion, "UPDATE `tbl_empleado` SET `clave_empleado` = '$contraseña' WHERE `cedula_empleado` = '$id' and id_tipo_empleado = '001'");
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } else {
        echo "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }

    if ($rol == '002') {
      if ($nuevaContraseña = $confirmarContraseña) {
        $contraseña = $nuevaContraseña;
        $dj = mysqli_query($conexion, "UPDATE `tbl_empleado` SET `clave_empleado` = '$contraseña' WHERE `cedula_empleado` = '$id' and  id_tipo_empleado = '002'");
        echo "<script>alert('Contraseña actualizada');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
      } else {
        "<script type='text/javascript'>alert('Error al cambiar la contraseña');</script>";
      }
    }
  }
} else {
  header('location: ../vistas/iniciar_sesion.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/recuperarclave.css">
  <title>Recuperar contraseña</title>
</head>

<body>
  <div id="container">
    <div id="header">
      <ion-icon name="menu" id="icon-menu" onclick="menu()"></ion-icon>
      <nav>
        <img src="../logo/IconoLu17.png" alt="">
        <div id="">
          <ul id="nav-menu"><br>
            <li><a href="">Inicio</a>
            </li>
            <li><a href="../vistas/registro.php">Regístrate</a>
            </li>
            <li><a href="../index.php#contacto">Contáctanos</a></li>
            <li><a href="../vistas/iniciar_sesion.php">Inicio de sesión</a>
          </ul>
        </div>
      </nav>
    </div>
    <div id="recuperarclave">
      <form action="" method="POST">
        <p>Recuperar contraseña</p>
        <select class="" name="rol">
          <option disabled selected>Rol</option>
          <option value="admin">Administrador</option>
          <option value="user">Cliente</option>
          <?php
          $query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");
          while ($row = mysqli_fetch_array($query)) {
          ?>
            <option value="<?php echo $row['id_tipo_empleado']; ?>"><?php echo $row['tipo_empleado']; ?></option>
          <?php
          }
          ?>
        </select>
        <input type="password" name="nuevaPassword" id="" placeholder="Nueva contraseña">
        <input type="password" name="confirmarPassword" id="" placeholder="Confirmar contraseña">
        <input type="submit" name="submit" id="" value="Cambiar contraseña">
      </form>
    </div>
  </div>

</body>

</html>