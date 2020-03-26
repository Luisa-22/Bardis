<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['mesero']) {

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Pedidos</title>
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/categoriapedidosmesero.css">
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
            header("Refresh: 5;");
            ?>
            <h3><?php echo $nombre . " " . $apellido; ?>
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
      <div id="pedido-mesero">
        <a href="perfilmesero.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
        <div class="contenedor-cartas">
          <?php
          include "../php/conexion.php";

          $registro2 = mysqli_query($conexion, "SELECT * FROM tbl_estado, tbl_pedido 
             WHERE tbl_estado.id_estado = tbl_pedido.id_estado") or die('error con el dato');


          $registro = mysqli_query($conexion, "SELECT numero_mesa,id_pedido,total,id_estado 
            FROM tbl_pedido WHERE cedula_empleado='$cedula'") or die('error con el dato');

          while ($row2 = mysqli_fetch_array($registro2)) {

            while ($row = mysqli_fetch_array($registro)) {

          ?>
              <div class="carta-pedido">
                <div class="img-pedido">
                  <center>
                    <h3>Mesa <?php echo $row['numero_mesa']; ?></h3>
                  </center>
                  <img src="../image/table.png">
                </div>
                <div class="texto-pedido">

                  <label>Estado:<font color="#1e90ff">
                      <b>
                        <?php
                        if ($row['id_estado'] == 'E02') {
                          echo 'Atendido';
                        } else if ($row['id_estado'] == 'E01') {
                          echo 'Proceso';
                        }
                        ?>
                      </b></font></label><br>

                  <h3>Total:<?php echo " $" . $row['total'] ?></h3><br>
                  <h4>Descripción</h4>
                  <?php $idPedido = $row['id_pedido'];
                  $sql = mysqli_query($conexion, "SELECT id_producto,cantidad FROM tbl_pedido_producto WHERE id_pedido=$idPedido");
                  while ($producto = mysqli_fetch_array($sql)) {
                  ?>
                    <?php $idP = $producto['id_producto'];
                    $selectP = mysqli_query($conexion, ("SELECT nombre_producto,precio_producto FROM tbl_producto WHERE id_producto=$idP"));
                    while ($rowPro = mysqli_fetch_array($selectP)) {
                    ?>
                      <p><?php echo $producto['cantidad'] . " " . $rowPro['nombre_producto'] ?></p>
                    <?php
                    }
                    ?>
                  <?php
                  }

                  ?>
                </div>
              </div>
          <?php
            }
          }

          ?>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfilmesero.js"></script>
  </body>

  </html>
<?php } else {
  header('location: ../index.php');
} ?>