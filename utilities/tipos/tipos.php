<?php

class Tipos{

    public $ID;
    public $nombre;
    public $caracteristicas;
    function __construct(){}

    public function iniciarClase($ID,$nombre,$caracteristicas){
        
        $this->ID=$ID;
        $this->nombre=$nombre;
        $this->caracteristicas=$caracteristicas;

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
}