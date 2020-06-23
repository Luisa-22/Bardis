<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/plantilla.css">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'Alata';
            src: url('../fonts/Alata-Regular.ttf');
        }

        * {
            margin: 0;
            padding: 0;
            font-family: 'Alata', sans-serif;
        }
    </style>
</head>

<body>
    <?php
    function plan($nombreEventoPromocion, $descripcion, $fechaFormato)
    {
        $plantilla2 = "<div id='container' style='background:#0095FF;width:50%;padding:20px;'>
            <h3 style='color:#Fff;'>$nombreEventoPromocion</h3><h3 style='color:#Fff;'>$descripcion</h3><h3>$fechaFormato</h3></div>";
        return $plantilla2;
    }
    ?>
</body>

</html>