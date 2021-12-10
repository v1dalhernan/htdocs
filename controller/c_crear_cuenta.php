<?php 

require('model/Conexion.php');
//se crea un objeto con toda la logica del modelo
$con = new Conexion();

$respuesta = false;
/*obtener las variables */

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$contrasenna = $_POST['contrasenna'];



/* proceso de insercion a la base de datos  */

$respuesta = $con->crearCuenta($cedula,$nombre,$apellido,$correo,$contrasenna);

require('view/guardado_exitoso_v.php');//se muestra que el guardado fue exitoso
?>