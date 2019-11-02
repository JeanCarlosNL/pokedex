<?php

class ServicePokemon implements ServiceBase{

    public function GetById($ID){

        $methods = new methods();
        $listaPokemon = $this->GetLista();
        $elementoDecode = $methods->filtro($listaPokemon,'ID', $ID)[0];
        $elemento = new Pokemon();
        $elemento->set($elementoDecode);
        return $elemento;

    }
    public function GetLista(){

        $methods = new methods();
        $listaPokemon = array();
        if(isset($_COOKIE['Pokemon'])){
            $listaPokemon = json_decode($_COOKIE['Pokemon'],false);
        }else{
            setcookie("Pokemon", json_encode($listaPokemon),$methods->getTimeCookie(),"/");
        }

        return $listaPokemon;

    }
    public function Guardar($entity){

        $methods =new methods();
        $listaPokemon = $this->GetLista();
        
        $PokemonID = 1;

        if(!empty($listaPokemon)){
           $ultimoPokemon = $methods->ultimoElemento($listaPokemon);
           $PokemonID = $ultimoPokemon->ID + 1;
        }

        $entity->ID = $PokemonID;
        /*$entity->profilePhoto="";

        if ($_FILES['profilePhoto']) {

            $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
            $type =  $_FILES["profilePhoto"]["type"];
            $size =  $_FILES["profilePhoto"]["size"];
            $name = 'img/' . $PokemonID . '.' . $typeReplace;

            $sucess = $methods->CargarImagen("../pokemones/img", $name, $_FILES['profilePhoto']['tmp_name'], $type, $size);
            if ($sucess) {
                $entity->profilePhoto = $name;
            } 
        }*/

        array_push($listaPokemon,$entity);
        setcookie("Pokemon",json_encode($listaPokemon),$methods->getTimeCookie(),"/");

    }
    public function Actualizar($ID,$entity){

        $methods = new methods();
        $elemento = $this->GetByID($ID);
        $listaPokemon = $this->GetLista();

        $indexElemento = $methods->getIndex($listaPokemon,"ID",$ID);

        $listaPokemon[$indexElemento]=$entity;

        setcookie("Pokemon", json_encode($listaPokemon),$methods->GetTimeCookie(), "/");

    } 
    public function Eliminar($ID){

        $methods = new methods();
        $listaPokemon = $this->getLista();
        $indexElemento = $methods->getIndex($listaPokemon,"ID",$ID);

        unset($listaPokemon[$indexElemento]);
        $listaPokemon=array_values($listaPokemon);
        setcookie("Pokemon", json_encode($listaPokemon),$methods->GetTimeCookie(), "/");
    }
}


?>