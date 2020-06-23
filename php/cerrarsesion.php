<?php
/**
 * Se inicia la sesión
 */
session_start();
/**
 * Se limpia la sesión
 */
session_unset();
/**
 * Se destruye la sesión
 */
session_destroy();
/**
 * Se direcciona al index
 */
header('location: ../index.php')
?>