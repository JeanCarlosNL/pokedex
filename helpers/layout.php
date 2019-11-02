<?php

class layout

{
    private $validation;
    private $directory; 
    private $mantenimiento;
    private $detalle;
    private $guardar;
    function __construct($isPage,$validation,$isMantenimiento,$isGuardar)
    {
        $this->directory = ($isPage) ? '../../' : "";
        $this->validation = ($validation) ? "guardar.php" : "#guardar";
        $this->mantenimiento = $isMantenimiento;
        $this->guardar = $isGuardar;
    }

    function guardarPag(){

      if($this->guardar=="pokemon"){
         return "../../index.php";
      }
      if($this->guardar=="region"){
           return "listaRegiones.php";
      }
      if($this->guardar=="tipo"){
            return "listaTipos.php";
      }

      if($this->guardar==false){
         return "hidden";
      }
      return "";
    }

    function guardarPag2(){

      if($this->guardar=="pokemon" || $this->guardar=="region" || $this->guardar=="tipo" ){
         return "hidden";
      }
      return "";
    }

    function mantenimientosPag(){
      
      $mant;

      if($this->directory==true){
         if($this->mantenimiento=="regiones"){
            $mant = "../";
         }
      }else{
          $mant = "utilities/";
      }

      return $mant;
    }

    function mantenimientosPagPokemon(){
      $mantP;
      if($this->directory==true){
        if($this->mantenimiento=="regiones"){
           $mantP = "../../";
        }
      }else{
        $mantP ="";
      }
     return $mantP;
   }

    function validationPag(){
      
      $detal= $this->detalle;
      $pagina;

      if(isset($_GET['ID']) && $detal==false) {
        
        $pagina = "Editar";
        
      }else{
        $pagina = "Añadir";
      }  

      if($detal==true){
        $pagina = "Detalles";
      }

      return $pagina;

    }


    public function mostrarHeader(){

        $header=<<<EOF
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
          <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><i class="fa fa-id-card" aria-hidden="true"></i> ITLA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Mantenimientos
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                  <a class="dropdown-item" href="{$this->mantenimientosPagPokemon()}">Pokemones</a>
                  <a class="dropdown-item" href="{$this->mantenimientosPag()}tipos/listaTipos.php">Tipos</a>
                  <a class="dropdown-item" href="{$this->mantenimientosPag()}regiones/listaRegiones.php">Regiones</a>
                </div>
                </li>
             </ul>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="{$this->guardarPag()}" {$this->guardarPag()}>Volver al Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="{$this->validation}"{$this->guardarPag2()}>{$this->validationPag()}</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
EOF;

      echo $header;

    }

    public function mostrarFooter(){

        $footer = <<<EOF
        <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{$this->directory}styles/vendor/jquery/jquery.min.js"></script>
<script src="{$this->directory}styles/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="{$this->directory}styles/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="{$this->directory}styles/js/scrolling-nav.js"></script>

EOF;

   echo $footer;


    }




}


















?>