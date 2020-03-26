<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <?php
  include '../php/conexion.php';


  if ($_GET['mesa']) {

    $id = $_GET['mesa'];

    $mesa = mysqli_query($conexion, "SELECT * FROM `tbl_mesa` where `numero_mesa` = '$id'");

    $consulta = mysqli_num_rows($mesa);

    if ($consulta == 0) {
      header('location: mesas.php');
    }
  } else {
    header('location: mesas.php');
  }

  if (isset($_POST['submit'])) {

    $numeroMesa = $_POST['numeroMesa'];
    $ubicacionMesa = $_POST['ubicacionMesa'];

    $actualizar = mysqli_query($conexion, "UPDATE `tbl_mesa` SET  `numero_mesa` = '$numeroMesa',
    `ubicacion_mesa` = '$ubicacionMesa'
    WHERE `tbl_mesa`.`numero_mesa` = '$id'");
    header('location: modificarmesas.php');
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
    <title>Bardis || Administrador-Modificar Mesa</title>
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
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <?php foreach ($mesa as $mesas) : ?>
            <h2>Modificar mesa</h2>
            <input type="text" name="numeroMesa" onkeypress="return SoloNumeros(event)" onpaste="return false" value="<?php echo $mesas['numero_mesa']; ?>" placeholder="Número de mesa">

            <input type="text" name="ubicacionMesa" onkeypress="return SoloLetrasyNumeros(event)" onpaste="return false" value="<?php echo $mesas['ubicacion_mesa']; ?>" placeholder="Ubicacion de mesa">

            <input type="submit" name="submit" value="Actualizar">
          <?php
          endforeach
          ?>
      </div>
      </form>
    </div>


    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/modificardatos.js">

    </script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>