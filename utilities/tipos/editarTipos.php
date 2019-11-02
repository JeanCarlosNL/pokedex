<?php 
require_once '../../functions/methods.php';
require_once '../../helpers/layout.php';
require_once 'tipos.php';
require_once '../service/serviceBase.php';
require_once 'serviceTipo.php';



$layout = new layout(true,false,"regiones","tipo");
$methods = new methods;
$servicioTipo = new ServiceTipo();


/* Seccion Editar */

if(isset($_GET['ID'])){

  $tipoID = $_GET['ID'];
  $elemento = $servicioTipo->GetById($tipoID);

}

if(isset($_POST['Nombre']) && isset($_POST['Caracteristicas'])){


  $actualizarTipo = new Tipos();
  $actualizarTipo->iniciarClase($tipoID,$_POST['Nombre'],$_POST["Caracteristicas"]);
  $servicioTipo->Actualizar($tipoID,$actualizarTipo);
    
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

  <title>Edicon de los Tipos</title>

  <!-- Bootstrap core CSS -->
  <link href="../../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../styles/css/scrolling-nav.css" rel="stylesheet">
  
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="page-top">

<?php $layout->mostrarHeader()?>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Edicion de Tipos de Pokemon</h1>
      <p class="lead">Mira todos los tipos de Pokemon disponibles en nuestra Pokedex</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Edicion del Tipo de Pokemon</h2>
          <p class="lead">Actualiza la informacion del Tipo de Pokemon seleccionado:</p>
          <form method="POST" action ="editarTipos.php?ID=<?php echo $elemento->ID;?>">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="Nombre" class="lead">Nombre</label>
                  <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Indroduza el Tipo de pokemon" value="<?php echo $elemento->nombre; ?>" required>
                </div>
                 <div class="form-group col-md-12">
                      <label for="Caracteristicas">Caracteristicas</label>
                      <textarea name="Caracteristicas" id="Caracteristicas" class="form-control" placeholder="Escriba las caracteristicas de este tipo de pokemon" required><?php echo $elemento->caracteristicas;?></textarea>
                      <small>Coloca las caracteristicas separadas por coma (,)</small>
                 </div>
               </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
          </form>
        </div>
      </div>
    </div>
  </section>

 <?php $layout->mostrarFooter(); ?>
 
	</body>
</html>