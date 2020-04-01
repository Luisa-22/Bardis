<?php
include '../php/conexion.php';
session_start();
if ($_SESSION['mesero']) {
  if (isset($_SESSION['carrito'])) {
    if (isset($_GET['id'])) {
      $arreglo = $_SESSION['carrito'];
      $encontro = false; 
      $posicion = 0; 
      
      for ($i = 0; $i < count($arreglo); $i++) {
        if ($arreglo[$i]['Id'] == $_GET['id']) {
          $encontro = true;
          $posicion = $i;
        }
      }
      if ($encontro == true) {
        $arreglo[$posicion]['Cantidad'] =$arreglo[$posicion]['Cantidad']+1;
        $_SESSION['carrito']=$arreglo;

      } else {
        $id = $_GET['id'];
        $nombre = "";
        $precio = 0;
        $productoC = mysqli_query($conexion, "SELECT * FROM tbl_producto WHERE id_producto = '$id'");
        while ($rowC = mysqli_fetch_array($productoC)) {
          $nombre = $rowC['nombre_producto'];
          $precio = $rowC['precio_producto'];
        }
        $arregloNuevo = array(
          'Id' => $id,
          'Nombre' => $nombre,
          'Precio' => $precio,
          'Cantidad' => 1
        );
        
        array_push($arreglo, $arregloNuevo);
        $_SESSION['carrito'] = $arreglo;
      }
      
    }
  } else {
    if (isset($_GET['id'])) {
      
      $id = $_GET['id'];
      $nombre = "";
      $precio = 0;
      
      $productoC = mysqli_query($conexion, "SELECT * FROM tbl_producto WHERE id_producto = '$id'");
    
      while ($rowC = mysqli_fetch_array($productoC)) {
        $nombre = $rowC['nombre_producto'];
        $precio = $rowC['precio_producto'];
      }
      $arreglo[] = array(
        'Id' => $id,
        'Nombre' => $nombre,
        'Precio' => $precio,
        'Cantidad' => 1
      );
      $_SESSION['carrito'] = $arreglo;
    }
  }
?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Bardis || Mesero-Ver pedido</title>
    <link rel="stylesheet" href="../css/vercarrito.css">
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
      <div class="tabla-pedido">
        <div class="pedido">
          <center>
            <h2>Pedido</h2>
          </center>
          <table>
            <thead>
              <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
              <tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if (isset($_SESSION['carrito'])) {
                $datos = $_SESSION['carrito'];
                
                $total=0;
                for ($i = 0; $i < count($datos); $i++) {
              ?>
              <div class="producto">
                  <tr>
                    <td><?php echo $datos[$i]['Nombre'];?></td>
                    <td><?php echo "$" . $datos[$i]['Precio'];?></td>
                    <td>
                      <input type="text" value="<?php echo $datos[$i]['Cantidad'];?>" 
                      data-precio="<?php echo $datos[$i]['Precio'];?>" 
                      data-id="<?php echo $datos[$i]['Id'];?>" 
                      class="cantidad">
                    </td>
                    <td class="subtotal">Subtotal: <?php echo "$" . $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></td>
                    <td>
                      <a id="eliminar-prod"href="../php/eliminardecarrito.php?Pos=<?php echo $i; ?>">
                        Eliminar</a>
                    </td>
                    </tr>
                </div>
              <?php
                  $total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
                }
              } else {
                echo "El pedido está vacío";
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <form action="../php/enviarcarrito.php" method="post">
                  <input type="hidden" name="total_p" value="<?php echo $total; ?>">
                  <input type="hidden" name="ced_mesero" value="<?php echo $_SESSION['mesero']; ?>">
                  <td id="total" colspan="5">Total: <?php echo "$".$total; ?></td>
                  <tr>
                  <td colspan=""><a href="categoriasnuevas.php" id="Volver"/>Seguir pidiendo</a></td>
                  <td colspan="2"><select name="mesa"  style="width:60%;">
                      <option disabled selected>Mesa</option>
                      <?php
                      $query = mysqli_query($conexion, "SELECT * FROM tbl_mesa");
                      while ($row = mysqli_fetch_array($query)) {
                      ?>
                        <option value="<?php echo $row['numero_mesa']; ?>"><?php echo $row['numero_mesa']; ?></option>
                      <?php
                      }
                      ?>
                    </select></td>
                  <td colspan="2" style="padding:0 0 0 100px;"><input type="submit" name="enviar" value="Enviar"></td>
                  </tr>
                </form>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
      <script type="text/javascript" src="../js/perfilmesero.js"></script>
      <script type="text/javascript"  src="../js/jquery.js"></script>
      <script type="text/javascript"  src="../js/actualizarcarrito.js"></script>

      
  </body>

  </html>
<?php
} else {
  header('location: ../index.php');
} ?>