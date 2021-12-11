<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="crear_cita_2.php" method="post">
<h1>elige una policlinica</h1>

    <label for="cars">elige 1:</label>

<select name="policlinica" id="policlinica">
<?php 
foreach ($respuestas as $resp){
    echo ('<option value="'.$resp['id'].'">'.$resp['nombre'].'</option>');
}

?>
</select>

<input type="submit" value="siguiente">

</form>

</body>
</html>


