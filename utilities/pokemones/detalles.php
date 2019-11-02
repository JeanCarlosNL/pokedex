<?php 
require_once '../../functions/methods.php';
require_once '../../helpers/layout.php';
require_once 'pokemones.php';
require_once '../service/serviceBase.php';
require_once 'servicePokemon.php';


$layout = new layout(true,false,true,"pokemon");
$methods = new methods;
$servicePokemon = new ServicePokemon();


if(isset($_GET['ID'])==true){

  $pokemonID = $_GET['ID'];

  $elemento = $servicePokemon->GetById($pokemonID);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Detalles de Pokemon</title>

  <!-- Bootstrap core CSS -->
  <link href="../../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../styles/css/scrolling-nav.css" rel="stylesheet">
  
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="page-top">

  <?php $layout->mostrarHeader();?>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido a los Detalles de Pokemon</h1>
      <p class="lead">Mira todos los Pokemos disponibles en nuestra Pokedex</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Detalles del Pokemon <?php echo $elemento->nombre;?></h2>
            <div class="card" style="width: 21rem;">
               <div class="card-body">
               <img width="250px" height="250px" src="<?php echo $elemento->foto;?>"/>
               </div>
               <hr>
            
                <div class="card-body">
                    <h5 class="card-title">Nombre</h5>
                    <p class="card-text"><?php echo $elemento->nombre;?> </p>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="card-title">Tipo</h5>
                    <p class="card-text"><?php echo $elemento->tipo;?> </p>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="card-title">Region</h5>
                    <p class="card-text"><?php echo $elemento->region;?> </p>
                </div>
                <hr>
                <div class="card-body">
                    <h5 class="card-title">Ataques</h5>
                     <?php foreach($elemento->ataques as $ataque):?>
                      <p class="card-text"><?php echo $ataque?> </p>
                      <?php endforeach;?>
                </div>
                <hr>
                <div class="card-body">
                    <a href="editar.php?ID=<?php echo $elemento->ID ?>" class="card-link">Editar al Pokemon</a>
                </div>
             </div>  
          
        </div>
      </div>
    </div>
  </section>

 <?php $layout->mostrarFooter(); ?>
 
	</body>
</html>