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
        <title>Bardis || Administrador-Pedidos</title>
        <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
        <link rel="stylesheet" href="../css/pedidos_atendidos.css">
    </head>

    <body>
        <div id="container">
            <div id="perfiladmin">
                <!--Se coloca el logo del sistema-->
                <img src="../logo/IconoLu17.png" id="img-1">
                <div class="perfil-admin">
                    <!--Se crea una sección que contiene la imagen de un usuario en general y el nombre del
                        usuario que está en la sesión
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

            <!--Se pone un enlace para volver a la pestaña del perfil -->
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

            <!--Se crea un div que contiene todo los pedidos -->
            <div id="div-pedidos" onclick="quitarsubmenu()">
                <?php
                /**
                 * Si se envía el formulario que está en esta misma página hará lo siguiente
                 */
                if (isset($_POST['submit'])) {

                    /**
                     * Se recibe la fecha en la variable $fecha la cual viene por medio de 'fecha'
                     * 
                     * @var date $fecha            Fecha que envía el usuario de tipo fecha
                     */
                    $fecha = $_POST['fecha'];

                    /**
                     * Consulta a la base de datos tabla copia pedido
                     * 
                     * Se ejecuta la consulta '$registro' a la tabla copia pedido para que me muestre toda
                     * la informacción de los pedidos donde el estado del pedido sea atendido y donde la 
                     * fecha que envió el usuario coincida con la que hay en la base de datos 
                     */
                    $registro = mysqli_query($conexion, "SELECT * FROM tbl_copia_pedido WHERE id_estado1 = 'E02' AND fecha1='$fecha'") or die('error con el dato');

                    /**
                     * Mientras hayan resultados de esa consulta, se muestra toda la información de los 
                     * pedidos encontrados en la consulta $registro y almacenados en $row
                     */
                    while ($row = mysqli_fetch_array($registro)) {
                ?>
                        <!--Se crea un div que contiene los pedidos en tablas-->
                        <div class="div-tablas">
                            <!--Se crea la tabla -->
                            <table class="table">
                                <!--Cabecera de la tabla -->
                                <thead>
                                    <!--Fila de la tabla -->
                                    <tr>
                                        <!--Celdas de la tabla -->
                                        <th colspan="3">
                                            <!--Se imprime el numero de mesa,realizando
                                                el llamado a $row que es quién almacena 
                                                la información de la consulta $registro
                                            -->
                                            <center>Mesa <?php echo $row['numero_mesa1']; ?> <br> 
                                            <!--Se imprimer la fecha que envió el usuario -->
                                            <?php echo $fecha; ?></center>
                                        </th>
                                    </tr>
                                </thead>
                                <!--Cuerpo de la tabla -->
                                <tbody>
                                    <!--Fila de la tabla -->
                                    <tr>
                                        <!--Celdas de la tabla -->
                                        <th colspan="">Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                    <!--Fila de la tabla -->
                                    <tr>
                                        <?php
                                        /**
                                         * Se captura y se almacena en una variable el Id de cada pedido, 
                                         * el cual es de tipo entero
                                         * 
                                         * @var integer $idPedido       Id del pedido
                                         */
                                        $idPedido = $row['id_pedido1'];

                                        /**
                                         * Consulta a la base de datos tabla tabla copia pedido producto
                                         * 
                                         * Se ejecuta la consulta '$sql' a la tabla copia pedido producto para 
                                         * que me muestre el id de un producto y la cantidad que solicitaron de 
                                         * ese producto en un pedido
                                         */
                                        $sql = mysqli_query($conexion, "SELECT id_producto1,cantidad1 FROM tbl_copia_pedido_producto WHERE id_pedido1=$idPedido");

                                         /**
                                         * Mientras hayan resultados de esa consulta, se muestra la información 
                                         * solicitada encontrada en la consulta $sql y almacenados en $producto
                                         */
                                        while ($producto = mysqli_fetch_array($sql)) {
                                        ?>
                                            <?php
                                            /**
                                            * Se almacena en una variable el Id de cada producto el 
                                            * cual es de tipo entero, entonces se le asigna a la variable $idP 
                                            * el resultado de la consulta $sql almacendado en $producto
                                            * 
                                            * @var integer $idP     Id del producto
                                            */
                                            $idP = $producto['id_producto1'];

                                            /**
                                             * Consulta a la base de datos tabla copia producto 
                                             * 
                                             * Se ejecuta la consulta '$selectP' a la tabla copia producto para que 
                                             * muestre el nombre y el precio de un producto determinado
                                             */
                                            $selectP = mysqli_query($conexion, ("SELECT nombre_producto1,precio_producto1 FROM tbl_copia_producto WHERE id_productoo=$idP"));

                                            /**
                                             * Mientras hayan resultados de esa consulta, se muestra la 
                                             * información solicitada encontrada en la consulta $selectP y 
                                             * almacenados en $rowPro
                                             */
                                            while ($rowPro = mysqli_fetch_array($selectP)) {
                                            ?>

                                        <!-- Se imprime el nombre del producto
                                            realizando el llamado a $rowPro que es quién almacena
                                            la información de la consulta $selectP
                                        -->
                                        <td class="nombre"> <?php echo $rowPro['nombre_producto1'] ?></td>

                                        <!--Se imprime la cantidad del producto realizando el 
                                            llamado a $producto que es quién almacena la información 
                                            de la consulta $sql  
                                        -->
                                        <td><?php echo $producto['cantidad1'] ?></td>

                                        <!-- Se imprime el precio del producto
                                            realizando el llamado a $rowPro que es quién almacena
                                            la información de la consulta $selectP
                                        -->
                                        <td><?php echo "$" . $rowPro['precio_producto1'] ?></td>
                                    </tr>
                                <?php
                                /**
                                * Se cierra el ciclo de la consulta de la tabla copia producto
                                */
                                            }
                                ?>
                            <?php
                            /**
                             * Se cierra el ciclo de la consulta de la tabla copia pedido producto
                             */
                                        }
                            ?>
                            <!--Fila de la tabla -->
                            <tr>
                                <!--Celdas de la tabla -->
                                <td colspan="1"><b>Total:</b></td>
                                <!-- Se muestra el total de ese pedido, realizando el llamado a 
                                    '$row' que es quién almacena la información de la consulta $registro
                                -->
                                <td colspan="2" style="padding:0 0 0 220px;"><?php echo "$" . $row['total1'] ?></td>
                            </tr>
                            </tr>
                                </tbody>
                            </table>
                        </div>
                <?php
                /**
                 * Se cierra el ciclo de la consulta de la tabla copia pedido
                 */
                    }    
                }
                ?>
            </div>
        </div>
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
        <script type="text/javascript" src="../js/perfiladministrador.js"></script>
    </body>

    </html>

<?php } else {
  /**
  * Si no está la sesion del administrador lo que hace es que lleva al index
  */
    header('location: ../index.php');
} ?>