<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lab
 *
 * @author Home
 */
class Lab {
    
    private $id_laboratorio;
    private $nome_laboratorio;
    private $numero_laboratorio;
    
    /* Setters and Getters   */
    
    function setIdLaboratorio($valor){
        $this->id_laboratorio = $valor;
    }
    
    function getIdLaboratorio(){
        return $this->id_laboratorio;
    }
    
    function setNomeLaboratorio($valor){
        $this->nome_laboratorio = $valor;
    }
    
    function getNomeLaboratorio(){
        return $this->nome_laboratorio;
    }
    
    function setNumeroLaboratorio($valor){
        $this->numero_laboratorio = $valor;
    }
    
    function getNumeroLaboratorio(){
        return $this->numero_laboratorio;
    }
}

?>
