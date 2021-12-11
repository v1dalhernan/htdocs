<?php 

require('model/Conexion.php');


$con = new Conexion();

$policlinica = $_POST['policlinica'];
$especialidad = $_POST['especialidad'];
$medico = $_POST['medico'];



$id = $con->RecuperarPoliclinicaFase2($policlinica);

$especialidades = $con->recuperarEspecialidadesFase2($especialidad);

$medicos = $con->obtenerMedicoFase2($medico);

$horarios = $con->obtenerHorarios();

require('view/crear_cita_4_v.php');//se muestra que el guardado fue exitoso
?>