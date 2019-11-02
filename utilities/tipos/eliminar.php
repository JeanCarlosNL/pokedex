<?php
include '../../helpers/layout.php';
include '../../functions/methods.php';
require_once 'tipos.php';
require_once '../service/serviceBase.php';
require_once 'serviceTipo.php';

$servicioTipo = new ServiceTipo();


if (isset($_GET['ID'])) {
    $tipoID = $_GET['ID']; //El Id del personaje que vamos a editar   
    $servicioTipo->Eliminar($tipoID);

}

 header("Location: listaTipos.php"); //enviamos a la pagina principal del website
 exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento

?>