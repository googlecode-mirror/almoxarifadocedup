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
    
    public $id_laboratorio;
    public $nome_laboratorio;
    public $numero_laboratorio;
    public $chave_laboratorio;
    
    function setIdLaboratorio($valor){
        $this->id_laboratorio = $valor;   
    }
    
    function setNomeLaboratorio($valor){
        $this->nome_laboratorio = $valor;
    }
    
    function setNumeroLaboratorio($valor){
        $this->numero_laboratorio = $valor;
    }
  
    function setChaveLaboratorio($valor){
        $this->chave_laboratorio = $valor;
    }
}

?>
