<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Se inicia la sesión
 */
session_start();

/**
 * Si la sesión del administrador está iniciada permite visualizar la siguiente vista
 */
if (isset($_SESSION['administrador'])) {
?>
    <!DOCTYPE html>
    <html lang="es" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title>Bardis || Administrador-Total venta</title>
        <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
        <link rel="stylesheet" href="../css/total_venta.css">

    </head>

    <body>
        <div id="container">
            <div id="perfiladmin">
                <!--Se coloca el logo del sistema-->
                <img src="../logo/IconoLu17.png" id="img-1">
                <div class="perfil-admin">
                    <!--Se crea una sección que contiene la imagen de un usuario en general, el nombre y el 
                        apellido del usuario que está en la sesión
                    -->
                    <section id="section-perfil">
                        <img src="../image/usuario.png" alt="" id="img-perfil"><br>
                        <?php
                        /**
                         * Traer el nombre del administrador
                         * 
                         * Se crea la variable cedula, para que almacene la sesion del administrador la cuál 
                         * tiene el número de documento de tipo cadena de caracteres
                         * 
                         * @var string $cedula    Cédula del administrador
                         */
                        $cedula = $_SESSION['administrador'];

                        /**
                         * Consulta a la base de datos tabla administrador
                         * 
                         * Se realiza la consulta '$query' para traer el nombre y el apellido correspondiente al 
                         * administrador que se encuentra en la sesión, en este caso necesitamos el nombre y el apellido, 
                         * para lo cual creamos dos variables, el nombre y el apellido las cuales son de tipo cadena 
                         * de caracteres
                         * 
                         * @var string $nombre      Nombre del administrador
                         * @var string $apellido    Apellido del administrador
                         */
                        $query = mysqli_query($conexion, "SELECT nombre1_administrador, apellido1_administrador FROM `tbl_administrador` where `cedula_administrador` = '$cedula'");

                        /**
                         * En $row se almacena el resultado de la consulta $query
                         */
                        $row = mysqli_fetch_array($query);

                        /**
                         * Se le asigna el resultado de la consulta a la variable $nombre y $apellido
                         */
                        $nombre = $row['nombre1_administrador'];
                        $apellido = $row['apellido1_administrador'];
                        ?>

                        <!--Luego en el echo se muestran las variables que almacena la información del nombre y
                            apellido del administrador 
                        -->
                        <h3><?php echo $nombre . " " . $apellido;  ?>

                            <!--Se coloca el icono de una flecha hacia abajo para ver la otra sección con 
                                otras opciones y se coloca el onclick correspondiente, el cuál ejecuta la función
                                de mostrar esa sección.
                            -->
                            <img src="../icons/flecha-hacia-abajo.png" id="icon-1" onclick="submenu()">

                            <!--Se coloca el icono de una flecha hacia arriba para esconder la sección con
                            opciones y se coloca el onclick correspondiente, el cuál ejecuta la función
                            de esconder esa sección.
                            -->
                            <img src="../icons/flecha-hacia-arriba.png" id="icon-2" onclick="quitarsubmenu()">
                    </section>

                    <!--Se crea la sección que se le muestra al usuario, la cuál tiene diferentes opciones -->
                    <section id="section-opc">
                        <ul>
                            <li><a href="perfiladministrador.php">Inicio</a></li>
                            <li><a href="empleados.php">Empleados</a></li>
                            <li><a href="modificardatos.php" target="_blank">Modificar perfil</a><br></li>
                            <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
                        </ul>
                    </section>
                </div>
            </div>

            <!--Se pone un enlace para volver a la pestaña del perfil, y una imagen con una
                flecha así: <--- 
            -->
            <a href="perfiladministrador.php"><img src="../icons/espalda.png" id="arrow-left" /></a>
            <!--Se crea un div que contiene un formulario para poner la fecha -->
            <div id="fecha">
                <!--Se crea el formulario, con su action en esta misma página -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <!--Se imprime el formato de fecha de año-mes-dia-->
                    <center><input type="date" name="fecha" id="fecha" value="<?php echo date("Y-m-d"); ?>">
                        <!--Se coloca el input submit para que se envie el formulario-->
                        <input type="submit" name="submit" value="Buscar">
                    </center>
                </form>
            </div>
            <?php
            /**
             * Si se envía el formulario hará lo siguiente
             */
            if (isset($_POST['submit'])) {

                /**
                 * Se crea una variable para que almacene la fecha que envío el usuario por medio del
                 * formulario de este mismo archivo, la cual es de tipo fecha
                 * 
                 * @var date $fecha            Fecha que envía el usuario 
                 */
                $fecha = $_POST['fecha'];

                /**
                 * Se inicializa la variable total en cero(0)
                 * 
                 * @var float $total        Total vendido por fecha
                 */
                $total = 0;

                /**
                 * Consulta a la base de datos tabla copia pedido
                 * 
                 * Se ejecuta la consulta '$sql' a la tabla copia pedido para traer toda la información donde 
                 * la fecha que hay en la base de datos sea igual a la que solicitó el usuario

                 */
                $sql = mysqli_query($conexion, "SELECT * FROM tbl_copia_pedido WHERE fecha1='$fecha'");

                /**
                 * Mientras hayan resultados de esa consulta, se va a sumar el total de todos los pedidos
                 * correspondientes a la fecha encontrada en la consulta $sql y almacenados en $row
                 */
                while ($row = mysqli_fetch_array($sql)) {

                    /**
                     * 
                     * Se realiza la suma donde el total es igual a total más el total encontrado en
                     * cada pedido de la consulta donde la fecha coincide
                     */
                    $total = $total + $row['total1'];
                }
            ?>
                <!--Se crea un div que contiene la tabla del total venta-->
                <div class="total">
                    <!--Se crea la tabla -->
                    <table class="table_total">
                        <!--Cabecera de la tabla -->
                        <thead>
                            <!--Fila de la tabla -->
                            <tr>
                                <!--Celdas de la tabla -->
                                <th colspan="3">
                                    <!--Se imprime la fecha solicitada por el usuario-->
                                    <center>Total venta del día:<?php echo " " . $fecha ?></center>
                                </th>
                            </tr>
                        </thead>
                        <!--Cuerpo de la tabla -->
                        <tbody>
                             <!--Fila de la tabla -->
                            <tr>
                                <!--Celdas de la tabla -->
                                <th>
                                    <!--Se imprime el total de venta en la fecha solicitada-->
                                    <center>Total: <?php echo " " . $total; ?></center>
                                </th>
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
    /**
     * Si no está la sesión del administrador lo que hace es que lleva al index
     */
    header('location: ../index.php');
} ?>