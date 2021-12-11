<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIGMED</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
html, body {
  height: 100%;
  margin: 0;
}

</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<header>
		<?php require_once('view/Layouts/menu.php'); ?>
	</header>

<div style="display: table; width:100%;  height:15%;" >
            <div  style="display: table-cell; background: #fff; width:100%; height:100%; color: #ffffff; text-align:center; vertical-align:middle">

  <div class="row" style="color:#000000">
    <div class="col">
      <h1>Mis Citas</h1>
    </div>
    <div class="col">
      <h1>xxxxxxxx</h1> 
    </div>
  </div>
</div>
</div>
<div style="padding:2%">
    <table class="table table-hover" >
    <thead>
        <tr>
        <th >id</th>
        <th >Fecha</th>
        <th >medico</th>
        <th >hora</th>
        <th ></th>
        <th ></th>
        </tr>
    </thead>
    <tbody>
      <form action="/editar" method="post">
      <?php 
      foreach($citas as $cita){
        $medico = $con->obtenerNombreMedico($cita["id_medico"]);
        $hora = $con->obtenerNombreHora($cita["id_horario"]);
        echo('
        <tr>
        <td> <input type="text"  name="id" id="df"  readonly value="'.$cita['id'].'"></td>
        <th>'.$cita["fecha"].'</th>
        <th>'.$medico.'</th>
        <td>'.$hora.'</td>
    
        <td><button type="button" class="btn btn-primary btn-sm">Reprogramar</button></td>
        <td><button type="button" class="btn btn-danger btn-sm">Eliminar</button></td>
        </tr>
      
      ');
      
      }
      ?>
       </form>
        
    </tbody>
    </table>
</div>

</body>


