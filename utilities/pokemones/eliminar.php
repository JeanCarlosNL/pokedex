<?php
//incluimos los archivos php que estaremos utilizando
include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'pokemones.php';
require_once '../service/serviceBase.php';
require_once '../tipos/serviceTipo.php';
require_once '../regiones/serviceRegion.php';
require_once 'servicePokemon.php';

$servicioPokemon = new servicePokemon();


if (isset($_GET['ID'])) {
    $pokemonID = $_GET['ID']; //El Id del personaje que vamos a editar   
    $servicioPokemon->Eliminar($pokemonID);

}

 header("Location: ../../index.php#services"); //enviamos a la pagina principal del website
 exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento

?>