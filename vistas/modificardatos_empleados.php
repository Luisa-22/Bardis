<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <?php
  include '../php/conexion.php';


  if ($_GET['empleado']) {

    $id = $_GET['empleado'];

    $empleado = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `cedula_empleado` = '$id'");

    $consulta = mysqli_num_rows($empleado);

    if ($consulta == 0) {
      header('location: empleados.php');
    }
  } else {
    header('location: empleados.php');
  }

  if (isset($_POST['submit'])) {

    $cedulaEmpleado = $_POST['$cedulaEmpleado'];
    $nombreEmpleado = $_POST['$nombreEmpleado'];
    $apellidoEmpleado = $_POST['apellidoEmpleado'];
    $celularEmpleado = $_POST['celularEmpleado'];
    $correoEmpleado = $_POST['correoEmpleado'];
    $claveEmpleado = $_POST['claveEmpleado'];


    $actualizar = mysqli_query($conexion, "UPDATE `tbl_empleado` SET  `celular1_empleado` = '$celularEmpleado',
    `correo_empleado` = '$correoEmpleado' WHERE `tbl_empleado`.`cedula_empleado` = '$id'");
    header('location: modificardatos_empleados.php');
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
    <link rel="stylesheet" href="../css/modificardatos_empleado.css">
    <script type="text/javascript" src="../js/validaciones.js"></script>
    <title>Bardis || Administrador-Modificar Empleados</title>
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
      <div class="actualizar-datos">
        <form class="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <?php foreach ($empleado as $empleados) : ?>
            <h2>Modificar Empleado</h2>
            <input type="text" name="celularEmpleado" onkeypress="return SoloNumeros(event)" onpaste="return false" value="<?php echo $empleados['celular1_empleado']; ?>" placeholder="Celular">
            <input type="text" name="correoEmpleado" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" value="<?php echo $empleados['correo_empleado']; ?>" placeholder="Correo">
            <input type="submit" name="submit" value="Actualizar">
          <?php
          endforeach
          ?>
      </div>
      </form>
    </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js">

    </script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
}
