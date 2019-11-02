<?php

class ServiceRegion implements ServiceBase{

    public function GetById($ID){

        $methods = new methods();
        $listaRegion = $this->GetLista();
        $elementoDecode = $methods->filtro($listaRegion,'ID', $ID)[0];
        $elemento = new region();
        $elemento->set($elementoDecode);
        return $elemento;

    }
    public function GetLista(){

        $methods = new methods();
        $listaRegion = array();
        if(isset($_COOKIE['region'])){
            $listaRegion = json_decode($_COOKIE['region'],false);
        }else{
            setcookie("region", json_encode($listaRegion),$methods->getTimeCookie(),"/");
        }

        return $listaRegion;

    }
    public function Guardar($entity){

        $methods =new methods();
        $listaRegion = $this->GetLista();
        
        $regionID = 1;

        if(!empty($listaRegion)){
           $ultimoregion = $methods->ultimoElemento($listaRegion);
           $regionID = $ultimoregion->ID + 1;
        }

        $entity->ID =$regionID;

        array_push($listaRegion,$entity);
        setcookie("region",json_encode($listaRegion),$methods->getTimeCookie(),"/");


    }
    public function Actualizar($ID,$entity){

        $methods = new methods();
        $listaRegion = $this->GetLista();
        $indexElemento = $methods->getIndex($listaRegion,"ID",$ID);
        $listaRegion[$indexElemento]=$entity;
        setcookie("region", json_encode($listaRegion),$methods->GetTimeCookie(), "/");

    } 
    public function Eliminar($ID){

        $methods = new methods();
        $listaRegion = $this->getLista();
        $indexElemento = $methods->getIndex($listaRegion,"ID",$ID);

        unset($listaRegion[$indexElemento]);
        $listaRegion=array_values($listaRegion);
        setcookie("region", json_encode($listaRegion),$methods->GetTimeCookie(), "/");
    }
}