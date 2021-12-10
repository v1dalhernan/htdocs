<?php 

require('model/Conexion.php');
//se crea un objeto con toda la logica del modelo
$con = new Conexion();




/* proceso de extracción a la base de datos  */

//$respuesta = $con->crearCuenta($cedula,$nombre,$apellido,$correo,$contrasenna);
$respuestas = $con->RecuperarPoliclinicas();

require('view/crear_cita_1_v.php');//se muestra que el guardado fue exitoso
?>