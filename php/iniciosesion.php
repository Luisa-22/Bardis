<?php

/**
 * Se incluye la conexión de la base de datos
 */
include '../php/conexion.php';

/**
 * Si se envia el formulario que se encuentra en el archivo iniciar_sesion.php hará lo sgte.
 */
if(isset($_POST['submit'])){

    /**
     * Se crea la variable $documento que almacena el campo que tiene como nombre 'documento',
     * el cual se envia del archivo iniciar_sesion.php
     * 
     * @var string $documento       Documento del usuario, tipo cadena de caracteres
     */
     $documento=$_POST['documento'];

    /**
     * Se crea la variable $password que almacena el campo que tiene como nombre 'password',
     * el cual se envia del archivo iniciar_sesion.php
     * 
     * @var string $password        Clave del usuario, tipo cadena de caracteres
     */ 
     $password=$_POST['password'];
     
    /**
     * Se crea la variable $rol que almacena el campo que tiene como nombre 'rol',
     * el cual se envia del archivo iniciar_sesion.php
     * 
     * @var string $rol             Rol del usuario, tipo cadena de caracteres
     */
     $rol = $_POST['rol'];
    
    /**
     * 
     * Si la variable $rol es igual a user 
     */
    if($rol == 'user') {

      /**
      * Consulta a la tabla cliente para traer toda la información de ese cliente
      */
      $cliente = mysqli_query ($conexion, "SELECT *  FROM tbl_cliente where documento_cliente = '$documento' and clave_cliente = '$password'");

    /**
	  * Si encuentra un resultado de la consulta $cliente entonces hace lo sgte.
	  */
      if(mysqli_num_rows ($cliente) == 1) {
         
        /**
         * Se inicia la sesión
         */
        session_start();

        /**
         * En $row se almacena el resultado de la consulta $cliente
         */
        $row =mysqli_fetch_array($cliente);

        /**
         * Se le da un nombre a la sesión y se le asigna el documento del cliente, realizando el 
         * llamado a $row que es quién almacena el resultado de la consulta $cliente, y se coloca
         * el archivo que recibe al usuario cliente al iniciar sesión
         */
        $_SESSION['cliente']=$row['documento_cliente'];
        header("Location: ../vistas/perfilusuario.php");
      }
      /**
      * De lo contrario
      */
      else{
        /**
         * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
         */
        echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
        echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";    
      }
    }

    /**
     * 
     * Si la variable $rol es igual a admin
     */
    if($rol== 'admin') {

       /**
        * Consulta a la tabla administrador para traer toda la información de ese administrador
        */
       $administrador = mysqli_query ($conexion, "SELECT * FROM tbl_administrador where cedula_administrador = '$documento' and clave_administrador = '$password'");
        
       /**
	    * Si encuentra un resultado de la consulta $administrador entonces hace lo sgte.
	    */
       if(mysqli_num_rows ($administrador) == 1) {

           /**
           * Se inicia la sesión
           */
           session_start();  

           /**
           * En $row se almacena el resultado de la consulta $administrador
           */
           $row =mysqli_fetch_array($administrador);   

           /**
           * Se le da un nombre a la sesión y se le asigna la cédula del administrador, realizando el 
           * llamado a $row que es quién almacena el resultado de la consulta $administrador, y se coloca
           * el archivo que recibe al usuario administrador al iniciar sesión
           */
           $_SESSION['administrador']=$row['cedula_administrador'];
           header("Location: ../vistas/perfiladministrador.php");
        }
        /**
        * De lo contrario
        */
        else{
          /**
           * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
           */
          echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
          echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
        }
    }

    /**
     * 
     * Si la variable $rol es igual a 001, ese es el identificador del tipo empleado mesero en la base de datos
     */
    if($rol=='001') {

        /**
         * Consulta a la tabla empleado para traer toda la información de ese empleado
         */
        $mesero = mysqli_query ($conexion, "SELECT * FROM tbl_empleado where cedula_empleado = '$documento' and clave_empleado= '$password' and id_tipo_empleado = '001'");
            
        /**
	    * Si encuentra un resultado de la consulta $mesero entonces hace lo sgte.
	    */
        if(mysqli_num_rows ($mesero) == 1) {

          /**
          * Se inicia la sesión
          */
          session_start();  
          /**
          * En $row se almacena el resultado de la consulta $mesero
          */
          $row =mysqli_fetch_array($mesero);  
          /**
          * Se le da un nombre a la sesión y se le asigna la cédula del mesero, realizando el 
          * llamado a $row que es quién almacena el resultado de la consulta $mesero, y se coloca
          * el archivo que recibe al usuario mesero al iniciar sesión
          */
          $_SESSION ['mesero']=$row['cedula_empleado'];
          header("Location: ../vistas/perfilmesero.php");

        }
        /**
        * De lo contrario
        */
        else{
            /**
             * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
             */
            echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
            echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
        }
    }

    /**
     * 
     * Si la variable $rol es igual a 002, ese es el identificador del tipo empleado dj en la base de datos
     */
    if($rol=='002') {

        /**
         * Consulta a la tabla empleado para traer toda la información de ese empleado
         */
        $dj = mysqli_query ($conexion, "SELECT * FROM tbl_empleado where cedula_empleado = '$documento' and clave_empleado = '$password' and id_tipo_empleado = '002'");
    
        /**
	    * Si encuentra un resultado de la consulta $dj entonces hace lo sgte.
	    */
        if(mysqli_num_rows ($dj) == 1) {

          /**
          * Se inicia la sesión
          */
          session_start();  
          /**
          * En $row se almacena el resultado de la consulta $dj
          */
          $row =mysqli_fetch_array($dj);  
          /**
          * Se le da un nombre a la sesión y se le asigna la cédula del dj, realizando el 
          * llamado a $row que es quién almacena el resultado de la consulta $dj, y se coloca
          * el archivo que recibe al usuario dj al iniciar sesión
          */
          $_SESSION ['dj']= $row['cedula_empleado'];
          header("Location: ../vistas/perfildj.php");
        }
        /**
        * De lo contrario
        */
        else{
            /**
             * Si no encuentra resultados, se imprime una alerta y se mantiene en el inicio de sesión
             */
            echo "<script>alert('Los datos son incorrectos, por favor revise e intente nuevamente');</script>";
            echo "<script>window.location='../vistas/iniciar_sesion.php';</script>";
        }
    }
}

?>