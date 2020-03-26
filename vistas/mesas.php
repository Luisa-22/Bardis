<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/icon-logo1.ico" type="image/x-icon">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/mesas.css">
    <title>Bardis || Administrador-Mesas</title>
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

            <h3> <?php echo $nombre . " " . $apellido;  ?>
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
      <div class="mesas">
        <form action="../php/registrarmesa.php" method="post">
          <h3>Registrar mesa</h3>
          <input type="text" name="numeroMesa" placeholder="Número de mesa">
          <input type="text" name="ubicacionMesa" placeholder="Ubicación de mesa">
          <input type="submit" name="submit" value="Registrar">
        </form>
      </div>
      <div class="table-mesas">
        <table>
          <thead>
            <tr>
              <th>Número de mesa</th>
              <th>Ubicación</th>
              <th>Acción</th>
            </tr>
          </thead>
          <?php

          include "../php/conexion.php";

          $mesa = mysqli_query($conexion, "SELECT * FROM tbl_mesa");

          while ($rowMesa = mysqli_fetch_array($mesa)) {

          ?>
            <tbody>

              <form action="../php/registrarmesa.php" method="post">
                <tr>
                  <td><?php echo $rowMesa['numero_mesa']; ?></td>
                  <td><?php echo $rowMesa['ubicacion_mesa']; ?></td>

                  <td><a style="color:#fff;text-decoration: none;" class="enlace-btn" href="modificarmesas.php?mesa=<?php echo $rowMesa['numero_mesa']; ?>">
                      <button class="btn-modificar">Modificar</a></button>

                    <a style="color:#fff;text-decoration: none;" href="../php/eliminarmesa.php?mesa=<?php echo $rowMesa['numero_mesa']; ?>">
                      <button class="btn-eliminar">Eliminar</a></button></td>

                </tr>
              </form>
            </tbody>

          <?php
          }
          ?>

        </table>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js">

    </script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>