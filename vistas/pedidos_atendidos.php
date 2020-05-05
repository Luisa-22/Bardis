<?php
/**se incluye la conexión. */
include '../php/conexion.php';
/**Se inicia la sesión del administrador */
session_start();
/**Si le sesión del administrador esta iniciada se motrará el contenido */
if ($_SESSION['administrador']) {
?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title>Bardis || Administrador-Pedidos</title>
        <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
        <link rel="stylesheet" href="../css/pedidos_atendidos.css">
        
    </head>

    <body>
        <div id="container">
            <div id="perfiladmin">
                <img src="../logo/IconoLu17.png" id="img-1">
                <div class="perfil-admin">
                <section id="section-perfil">
            <img src="../image/usuario.png" alt="" id="img-perfil"><br>
            <?php
            /**
             * @var $cedula es igual a la session del administrador.
             */
            $cedula = $_SESSION['administrador'];
            /**
             * @var $query es la variable con la que hacemos la consulta a la tabla administrador. 
             */
            $query = mysqli_query($conexion, "SELECT * FROM `tbl_administrador` where `cedula_administrador` = '$cedula'");
            /**
             *  @var $row es igual a mysqli_fetch_array le pasamos como parametro la variable $query
             * y así $row nos va a traer los datos de la tabal administrador
             */
            $row = mysqli_fetch_array($query);
            /**
             * @var $nombre es igual al nombre del administrador.
             */
            $nombre = $row['nombre_administrador'];
            /**
             * @var $nombre es igual al apellido del administrador.
             */
            $apellido = $row['apellido_administrador'];
            /**
             * Con header('Refresh:5;') conseguimos que la pagina se refresque cada 5 segundos.
             */
            header('Refresh:5;');
            ?>
            <h3><?php
            /**
             * Contatenamos la variable @var $nombre y @var $apellido. 
             */ 
                echo $nombre . " " . $apellido;  
              ?>
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
            <div id="fecha">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <center><input type="date" name="fecha" id="fecha" value="<?php echo date("Y-m-d"); ?>">
                    <input type="submit" name="submit" value="Buscar">
                    </center>
                </form>
            </div>

            <div id="div-pedidos" onclick="quitarsubmenu()">
                <?php
                /**
                 * Si se hace click en el boton name = 'submit' mostrará un contenido se hará una consulta
                 */
                if (isset($_POST['submit'])) {
                    /** @var Date $fecha es igual al valor de la fecha del formulario*/
                    $fecha = $_POST['fecha'];
                    /**
                     * @var $registro es igual a un msqli_query y le pasamos dos parametro
                     * 1 - es la @var $conexion 
                     * 2 - Hacemos una consulta a la tabla pedido y trae los campos numero_mesa, id_pedido,total,id_estado donde el estado
                     * del pedido sea igual a 'E02' y la fecha sea igual a @var $fecha.
                    */
                    $registro = mysqli_query($conexion, "SELECT numero_mesa,id_pedido,total,id_estado,fecha_hora FROM tbl_pedido WHERE id_estado = 'E02' AND CAST(fecha_hora AS DATE)='$fecha'") or die('error con el dato');
                    /**
                     * Abrimos un ciclo while para que me recorra la tabla y me traiga los datos de la tabla pedido que esta
                     * guardada en la @var $registro.
                    */
                    while ($row = mysqli_fetch_array($registro)) {
                ?>
                        <div class="div-tablas">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3">
                                            <center>Mesa <?php echo $row['numero_mesa']; ?> <br> <?php echo $fecha;?></center>
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
                                        <?php 
                                        /**
                                        * @var $idPedido almacena el id del pedido.
                                        */
                                        $idPedido = $row['id_pedido'];
                                        /**
                                         * @var $sql es igual a un msqli_query y le pasamos dos parametro
                                         * 1 - es la @var $conexion 
                                         * 2 - Hacemos una consulta a la tabla pedido_producto y trae los campos id_producto,cantidad donde el id_pedido
                                         * del pedido sea igual a @var $idPedido.
                                        */
                                        $sql = mysqli_query($conexion, "SELECT id_producto,cantidad FROM tbl_pedido_producto WHERE id_pedido = $idPedido");
                                        /**
                                        * Abrimos un ciclo while para que me recorra la tabla y traiga los datos de la tabla pedido_producto que esta
                                        * guardada en la @var $producto.
                                        */
                                        while ($producto = mysqli_fetch_array($sql)) {
                                        ?>
                                            <?php
                                            /**
                                            * @var $idP almacena el id del producto.
                                            */
                                            $idP = $producto['id_producto'];
                                            /**
                                             * @var $selectP es igual a un msqli_query y le pasamos dos parametro
                                             * 1 - es la @var $conexion 
                                             * 2 - Hacemos una consulta a la tabla producto y trae los campos nombre_producto,precio_producto donde el id
                                             * del producto sea igual a @var $idP.
                                            */
                                            $selectP = mysqli_query($conexion, ("SELECT nombre_producto,precio_producto FROM tbl_producto WHERE id_producto = $idP"));
                                            /**
                                             * Abrimos un ciclo while para que me recorra la tabla y traiga los datos de la tabla producto que esta
                                             * guardada en la @var $selectP.
                                            */
                                            while ($rowPro = mysqli_fetch_array($selectP)) {
                                            ?>

                                                <td class="nombre"> <?php echo $rowPro['nombre_producto'] ?></td>
                                                <td><?php echo $producto['cantidad'] ?></td>
                                                <td><?php echo "$" . $rowPro['precio_producto'] ?></td>
                                    </tr>
                                <?php
                                    /** cerramos el ciclo de la consulta a la tabla producto. */
                                }
                                ?>
                            <?php
                            /**Cerramos el ciclo de la consulta a la tabla pedido_producto. */
                                }
                            ?>         
                            <tr>
                                <td colspan="1"><b>Total:</b></td>
                                <td colspan="2" style="padding:0 0 0 220px;"><?php echo "$" . $row['total'] ?></td>
                            </tr>

                            </tr>
                                </tbody>
                            </table>
                        </div>

                <?php
                    /**Cerramos el ciclo de la consulta a la tabla pedido. */
                    }
                /**Se ciera el condicional if del botón submit */
                }
                ?>
            </div>
        </div>
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
        <script type="text/javascript" src="../js/perfiladministrador.js"></script>
    </body>
    </html>
<?php } 
/**
 * Si no está la sesión del administrador lo que se hace es que lleva al index. 
 */
else {
    header('location: ../index.php');
} ?>