<?php 
include '../../functions/methods.php';
include '../../helpers/layout.php';
require_once 'pokemones.php';
require_once '../service/serviceBase.php';
require_once 'servicePokemon.php';
require_once '../regiones/serviceRegion.php';
require_once '../tipos/serviceTipo.php';

$layout = new layout(true,false,"regiones","pokemon");
$methods = new methods;
$servicePokemon = new servicePokemon();
$servicioTipo = new serviceTipo();
$servicioRegion = new serviceRegion();


/* Seccion Editar */

if(isset($_GET['ID'])==true){

  $pokemonID = $_GET['ID'];

  $elemento = $servicePokemon->GetById($pokemonID);

  $explodedTipos = explode(",", $elemento->tipo);
  $tipoPrincipal = $explodedTipos[0];
  $tipoSecundario = $explodedTipos[1];

}



if(isset($_POST['Nombre']) && isset($_POST['TipoPrincipal']) && isset($_POST['Region']) && isset($_POST['Ataques'])){

  if(isset($_POST['TipoSecundario']) && $_POST['TipoSecundario']!="Seleccione..."){

    $tipos = $_POST['TipoPrincipal'].",".$_POST['TipoSecundario'];

  }else{
    $tipos = $_POST['TipoPrincipal'];
  }

  $ataques = explode(",",$_POST["Ataques"]);

  $actualizarPokemon = new Pokemon();
  $actualizarPokemon->iniciarClase($pokemonID,$_POST["Nombre"],$tipos,$ataques,$_POST["Region"]);
  
  if ($_FILES['profilePhoto']) {

    if ($_FILES['profilePhoto']['error'] == 4) {
        $actualizarPokemon->profilePhoto = $elemento->profilePhoto;
    } else {
      $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
      $type =  $_FILES["profilePhoto"]["type"];
      $size =  $_FILES["profilePhoto"]["size"];
      $tmpname = $_FILES["profilePhoto"]["tmp_name"];
      $directory = "img";
      $name = 'img/'.$pokemonID.'.'.$typeReplace;
  
      if(!file_exists('img')){
        mkdir('img',007,true);
        if(file_exists('img')){
             move_uploaded_file($tmpname,$name);
             $actualizarPokemon->profilePhoto=$name;
        }
    }else{
        move_uploaded_file($tmpname,$name);
        $actualizarPokemon->profilePhoto=$name;
    }
  }
}

  $servicePokemon->Actualizar($pokemonID,$actualizarPokemon);
  
  header("Location:../../index.php");
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

  <title>Edicion de Pokemon</title>

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
      <h1>Bienvenido a la Edicion de lo Pokemon</h1>
      <p class="lead">Mira todos los Pokemos disponibles en nuestra Pokedex</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Edicion del Pokemon</h2>
          <p class="lead">Actualiza la informacion del Pokemon seleccionado:</p>
          <form method="POST" enctype="multipart/form-data" action ="editar.php?ID=<?php echo $elemento->ID;?>">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="Nombre" class="lead">Nombre del Pokemon</label>
                  <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Indroduza su nombre" value = "<?php echo $elemento->nombre?>" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="Region" class="lead">Region del Pokemon</label>
                  <select id="Region" name="Region" class="form-control">
                    <option selected>Seleccione...</option>
                    <?php foreach($servicioRegion->getLista() as $region):?>
                        <option name = "Region" value="<?php echo $region->nombre?>" class="lead" <?php if($region->nombre==$elemento->region){echo "selected";}?>><?php echo $region->nombre?></option>
                    <?php endforeach;?>
                    
                  </select>
                 </div>
                <div class="form-group col-md-6">
                  <label for="TipoPrincipal" class="lead">Tipo Principal</label>
                  <select id="TipoPrincipal" name="TipoPrincipal" class="form-control">
                    <option selected>Seleccione...</option>
                    <?php foreach($servicioTipo->getLista() as $tipo):?>
                        <option name = "TipoPrincipal" value="<?php echo $tipo->nombre?>" class="lead" <?php if($tipo->nombre == $tipoPrincipal){echo "selected";}?>><?php echo $tipo->nombre?></option>
                    <?php endforeach;?>
                  </select>
                 </div>
                 <div class="form-group col-md-6">
                  <label for="TipoSecundario" class="lead">Tipo Secundario</label>
                  <select id="TipoSecundario" name="TipoSecundario" class="form-control">
                    <option selected>Seleccione...</option>
                    <?php foreach($servicioTipo->getLista() as $tipo):?>
                        <option name = "TipoSecundario" value="<?php echo $tipo->nombre?>" class="lead" <?php if($tipo->nombre == $tipoSecundario){echo "selected";}?>><?php echo $tipo->nombre?></option>
                    <?php endforeach;?>
                    
                  </select>
                  <small>Opcional</small>
                 </div>
                 <div class="form-group col-md-12">
                      <label for="Ataques">Ataques</label>
                      <textarea name="Ataques" id="Ataques" class="form-control" placeholder="Escriba las materias favoritas" required><?php echo implode(",",$elemento->ataques)?></textarea>
                      <small>Colocar los ataques separados por comas</small>
                 
                 </div>

                 <div class=" form-group col-md-5">
                        <div class="form-group">

                            <label for="profilePhoto">Imagen del Pokemon</label>
                            <input name="profilePhoto" type="file" class="form-control" id="profilePhoto" accept="image/*"/>
                        </div>
                    </div>
               </div>
            <button type="submit" class="btn btn-primary">Editar</button>
          </form>
        </div>
      </div>
    </div>
  </section>

 <?php $layout->mostrarFooter(); ?>
 
	</body>
</html>