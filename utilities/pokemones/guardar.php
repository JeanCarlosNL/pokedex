<?php
include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'pokemones.php';
require_once '../service/serviceBase.php';
require_once '../tipos/serviceTipo.php';
require_once '../regiones/serviceRegion.php';
require_once 'servicePokemon.php';



$layout = new layout(true,false,"regiones","pokemon");
$methods = new methods();
$servicioPokemon = new ServicePokemon();
$servicioTipo = new ServiceTipo();
$servicioRegion = new serviceRegion();

/*Seccion Guardar*/

if(isset($_POST['Nombre']) && isset($_POST['TipoPrincipal']) && isset($_POST['Region']) && isset($_POST['Ataques'])){

  if(isset($_POST['TipoSecundario']) && $_POST['TipoSecundario']!="Seleccione..."){

    $tipos = $_POST['TipoPrincipal'].",".$_POST['TipoSecundario'];

  }else{
    $tipos = $_POST['TipoPrincipal'];
  }
  
  $ataquesC=explode(",",$_POST['Ataques']);
  $cantidadA = count($ataquesC);
  if($cantidadA>4){
     for($i=0;$i<4;$i++){
       $ataques[$i]=$ataquesC[$i];
     }
  }else{
    $ataques=$ataquesC;
  }

  $nuevoPokemon = new Pokemon();

  $listaPokemon = $servicioPokemon->getLista();
  if(!empty($listaPokemon)){

    $ultimo = $methods->ultimoElemento($listaPokemon);
    $pokemonID = $ultimo->ID + 1;
  }else{
    $pokemonID=1;
  }

  if ($_FILES['profilePhoto']) {

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
      }
  }else{
      move_uploaded_file($tmpname,$name);
  }
}

  $nuevoPokemon->iniciarClase(0, $_POST["Nombre"],$tipos,$ataques,$_POST['Region']);
  $nuevoPokemon->profilePhoto=$name;
  $servicioPokemon->Guardar($nuevoPokemon);

  header("Location:../../index.php");
   exit();
}

$hayRegiones = $servicioRegion->getLista();
$hayTipos = $servicioTipo->getLista();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registro de Pokemon</title>

  <!-- Bootstrap core CSS -->
  <link href="../../styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../styles/css/scrolling-nav.css" rel="stylesheet">

  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php $layout->mostrarHeader();?>

<header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenido al registro de Pokemones</h1>
      <p class="lead">Registra los nuevos Pokemones que encuentres!</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">

        <?php if(empty($hayRegiones) || empty($hayTipos)): ?>

        <div class="container">
                  <div class="row">
                    <div class="col-sm">
                    <figure class="figure">
                      <img src="../../imagenesGuardar/noTiposNoRegiones.png" class="figure-img img-fluid rounded" alt="...">
                      <figcaption class="figure-caption text-right">Agrege Nuevos Registros</figcaption>
                    </figure>
                    </div>
                  </div>
                </div>
        <?php else:?>

          <h2>Registro de Pokemones</h2>
          <p class="lead">Realiza el registro de nuevos Pokemones colocando los siguientes datos:</p>

          <form method="POST" enctype="multipart/form-data" action ="guardar.php">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="Nombre" class="lead">Nombre del Pokemon</label>
                  <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Indroduza el nombre del Pokemon" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="Region" class="lead">Region del Pokemon</label>
                  <select id="Region" name="Region" class="form-control">
                    <option selected>Seleccione...</option>
                    <?php foreach($servicioRegion->getLista() as $region):?>
                        <option name = "Region" value="<?php echo $region->nombre?>" class="lead"><?php echo $region->nombre?></option>
                    <?php endforeach;?>
                    
                  </select>
                 </div>
                <div class="form-group col-md-6">
                  <label for="TipoPrincipal" class="lead">Tipo Principal</label>
                  <select id="TipoPrincipal" name="TipoPrincipal" class="form-control" required>
                    <option selected>Seleccione...</option>
                    <?php foreach($servicioTipo->getLista() as $tipo):?>
                        <option name = "TipoPrincipal" value="<?php echo $tipo->nombre?>" class="lead"><?php echo $tipo->nombre?></option>
                    <?php endforeach;?>
                  </select>
                 </div>
                 <div class="form-group col-md-6">
                  <label for="TipoSecundario" class="lead">Tipo Secundario</label>
                  <select id="TipoSecundario" name="TipoSecundario" class="form-control">
                    <option selected>Seleccione...</option>
                    <?php foreach($servicioTipo->getLista() as $tipo):?>
                        <option name = "TipoSecundario" value="<?php echo $tipo->nombre?>" class="lead"><?php echo $tipo->nombre?></option>
                    <?php endforeach;?>
                    
                  </select>
                  <small>Opcional</small>
                 </div>
                 <div class="form-group col-md-12">
                      <label for="Ataques">Ataques</label>
                      <textarea name="Ataques" id="Ataques" class="form-control" placeholder="Escriba los Ataques del Pokemon" required></textarea>
                      <small>Colocar los ataques separados por comas. Solo 4 son validados</small>
                 
                 </div>

                 <div class=" form-group col-md-5">
                        <div class="form-group">

                            <label for="profilePhoto">Imagen del Pokemon</label>
                            <input name="profilePhoto" type="file" class="form-control" id="profilePhoto" accept="image/*" required/>
                        </div>
                    </div>
               </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
          </form>
        </div>
      </div>
    </div>
  </section>
<script>
let cantidadComas=0;
document.getElementbyID('#Ataques').keyup(function(e){
var texto = Document.getElementByID('Ataques').val();
  for(let i=0; i< texto.length;i++){
    if(seach(texto) !=-1){
      cantidadComas++;
    }
    if(cantidadComas==4){
      alert('Cantidad de ataques Maximo');
      break;
    }
  }
});
</script>
  <?php endif;?>

  <?php $layout->mostrarFooter();?>
    
</body>
</html>