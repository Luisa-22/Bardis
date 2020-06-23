<?php

/**
 * Se inicia la sesión
 */
session_start();

/**
 * 
 * Se define la variable arreglo que es igual a la sesion del carrito
 */
$arreglo = $_SESSION['carrito'];

/**
 * Se definen dos variables que son inicializadas en cero(0)
 * 
 * @var float $total        Total del pedido, tipo decimal
 * @var integer $posicion   Posición de un producto, tipo entero
 */
$total=0;
$posicion=0; 

/**
 * Ciclo for, donde i comienza en 0 hasta que i sea menor al numero de posiciones del arreglo
 */
for ($i = 0; $i < count($arreglo); $i++) {
    
    /**
     * Si el id del producto que está en el arreglo en la posición $i es igual al id que se trae por el 
     * metodo post de la petición ajax del archivo actualizarcarrito.js de la carpeta js
     */
    if ($arreglo[$i]['Id'] == $_POST['Id']) {

      /**
       * Se almacena la posición de ese id en una variable
       * 
       * @var integer $posicion   Posición del id de un producto, tipo entero
       */
      $posicion = $i;
    }
  }

  /**
   * El arreglo en la posición que se capturó la cantidad va a ser igual a lo que haya mandado
   * por el método post cantidad del archivo actualizarcarrito.js de la carpeta js, es decir es 
   * igual a la nueva cantidad del producto
   */
  $arreglo[$posicion]['Cantidad']=$_POST['Cantidad'];

  /**
  * Ciclo for, donde i comienza en 0 hasta que i sea menor al numero de posiciones del arreglo
  */
  for ($i = 0; $i < count($arreglo); $i++) {

    /**
    * Calcular nuevo total
    * 
    * Se vuelve a recorrer el arreglo para decir que el total es igual al precio que está en el
    * arreglo en la posición $i multiplicado por la cantidad del arreglo en la posición $i más el
    * total
    */
    $total=($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad'])+$total;
  }

  /**
   * Se guarda en la variable sesion el arreglo ya modificado
   */
  $_SESSION['carrito']=$arreglo;

  /**
   * Se imprime el nuevo total
   */
  echo $total;

?>