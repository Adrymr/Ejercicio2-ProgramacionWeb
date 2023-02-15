<?php

class estudiante {

    private $nombreEstudiante = "";
    private $cedulaEstudiante = "";
    private $notaMatematica = 0;
    private $notaFisica = 0;
    private $notaProgramacion = 0;

    public function getNombreEstudiante(){

        return $this->nombreEstudiante;
    }

    public function setNombreEstudiante($nombreEstudiante){
        
        $this->nombreEstudiante = $nombreEstudiante;
    }

    public function getCedulaEstudiante(){

        return $this->cedulaEstudiante;
    }

    public function setCedulaEstudiante($cedulaEstudiante){
        
        $this->cedulaEstudiante = $cedulaEstudiante;
    }

    public function getNotaMatematica(){

        return $this->notaMatematica;
    }

    public function setNotaMatematica($notaMatematica){
        
        $this->notaMatematica = $notaMatematica;
    }

    public function getNotaFisica(){

        return $this->notaFisica;
    }

    public function setNotaFisica($notaFisica){
        
        $this->notaFisica = $notaFisica;
    }

    public function getNotaProgramacion(){

        return $this->notaProgramacion;
    }

    public function setNotaProgramacion($notaProgramacion){
        
        $this->notaProgramacion = $notaProgramacion;
    }

}

?>