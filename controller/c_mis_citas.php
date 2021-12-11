<?php 

require('model/Conexion.php');


$con = new Conexion();

$id_usuario = $_COOKIE['idUser'];
$id_paciente = $con->obtenerIdPaciente($id_usuario);

$citas = $con->obtenerCitas($id_paciente);



require('view/Paciente/MisCitas.php');//se muestra que el guardado fue exitoso
?>