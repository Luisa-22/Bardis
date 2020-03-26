<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['dj']) {

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/perfildj.css">
    <title>Bardis || DJ-Perfil</title>
  </head>

  <body>
    <div id="container">
      <div id="perfiladmin">
        <img src="../logo/IconoLu17.png" id="img-1">
        <div class="perfil-admin">
          <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>

            <?php
            $cedula = $_SESSION['dj'];
            $query = mysqli_query($conexion, "SELECT * FROM `tbl_empleado` where `cedula_empleado` = '$cedula'");
            $row = mysqli_fetch_array($query);
            $nombre = $row['nombre_empleado'];
            $apellido = $row['apellido_empleado'];
            ?>

            <h3><?php echo $nombre . " " . $apellido;  ?>
              <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">
              <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
              <section id="section-opc">
                <ul>
                  <li><a href="perfildj.php">Inicio</a></li>
                  <li><a href="cambiarclavedj.php">Cambiar contraseña</a></li>
                  <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
                </ul>
              </section>
        </div>
      </div>
      <div id="btn" onclick="quitarsubmenu()">
        <button><a href="categoriamusica_dj.php"><img src="../image/dj-mixer.png"></a><br>Música</button>
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