<?php

include '../php/conexion.php';

session_start();
if ($_SESSION['administrador']) {

?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Administrador-Pedidos</title>
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <link rel="stylesheet" href="../css/pedidos.css">
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
            header('Refresh:5;');
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
      <a href="perfiladministrador.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
      <div id="div-pedidos" onclick="quitarsubmenu()">
        <?php
        include "../php/conexion.php";
        $registro = mysqli_query($conexion, "SELECT numero_mesa,id_pedido,total,id_estado FROM tbl_pedido WHERE id_estado = 'E01'") or die('error con el dato');
        while ($row = mysqli_fetch_array($registro)) {
        ?>
          <div class="div-tablas">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="3">
                    <center>Mesa <?php echo $row['numero_mesa']; ?></center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th colspan="">Producto</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                </tr>
                <tr>
                  <?php $idPedido = $row['id_pedido'];
                  $sql = mysqli_query($conexion, "SELECT id_producto,cantidad FROM tbl_pedido_producto WHERE id_pedido=$idPedido");
                  while ($producto = mysqli_fetch_array($sql)) {
                  ?>
                    <?php 
                    $idP = $producto['id_producto'];
                    $selectP = mysqli_query($conexion, ("SELECT nombre_producto,precio_producto FROM tbl_producto WHERE id_producto=$idP"));
                    while ($rowPro = mysqli_fetch_array($selectP)) {
                    ?>

                      <td class="nombre"> <?php echo $rowPro['nombre_producto'] ?></td>
                      <td><?php echo $producto['cantidad'] ?></td>
                      <td><?php echo "$" . $rowPro['precio_producto'] ?></td>

                </tr>
                <tr>
                <?php
                    }
                ?>
              <?php } ?>
              <td colspan="2">Total:</td>
              <td><?php echo "$" . $row['total'] ?></td>
                </tr>
              </tbody>
              <tfoot>
                <form action="../php/pedidoatendido.php" method="POST">
                  <tr>
                    <td colspan="4"><a href="../pdf/prueba.php?pedido=<?php echo $idPedido ?>" class="boton-factura">Generar factura</a>
                      <input type="hidden" value="<?php echo $idPedido ?>" name="pedido-atendido">
                      <input name="submit" class="boton-pedido" type="submit" value="Pedido Atendido"></input></td>
                  </tr>
                </form>
              </tfoot>
            </table>
          </div>

        <?php } ?>
      </div>
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="text/javascript" src="../js/perfiladministrador.js"></script>
  </body>

  </html>

<?php } else {
  header('location: ../index.php');
} ?>