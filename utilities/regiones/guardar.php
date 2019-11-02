<?php
include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'regiones.php';
require_once '../service/serviceBase.php';
require_once 'serviceRegion.php';


$layout = new layout(true,false,"regiones","region");
$methods = new methods();
$servicioRegion = new ServiceRegion();

if(isset($_POST['Nombre']) && isset($_POST['Color']) && isset($_POST['Capital']) && isset($_POST['LigaPokemon'])){

   $nuevaRegion = new Region();
   $nuevaRegion->iniciarClase(0,$_POST['Nombre'], $_POST['Color'],$_POST['Capital'],$_POST['LigaPokemon']);
   $servicioRegion->Guardar($nuevaRegion);
	
   header("Location:listaRegiones.php");
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

  <title>Registro de Regiones</title>

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
      <h1>Bienvenido al registro de Regiones</h1>
      <p class="lead">Mira todos las Regiones disponibles en nuestra Pokedex</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Registro de Regiones</h2>
          <p class="lead">Realiza el registro de la Region colocando los siguientes datos:</p>

          <form method="POST" action ="guardar.php">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nombre" class="lead">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="Nombre" placeholder="Indroduza el nombre" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="Capital" class="lead">Capital</label>
                  <input type="text" class="form-control" id="Capital" name="Capital" placeholder="Introduzca la capital de la region" required>
                </div>
                  <div class="form-group col-md-6">
                    <label for="LigaPokemon" class="lead">Liga Pokemon</label>
                    <input type="text" class="form-control" id="LigaPokemon" name="LigaPokemon" placeholder="Indroduza la liga que se disputa" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="Color" class="lead">Color</label><small>  (Selecione el color identificativo para la Region)</small>
                    <input type="color" class="form-control" id="Color" name="Color" placeholder="Introduzca el color identificativo" required>
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