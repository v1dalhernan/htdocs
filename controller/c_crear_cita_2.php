<?php 

require('model/Conexion.php');


$con = new Conexion();

$policlinica = $_POST['policlinica'];

$id = $con->RecuperarPoliclinicaFase2($policlinica);

$gruposid = $con->encotrarEspecialdades($id);

$especialidades = $con->obtenerNombreEspecialidad($gruposid);


require('view/crear_cita_2_v.php');//se muestra que el guardado fue exitoso
?>