<?php
class Opcion{
    private $titulo;
    private $enlace;
    private $colorFondo;

    public function __constructor($title, $link, $bcolor) {
        $this -> titulo = $title;
        $this -> enlace = $enlace;
        $this -> colorFondo = $colorFondo;
    }

    public function graficar(){
        $estilo = 'background-color: '.$this->colorFondo;
        echo '<a style="'.$estilo.'"href="'.$this->enlace.'">'.$this->titulo.'</a>';
    }
}
?>