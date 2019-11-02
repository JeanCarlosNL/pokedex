<?php
include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'tipos.php';
require_once '../service/serviceBase.php';
require_once 'serviceTipo.php';


$layout = new layout(true,false,"regiones","tipo");
$methods = new methods();
$servicioTipo = new ServiceTipo();

if(isset($_POST['Nombre']) && isset($_POST['Caracteristicas'])){

   $nuevoTipo = new Tipos();
   $nuevoTipo->iniciarClase(0,$_POST['Nombre'], $_POST['Caracteristicas']);
   $servicioTipo->Guardar($nuevoTipo);
	
   header("Location:listaTipos.php");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registro de Tipos de Pokemon</title>

  <!-- Bootstrap core CSS -->
  <link href="../../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../styles/css/scrolling-nav.css" rel="stylesheet">
S
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php $layout->mostrarHeader();?>

<header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido al Registro de Tipos de Pokemon</h1>
      <p class="lead">Mira todos los tipos de Pokemon disponibles en nuestra Pokedex</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Registro de Tipos de Pokemon</h2>
          <p class="lead">Realiza el registro de Tipos de Pokemon colocando los siguientes datos:</p>

          <form method="POST" action ="guardar.php">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="Nombre" class="lead">Nombre</label>
                  <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Indroduza el Tipo de pokemon" required>
                </div>
                 <div class="form-group col-md-12">
                      <label for="Caracteristicas">Caracteristicas</label>
                      <textarea name="Caracteristicas" id="Caracteristicas" class="form-control" placeholder="Escriba las caracteristicas de este tipo de pokemon" required></textarea>
                      <small>Coloca las caracteristicas separadas por coma (,)</small>
                 
                 </div>
               </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php $layout->mostrarFooter();?>
    
</body>
</html>