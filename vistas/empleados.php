<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Empleados</title>
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/empleados.css">
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
      <div id="contenedor-empleados">
        <div class="form-empleados">
          <form action="../php/registrar_empleado.php" method="post">
            <h2>Registro Mesero/DJ</h2>
            <input type="hidden" name="ced_admin" value="<?php echo $_SESSION['administrador']; ?>">
            <input type="text" name="cedula" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Cédula">
            <input type="text" name="nombreEmpleado" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Nombres">
            <input type="text" name="apellidoEmpleado" onkeypress="return SoloLetras(event)" onpaste="return false" placeholder="Apellidos">
            <select class="" name="rol">
              <option disabled selected>Rol</option>

              <?php

              include "../php/conexion.php";

              $query = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado");

              while ($row = mysqli_fetch_array($query)) {
              ?>
                <option value="<?php echo $row['id_tipo_empleado']; ?>"><?php echo $row['tipo_empleado']; ?></option>
              <?php
              }

              ?>

            </select>

            <input type="email" name="correoEmpleado" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Correo">
            <input type="text" name="celularEmpleado" onkeypress="return SoloNumeros(event)" onpaste="return false" placeholder="Celular">
            <input type="password" name="password" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Contraseña">
            <input type="password" name="confirmarPassword" onkeypress="return SoloNumerosyLetras(event)" onpaste="return false" placeholder="Confirmar contraseña">
            <input type="submit" name="submit" value="Enviar">
          </form>
        </div>
        <div class="tabla-empleados">
          <table>
            <thead>
              <th>Cédula</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Celular</th>
              <th>Cargo</th>
              <th colspan="2">Accion</th>

            </thead>

            <?php

            $empleado = mysqli_query($conexion, "SELECT * FROM tbl_empleado");

            while ($rowEmpleado = mysqli_fetch_array($empleado)) {

            ?>
              <tbody>
                <form action="../php/registrar_empleado.php" method="post">
                  <tr>
                    <td><?php echo $rowEmpleado['cedula_empleado']; ?></td>
                    <td><?php echo $rowEmpleado['nombre_empleado']; ?></td>
                    <td><?php echo $rowEmpleado['apellido_empleado']; ?></td>

                    <td><?php echo $rowEmpleado['correo_empleado']; ?></td>
                    <td><?php echo $rowEmpleado['celular1_empleado']; ?></td>

                    <input type="hidden" value="<?php echo $rowEmpleado['id_tipo_empleado']; ?>">

                    <?php
                    $id_tipo = $rowEmpleado['id_tipo_empleado'];
                    $tipo = mysqli_query($conexion, "SELECT * FROM tbl_tipo_empleado WHERE id_tipo_empleado='$id_tipo'");
                    while ($rowTipo = mysqli_fetch_array($tipo)) {
                    ?>

                      <td><?php echo $rowTipo['tipo_empleado']; ?></td>

                      <td>
                        <a style="color:#fff;text-decoration: none;" class="enlace-btn" href="../vistas/modificardatos_empleados.php?empleado=<?php echo $rowEmpleado['cedula_empleado']; ?>">
                          <button class="btn-modificar">Modificar</a></button>

                        <a style="color:#fff;text-decoration: none;" href="../php/eliminarempleado.php?empleado=<?php echo $rowEmpleado['cedula_empleado']; ?>">
                          <button class="btn-eliminar">Eliminar</a></button>
                      </td>
                  </tr>
                </form>
              </tbody>

            <?php
                    }
            ?>
          <?php
            }
          ?>

          </table>

        </div>

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