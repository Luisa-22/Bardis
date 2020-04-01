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
        <link rel="stylesheet" href="../css/total_venta.css">
        
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
            <a href="perfiladministrador.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
            <div id="fecha">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <center><input type="date" name="fecha" id="fecha" value="<?php echo date("Y-m-d"); ?>">
                    <input type="submit" name="submit" value="Buscar">
                    </center>
                </form>
            </div>

                <?php

                if (isset($_POST['submit'])) {
                    $fecha = $_POST['fecha'];
                    $total = 0;
                    $sql = mysqli_query($conexion, "SELECT * FROM tbl_pedido WHERE CAST(fecha_hora AS DATE)='$fecha'");
                    while($row = mysqli_fetch_array($sql)){

                        $total = $total+$row['total'];
                    }

                ?>    
                    <div class="total">
                        <table class="table_total">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <center>Total venta del día:<?php echo " ".$fecha?></center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><center>Total: <?php echo " ".$total;?></center></th>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>
                <?php
                }
                ?>

        </div>
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
        <script type="text/javascript" src="../js/perfiladministrador.js"></script>
    </body>

    </html>

<?php } else {
    header('location: ../index.php');
} ?>