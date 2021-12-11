<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="crear_cita_4.php" method="post">
<h1>Especialista</h1>

    <label for="cars">elige 1:</label>

<select name="policlinica" id="policlinica">
<?php 
foreach ($id as $i){
    echo ('<option value="'.$i['id'].'">'.$i['nombre'].'</option>');
}

?>
</select>

<label for="cars">elige 1:</label>

<select name="especialidad" id="especialidad">
<?php 
foreach ($especialidades as $especialidad){
    echo ('<option value="'.$especialidad['id'].'">'.$especialidad['nombre'].'</option>');
}

?>
</select>


</select>

<label for="cars">elige 1:</label>

<select name="medico" id="medico">
<?php 
foreach ($medicos as $medico){
    echo ('<option value="'.$medico['id'].'">'.$medico['nombre'].'</option>');
}

?>
</select>

<input type="submit" value="siguiente">

</form>

</body>
</html>