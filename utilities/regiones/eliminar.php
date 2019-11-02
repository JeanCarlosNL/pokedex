<?php 
include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'regiones.php';
require_once '../service/serviceBase.php';
require_once 'serviceRegion.php';

$servicioRegion = new ServiceRegion();


if (isset($_GET['ID'])) {
    $regionID = $_GET['ID']; //El Id del personaje que vamos a editar   
    $servicioRegion->Eliminar($regionID);

}

 header("Location: listaRegiones.php"); //enviamos a la pagina principal del website
 exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento

?>