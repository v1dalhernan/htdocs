<?php 

require('model/Conexion.php');


$con = new Conexion();

$policlinica = $_POST['policlinica'];
$especialidad = $_POST['especialidad'];



$id = $con->RecuperarPoliclinicaFase2($policlinica);

$especialidades = $con->recuperarEspecialidadesFase2($especialidad);

$medicos = $con->obtenerMedico($especialidad,$policlinica);

require('view/crear_cita_3_v.php');//se muestra que el guardado fue exitoso
?>