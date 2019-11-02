<?php

class Region{

    public $ID;
    public $nombre;
    public $capital;
    public $ligaPokemon;
    public $color;

    function __construct(){}

    public function iniciarClase($ID,$nombre,$color,$capital,$ligaPokemon){
        
        $this->ID=$ID;
        $this->nombre=$nombre;
        $this->capital=$capital;
        $this->ligaPokemon=$ligaPokemon;
        $this->color=$color;

    }

    public function set($datos){
       foreach ($datos as $key=>$value) $this->{$key} = $value;
    }

    /*public function getTextTipo(){

        $utilities = new Utilities();

        if($this->company != 0 && $this->company !=null){
            return $utilities->company[$this->company];
        }

        return "";      

    }*/

    public function getLugares(){       

        if( !empty($this->lugaresInteres) && $this->lugaresInteres !=null){
            return implode(",",$this->lugaresInteres);
        }
        return "";      
    }
   
}