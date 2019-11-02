<?php
include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'tipos.php';

require_once '../service/serviceBase.php';
require_once 'serviceTipo.php';


$layout = new layout(true,false,"regiones",false);
$method = new methods();
$servicioTipo = new ServiceTipo();


/* Seccion Mostrar/Filtrar */

$listaTipos = $servicioTipo->GetLista();

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

  <title>Lista de Tipos de Pokemon</title>

  <!-- Bootstrap core CSS -->
  <link href="../../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../styles/css/scrolling-nav.css" rel="stylesheet">
  
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<script>
function confirmationDelete()
{
   var confirmation = confirm('Seguro que quiere eliminar a este tipo de Pokemon?');
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
      <h1>Bienvenido al Mantenimiento de Tipos de Pokemones</h1>
      <p class="lead">Mira todos los tipos de Pokemon disponibles en nuestra Pokedex</p>
    </div>
  </header>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Listado de Tipos de Pokemon</h2>
          
          <table class="table table-striped table-dark">

          <?php if(empty($listaTipos)):?>
          <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Caracteristicas</th>
                <th scope="col">Editar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th colspan="6">No hay Tipos de Pokemon registrados</th>
              </tr>

         <?php else:?>

              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Caracteristicas</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach($listaTipos as $tipo): ?>
              <tr>
              
                  <th scope="row"><?php echo $tipo->ID?></th>
                  <td><?php echo $tipo->nombre?></td>
                  <td><?php echo $tipo->caracteristicas?></td>
                  <td style="text-align:center;"><a href="editarTipos.php?ID=<?php echo $tipo->ID ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                  <td style="text-align:center;"><a href="eliminar.php?ID=<?php echo $tipo->ID; ?>"class="btn btn-sm btn-outline-danger" onclick="return confirmationDelete()"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
          <a href="guardar.php"><img class="card-img-top" src="../../imagenesGuardar/tipos.jpg" alt="Card image cap"></a>
          <div class="card-body">
            <h2 class="card-title">Añade nuevos Tipos de Pokemones a nuestra Pokedex!</h2>
            <p class="card-text">En esta seccion podras añadir los tipos en los que puden manifestarse los Pokemon para que sean visibles en nuestra pokedex. Añade informacion como el nombre y las caracteristicas.</p>
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
