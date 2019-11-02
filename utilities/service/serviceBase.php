<?php

interface ServiceBase{

    public function GetById($ID);
    public function GetLista();
    public function Guardar($entity);
    public function Actualizar($ID,$entity);
    public function Eliminar($ID);
}

?>