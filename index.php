<?php

include 'helpers/layout.php';
include 'functions/methods.php';
require_once 'utilities/pokemones/pokemones.php';
require_once 'utilities/service/serviceBase.php';
require_once 'utilities/pokemones/servicePokemon.php';
require_once 'utilities/tipos/serviceTipo.php';
require_once 'utilities/regiones/serviceRegion.php';


$layout = new layout(false,false,false,false);
$method = new methods();
$servicioPokemon = new ServicePokemon();
$servicioTipo= new ServiceTipo();
$servicioRegion = new ServiceRegion();

/* Seccion Mostrar/Filtrar */

$listaRegion = $servicioRegion->getLista();
$listaTipos = $servicioTipo->getLista();
$listaPokemon = $servicioPokemon->getLista();
$listaPokemonTipos=$listaPokemon;
$filtarNombre = "";
$miniaturas=false;

if(isset($_GET["Miniaturas"])){
    if($_GET["Miniaturas"]==true)
    $miniaturas=true;
}

if(!empty($listaPokemon)){
    if(isset($_GET['Tipo']))
    {
     $listaPokemon = $method->filtro($listaPokemon,'tipo',$_GET['Tipo']);
    } 

    if(isset($_GET['Region'])){
      $listaPokemon = $method->filtro($listaPokemon,'region',$_GET['Region']);
    }

    if(isset($_GET['Tipo']) && isset($_GET['Region']))
    {
     $listaPokemonT = $method->filtro($listaPokemon,'tipo',$_GET['Tipo']);
     $listaPokemonG = $method->filtro($listaPokemon,'region',$_GET['Region']);
     $listaPokemon = array_merge($listaPokemonT,$listaPokemonG);
    } 
}

function getColorRegion($listaRegion,$pokemon){

  $color;
  foreach($listaRegion as $region){

        if($pokemon->region == $region->nombre){
        $color = $region->color;
    }
  }
  return $color;

}

function getTiposGuardados($listaPokemonTipos){

  $tiposGuardados = array();
  $i=0;
  foreach($listaPokemonTipos as $pokemon){
      $tiposGuardados[$i] = $pokemon->tipo;
      $i++;
  }

  return $tiposGuardados;
}


if(isset($_GET['ID'])==true){

    $index = $_GET['ID'];

    unset($listaPokemon[$index]);

    $listaPokemon = array_values($listaPokemon);

    setcookie('Pokemon',json_encode($listaPokemon),$method->getTimeCookie(), "/");

    header("Location:index.php");
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

  <title>Registro de Estudiantes</title>

  <!-- Bootstrap core CSS -->
  <link href="styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="styles/css/scrolling-nav.css" rel="stylesheet">
  
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<script>
function confirmationDelete()
{
   var confirmation = confirm('Seguro que quiere eliminar a este Pokemon?');
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
      <h1>Bienvenido al Mantenimiento de Pokemones</h1>
      <p class="lead">Mira todos los Pokemos disponibles en nuestra Pokedex</p>
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Despliegue

        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="index.php#services">Tabla</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="index.php?Miniaturas=true#services">Miniaturas</a>
        </div>
    </div>
    </div>
  </header>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Listado de Pokemones</h2>
          <div class="row">
           
           <!-- Apartado de Filtros -->
           
          <div class="form-group col-md-6">
                  <label for="tipo" class="lead">Filtro por Tipo de Pokemon</label>
                  <select id="tipo" name="tipo" class="form-control" onchange="location=this.value">
                  
                    <?php if(empty($_GET["Tipo"])):?>
                        <option class="lead" value="index.php<?php if($miniaturas==false){echo"";}else{echo "?Miniaturas=true";}?>">Todos</option>
                        <?php foreach(getTiposGuardados($listaPokemonTipos) as $tipo):?>
                        <option value="index.php<?php if($miniaturas==false){echo "?Tipo=".$tipo;}else{echo "?Miniaturas=true&Tipo=".$tipo;} ?>" class="lead"><?php echo $tipo?></option>
                        <?php endforeach;?>
                    
                    <?php else:?>
                        <option value="index.php<?php if($miniaturas==false){echo"";}else{echo "?Miniaturas=true";}?>" class="lead">Todos</option>
                        <?php foreach(getTiposGuardados($listaPokemonTipos) as $tipo):?>
                        <option value="index.php<?php if($miniaturas==false){echo "?Tipo=".$tipo;}else{echo "?Miniaturas=true&Tipo=".$tipo;}?>" class="lead" <?php if($_GET["Tipo"]==$tipo) echo "selected"?>><?php echo $tipo?></option>
                        <?php endforeach;?>

                    <?php endif;?>
                  </select>
                  <small>*Tipo principal*</small>
             </div>
             <div class="form-group col-md-6">
                  <label for="region" class="lead">Filtro por Region del Pokemon</label>
                  <select id="region" name="region" class="form-control" onchange="location=this.value">
                  
                    <?php if(empty($_GET["Region"])):?>
                        <option class="lead" value="index.php<?php if($miniaturas==false){echo"";}else{echo "?Miniaturas=true";}?>">Todos</option>
                        <?php foreach($servicioRegion->getLista() as $region):?>
                        <option value="index.php<?php if($miniaturas==false){echo "?Region=".$region->nombre;}else{echo "?Miniaturas=true&Region=".$region->nombre;} ?>" class="lead"><?php echo $region->nombre?></option>
                        <?php endforeach;?>
                    
                    <?php else:?>
                        <option value="index.php<?php if($miniaturas==false){echo "";}else{echo "?Miniaturas=true";}?>" class="lead">Todos</option>
                        <?php foreach($servicioRegion->getLista() as $region):?>
                        <option value="index.php<?php if($miniaturas==false){echo "?Region=".$region->nombre;}else{echo "?Miniaturas=true&Region=".$region->nombre;}?>" class="lead" <?php if($_GET["Region"]==$region->nombre) echo "selected"?>><?php echo $region->nombre?></option>
                        <?php endforeach;?>

                    <?php endif;?>
                  </select>
             </div>
           
           <!-- Fin Apartado de Filtro -->

         </div>

         <!-- Validacion del Despligue -->
         
         <?php if($miniaturas==true): ?>

         <!-- Despliegue en Miniaturas -->

        <?php if(empty($listaPokemon)):?>

        <div class="container">
            <div class="row">
              <div class="col-sm">
              <figure class="figure">
                <img src="imagenesGuardar/SinPokemones.png" class="figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption text-right">Agrege Nuevos Pokemones</figcaption>
              </figure>
              </div>
            </div>
          </div>
        <?php else:?>
         <div class="container">
            <div class="row">
            <?php foreach($listaPokemon as $pokemon):?>
              <div class="col-sm col-md-4">
              <figure class="figure">
                <img   src="utilities/pokemones/<?php echo $pokemon->profilePhoto; ?>" class="figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption text-right"><?php echo $pokemon->nombre; ?></figcaption>
              </figure>
              </div>
             <?php endforeach;?>
            </div>
          </div>
          <?php endif;?>

          <!-- Fin Despliegue en Miniaturas -->
        
         
         <?php else:?>

          <table class="table table-striped table-dark">

          <?php if(empty($listaPokemon)):?>
          <thead>
              <tr>
                <th scope="col"><i class="fa fa-id-badge" aria-hidden="true"></i> ID</th>
                <th scope="col"><i class="fa fa-user" aria-hidden="true"></i> Nombre</th>
                <th scope="col"><i class="fa fa-user" aria-hidden="true"></i> Tipos</th>
                <th scope="col"><i class="fa fa-bell" aria-hidden="true"></i><i class="fa fa-bell-slash" aria-hidden="true"></i> Region</th>
                <th scope="col"><i class="fa fa-picture" aria-hidden="true"></i> Imagen</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th colspan="5">No hay Pokemones registrados en la Pokedex</th>
              </tr>

          <?php else:?>

            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipos</th>
                <th scope="col">Region</th>
                <th scope="col">Imagen</th>
                <th scope="col">Detalles</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach($listaPokemon as $pokemon): ?>
            <tr>
            
                <th scope="row"><?php echo $pokemon->ID?></th>
                <td><?php echo $pokemon->nombre?></td>
                <td><?php echo $pokemon->tipo?></td>
                <td style="text-align:center; color:<?php echo getColorRegion($listaRegion,$pokemon);?>"><?php echo $pokemon->profilePhoto?></td>
                <td style="text-align:center;"><img width="100px" height="90px" src="utilities/pokemones/<?php echo $pokemon->profilePhoto?>"/></td>
                <td style="text-align:center;"><a href="utilities/pokemones/detalles.php?ID=<?php echo $pokemon->ID?>" class="btn btn-sm btn-outline-info"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                <td style="text-align:center;"><a href="utilities/pokemones/editar.php?ID=<?php echo $pokemon->ID ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td style="text-align:center;"><a href="utilities/pokemones/eliminar.php?ID=<?php echo $pokemon->ID ?>"class="btn btn-sm btn-outline-danger" onclick="return confirmationDelete()"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>

          <?php endforeach;?>
          <?php endif;?>
            </tbody>
          </table>

<?php endif;?>
         
        </div>
      </div>
    </div>
  </section>

  <!--Seccion Guardar -->

  <section id="guardar" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Guardado de Pokemones</h2>
          <div class="card mb-4">
          <a href="utilities/pokemones/guardar.php"><img class="card-img-top" src="imagenesGuardar/pokemones.jpg" alt="Card image cap"></a>
          <div class="card-body">
            <h2 class="card-title">Añade nuevos Pokemones a nuestra Pokedex!</h2>
            <p class="card-text">En esta seccion podras añadir los pokemos que descrubras para que sean visibles en nuestra pokedex. Añade informacion del pokemos como el nombre, el o los tipos a los que pertenece, una imagen del pokemon, los ataques que tiene, la región en la que podemos encontrarlo.</p>
            <a href="utilities/pokemones/guardar.php" class="btn btn-primary">Guardar &rarr;</a>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>
  
  <?php $layout->mostrarFooter();?>

</body>

</html>
