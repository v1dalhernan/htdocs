<?php 

require('model/Conexion.php');
//se crea un objeto con toda la logica del modelo
$con = new Conexion();

$policlinica = $_POST['policlinica'];
$especialidad = $_POST['especialidad'];
$medico = $_POST['medico'];
$fecha = $_POST['fecha'];
$horario = $_POST['hora'];

$id_usuario = $_COOKIE['idUser'];
$id_paciente = $con->obtenerIdPaciente($id_usuario);


$valido = $con->guardarCita($fecha,$medico,$id_paciente,$horario);

if($valido){
    echo("la cita se ha guardado exitosamente");
    $subject = "cita medica exitosa";
    $message = "su cita se ha guardado exitosamente, para verificarla por favor apersonece a la sección de mis citas en nuestras pagina web";
    $to = $con->obtenerEmailPaciente($id_usuario);
    mail(
         $to,$subject, $message,
    );
}else{
    echo("ha ocurrido un error");
}


require('view/guardar_cita_v.php');
?>