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
    
    /* and Getters   */
    
    function getIdLaboratorio(){
        return $this->id_laboratorio;
    }
    
    function getNomeLaboratorio(){
        return $this->nome_laboratorio;
    }
    
    function getNumeroLaboratorio(){
        return $this->numero_laboratorio;
    }
  
    function getChaveLaboratorio(){
        return $this->chave_laboratorio;
    }
}

?>
