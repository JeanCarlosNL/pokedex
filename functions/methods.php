<?php

class methods
{

    public $carreras = [1=>"Software", 2=>"Multimedia", 3=>"Mecatronica", 4=>"Seguridad", 5=>"Redes"];

    public function filtro($lista,$propiedad,$value){
         
        $filtro=[];
    
        foreach($lista as $elemento){
              if($elemento->$propiedad == $value){
                array_push ($filtro,$elemento);
              } 
        }
    
        return $filtro; 
    
}
    
    public function ultimoElemento($lista){
    
        $contarLista=count($lista);
        $ultimoElemento = $lista[$contarLista-1];
        return $ultimoElemento;
    }
    
    public function getIndex($lista, $property, $value){
        $index = 0;
        $aux = 0;
    
        foreach($lista as $elemento){
            if($elemento->$property==$value){
                $index = $aux;
                break;
            }
            $aux++;
    
        }
        return $index;
    }

    public function CargarImagen($directory, $name, $tmpname, $type, $size)
    {
        $isSuccess = false;

        if ((($type == "image/gif")
                || ($type == "image/jpeg")
                || ($type == "image/png")
                || ($type == "image/jpg")
                || ($type == "image/JPG")
                || ($type == "image/pjpeg"))
            && ($size < 5000000)
        ) {

            if (!file_exists($directory)) {

                mkdir($directory, 007, true);

                if (file_exists($directory)) {

                   /* if (file_exists($name)) {
                        unlink($name);
                    }*/

                    move_uploaded_file($tmpFile,  $name);
                    $isSuccess = true;
                }
            } else {

                if (file_exists($name)) {
                    unlink($name);
                }

                move_uploaded_file($tmpFile, $name);
                $isSuccess = true;
            }
        } else {
            $isSuccess = false;
        }

        return $isSuccess;
    }

    public function getTimeCookie(){
        return time() + 60*60*24*15;
    }
}


