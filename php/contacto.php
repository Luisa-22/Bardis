<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fonts/Alata-Regular.ttf.css">
    <title>Document</title>
</head>
<style>
    @font-face {
    font-family: 'Alata';
    src: url('../fonts/Alata-Regular.ttf');
}

*{
    font-family: 'Alata';
}
</style>
<body>
<?php
    include "conexion.php";
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];
    $sql = mysqli_query($conexion,"INSERT INTO tbl_contacto(nombres,apellidos,correo,mensaje) 
    VALUES ('$nombres','$apellidos','$correo','$mensaje')");
    if($sql){
        echo "<b>Registrado correctamente</b>";
    }else{
        echo "Error al registrar";
    }
?>
</body>
</html>