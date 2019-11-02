<?php

include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'regiones.php';

require_once '../service/serviceBase.php';
require_once 'serviceRegion.php';


$layout = new layout(true,false,"regiones",false);
$method = new methods();
$servicioRegion = new ServiceRegion();


/* Seccion Mostrar/Filtrar */

$listaRegiones = $servicioRegion->getLista();

/*if(isset($_GET['ID'])==true){

    $index = $_GET['ID'];

    unset($listaEstudiantes[$index]);

    $listaEstudiantes = array_values($listaEstudiantes);

    $_SESSION['estudiantes'] = $listaEstudiantes;

    header("Location:index.php");
        exit();
}*/

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Listado de Regiones</title>

  <!-- Bootstrap core CSS -->
  <link href="../../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../styles/css/scrolling-nav.css" rel="stylesheet">
  
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<script>
function confirmationDelete()
{
   var confirmation = confirm('Seguro que quiere eliminar esta Region?');
   if(confirmation==true){
    return true;
   }
     else{
       return false;
     }
}
</script>

</head>

<body id="page-top">
  
    <!-- Navigation -->

    <?php $layout->mostrarHeader()?>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido al Mantenimiento de Regiones</h1>
      <p class="lead">Mira todas las Regiones registradas en nuestra Pokedex</p>
    </div>
  </header>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Listado de Regiones</h2>
                    
          <table class="table table-striped table-dark">

          <?php if(empty($listaRegiones)):?>
          <thead>
            <tr>
              <th scope="col"><i class="fa fa-id-badge" aria-hidden="true"></i> ID</th>
              <th scope="col"><i class="fa fa-user" aria-hidden="true"></i> Nombre</th>
              <th scope="col"><i class="fa fa-user" aria-hidden="true"></i> Capital</th>
              <th scope="col"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Liga Pokemon</th>
              <th scope="col"><i class="fa fa-bell" aria-hidden="true"></i><i class="fa fa-bell-slash" aria-hidden="true"></i>Color</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th colspan="5">No hay Regiones en la Pokedex</th>
            </tr>

        <?php else:?>

          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Capital</th>
              <th scope="col">Liga Pokemon</th>
              <th scope="col">Color</th>
              <th scope="col">Editar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
  <tbody>

  <?php foreach($listaRegiones as $region):?>
  <tr>
  
      <th scope="row"><?php echo $region->ID?></th>
      <td><?php echo $region->nombre?></td>
      <td><?php echo $region->capital?></td>
      <td><?php echo $region->ligaPokemon?></td>
      <td <?php echo "style='background-color:{$region->color}'";?>></td>
      <td style="text-align:center;"><a href="editar.php?ID=<?php echo $region->ID ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      <td style="text-align:center;"><a href="eliminar.php?ID=<?php echo $region->ID?>" class="btn btn-sm btn-outline-danger" onclick="return confirmationDelete()"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
    </tr>

<?php endforeach;?>
<?php endif;?>
  </tbody>
</table>
         
        </div>
      </div>
    </div>
  </section>

  <!--Seccion Guardar -->

  <section id="guardar" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Guardado de Regiones</h2>
          <div class="card mb-4">
          <a href="guardar.php"><img class="card-img-top" src="../../imagenesGuardar/regiones.png" alt="Card image cap"></a>
          <div class="card-body">
            <h2 class="card-title">Añade nuevos Regiones a nuestra Pokedex!</h2>
            <p class="card-text">En esta seccion podras añadir las regiones que forman parte del mundo Pokemon para que sean visibles en nuestra pokedex. Añade informacion de las regiones como el nombre, la capital de la region, la liga pokemon que se lleva a cabo en la region, lugares de interes y el color que representa a la region.</p>
            <a href="guardar.php" class="btn btn-primary">Guardar &rarr;</a>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>
  
  <?php $layout->mostrarFooter();?>

</body>

</html>
