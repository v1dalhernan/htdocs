<?php 

require('model/Conexion.php');
//se crea un objeto con toda la logica del modelo
$con = new Conexion();

$policlinica = $_POST['policlinica'];

$id = $con->RecuperarPoliclinicaFase2($policlinica);
var_dump($id);
$gruposid = $con->encotrarEspecialdades($id);

$especialidades = $con->obtenerNombreEspecialidad($gruposid);
/* proceso de extracción a la base de datos  */

//$respuesta = $con->crearCuenta($cedula,$nombre,$apellido,$correo,$contrasenna);

require('view/crear_cita_2_v.php');//se muestra que el guardado fue exitoso
?>