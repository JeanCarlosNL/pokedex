<?php

class Pokemon{

    public $ID;
    public $nombre;
    public $tipo;
    public $ataques;
    public $region;
    public $profilePhoto;

    function __construct(){}

    public function iniciarClase($ID,$nombre,$tipo,$ataques,$region){
        
        $this->ID=$ID;
        $this->nombre=$nombre;
        $this->tipo=$tipo;
        $this->ataques=$ataques;
        $this->region=$region;
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

    public function getAtaques(){       

        if( !empty($this->ataques) && $this->ataques !=null){
            return implode(",",$this->ataques);
        }
        return "";      
    }
   
}