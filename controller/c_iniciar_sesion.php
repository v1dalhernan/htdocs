<?php

require('model/Conexion.php');
//se crea un objeto con toda la logica del modelo
$con = new Conexion();

$correo = $_POST['correo'];
$contrasenna = $_POST['contrasenna'];

$respuesta = $con->existeUsuario($correo,$contrasenna);


if($respuesta){
    $id = $con->obtenerId($correo,$contrasenna);
    setcookie("idUser",$id);
    require('view/Paciente/inicio.php');
}else{
    require('view/guardado_exitoso_v.php');
}


