<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Si se envia el formulario que se encuentra en el archivo empleados.php hará lo sgte.
 */
if(isset($_POST['submit'])){

/**
 * Se crea la variable $cedula que almacena el campo que tiene como nombre 'cedula',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $cedula                  Cédula del empleado, tipo cadena de caracteres
 */
 $cedula = $_POST['cedula'];

/**
 * Se crea la variable $nombreEmpleado1 que almacena el campo que tiene como nombre 'nombreEmpleado1',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $nombreEmpleado1         Primer nombre del empleado, tipo cadena de caracteres
 */
 $nombreEmpleado1 = $_POST['nombreEmpleado1'];

/**
 * Se crea la variable $nombreEmpleado2 que almacena el campo que tiene como nombre 'nombreEmpleado2',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $nombreEmpleado2         Segundo nombre del empleado, tipo cadena de caracteres
 */
 $nombreEmpleado2 = $_POST['nombreEmpleado2'];

/**
 * Se crea la variable $apellidoEmpleado1 que almacena el campo que tiene como nombre 'apellidoEmpleado1',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $apellidoEmpleado1       Primer apellido del empleado, tipo cadena de caracteres
 */
 $apellidoEmpleado1 = $_POST['apellidoEmpleado1'];

/**
 * Se crea la variable $apellidoEmpleado2 que almacena el campo que tiene como nombre 'apellidoEmpleado2',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $apellidoEmpleado2       Segundo apellido del empleado, tipo cadena de caracteres
 */
 $apellidoEmpleado2 = $_POST['apellidoEmpleado2'];
 
/**
 * Se crea la variable $celular1Empleado que almacena el campo que tiene como nombre 'celularEmpleado',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $celular1Empleado        Celular del empleado, tipo cadena de caracteres
 */
 $celular1Empleado = $_POST['celularEmpleado'];

/**
 * Se crea la variable $correoEmpleado que almacena el campo que tiene como nombre 'correoEmpleado',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $correoEmpleado          Correo del empleado, tipo cadena de caracteres
 */
 $correoEmpleado = $_POST['correoEmpleado'];

/**
 * Se crea la variable $password que almacena el campo que tiene como nombre 'password',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $password                Clave del empleado, tipo cadena de caracteres
 */
 $password = $_POST['password'];

/**
 * Se crea la variable $confirmarPassword que almacena el campo que tiene como nombre 'confirmarPassword',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $confirmarPassword       Confirmar clave empleado, tipo cadena de caracteres
 */
 $confirmarPassword = $_POST['confirmarPassword'];

/**
 * Se crea la variable $rol que almacena el campo que tiene como nombre 'rol',
 * el cual se envia del formulario del archivo empleados.php
 * 
 * @var string $rol                     Rol del empleado, tipo cadena de caracteres
 */
 $rol = $_POST['rol'];

/**
 * Si las contraseñas que fueron enviadas del formulario coninciden entonces 
 * permite realizar la inserción del registro en la base de datos
 */
if ($password == $confirmarPassword) {

    /**
    * Inserción tabla empleado
    * 
    * Se ejecuta la inserción del formulario de los empleados en la tabla empleado con sus campos 
    * correspondientes insertando cada variable que se creo para almacenar la
    * información de cada campo del formulario
    */
    $registrarEmpleados = mysqli_query($conexion, "INSERT INTO `tbl_empleado` (`cedula_empleado`,`nombre1_empleado`,
    `nombre2_empleado`,`apellido1_empleado`,`apellido2_empleado`,`celular1_empleado`,`correo_empleado`,`clave_empleado`,id_tipo_empleado) 
    VALUES('$cedula', '$nombreEmpleado1', '$nombreEmpleado2', '$apellidoEmpleado1','$apellidoEmpleado2', '$celular1Empleado','$correoEmpleado' ,
    '$password','$rol')") or die (mysqli_error($conexion));
}
/**
 * Si la variable $registrarEmpleados se realiza correctamente entonces muestra que se 
 * registró correctamente el empleado y deja al usuario en la vista de empleados.php
 */
 if($registrarEmpleados) {
    echo "<script>alert('Empleado registrado correctamente');</script>";
    echo "<script>window.location='../vistas/empleados.php';</script>"; 
} 
/**
 * De lo contrario muestra que no se pudo registrar
 */
else {
    echo "<script>alert('No se pudo registrar');</script>";
}
}
?>
