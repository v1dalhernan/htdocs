

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

    
<div class="row" style=" height:100%">
    <div class="col-md-3 ml-sm-12 col-lg-3 col-xl-2 px-0" style="height:100%; background: #B9FFFF; ">
        <div style="display: table; width:100%;  height:8%;" >
            <div  style="display: table-cell; background: #033FAC; width:100%; height:100%; color: #ffffff; text-align:center; vertical-align:middle">
                <h2 >Agendar Cita</h2>
            </div>
        </div>
        <main role="main" class="col-md-12 ml-sm-12 col-lg-12 px-3">
        <form action="" method="post">
            <div class="mb-3" style="padding: 5% 0%">
                <label for="SeleccionePoliclinica" class="form-label">Seleccione una Policlínica</label>
                <!--<select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required></select>-->
                <select id="SeleccionePoliclinica" class="form-select" name="nombrePoliclinica" required>  
                <option>Disabled select</option>
                </select>
            </div>                 
            <div class="mb-3" style="padding: 5% 0%">
                <label for="SeleccioneEspecialidad" class="form-label">Seleccione una Especialidad</label>
                <select id="SeleccioneEspecialidad" class="form-select" name="nombreEspecialidad" required>
                    <option>Disabled select</option>
                    
                </select>
            </div>
            <div class="mb-3" style="padding: 5% 0%">
                <label for="SeleccioneMedico" class="form-label">Seleccione un Médico</label>
                <select id="SeleccioneMedico" class="form-select" name="nombreMedico" require>
                    <option>Disabled select</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </main>
    </div>
    <div class="col-md-9 ml-sm-12 col-lg-9 col-xl-10 px-0">
        <?php require_once('./calendario/index.html'); ?>
    </div>
</div>

</body>
</html>