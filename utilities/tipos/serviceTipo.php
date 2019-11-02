<?php

class ServiceTipo implements ServiceBase{

    public function GetById($ID){

        $methods = new methods();
        $listaTipo = $this->GetLista();
        $elementoDecode = $methods->filtro($listaTipo,'ID', $ID)[0];
        $elemento = new Tipos();
        $elemento->set($elementoDecode);
        return $elemento;

    }
    public function GetLista(){

        $methods = new methods();
        $listaTipo = array();
        if(isset($_COOKIE['Tipo'])){
            $listaTipo = json_decode($_COOKIE['Tipo'],false);
        }else{
            setcookie("Tipo", json_encode($listaTipo),$methods->getTimeCookie(),"/");
        }

        return $listaTipo;

    }
    public function Guardar($entity){

        $methods =new methods();
        $listaTipo = $this->GetLista();
        
        $TipoID = 1;

        if(!empty($listaTipo)){
           $ultimoTipo = $methods->ultimoElemento($listaTipo);
           $TipoID = $ultimoTipo->ID + 1;
        }

        $entity->ID =$TipoID;

        array_push($listaTipo,$entity);
        setcookie("Tipo",json_encode($listaTipo),$methods->getTimeCookie(),"/");


    }
    public function Actualizar($ID,$entity){

        $methods = new methods();
        $elemento = $this->GetByID($ID);
        $listaTipo = $this->GetLista();

        $indexElemento = $methods->getIndex($listaTipo,"ID",$ID);

        $listaTipo[$indexElemento]=$entity;

        setcookie("Tipo", json_encode($listaTipo),$methods->GetTimeCookie(), "/");

    } 
    public function Eliminar($ID){

        $methods = new methods();
        $listaTipo = $this->getLista();
        $indexElemento = $methods->getIndex($listaTipo,"ID",$ID);

        unset($listaTipo[$indexElemento]);
        $listaTipo=array_values($listaTipo);
        setcookie("Tipo", json_encode($listaTipo),$methods->GetTimeCookie(), "/");
    }
}