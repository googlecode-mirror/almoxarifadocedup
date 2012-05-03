<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chaves
 *
 * @author Home
 */
class CrlChave {
    
    private $id_controle;
    private $professor_id;
    private $laboratorio_id;
    private $observacao_controle;
    private $dt_inicial_controle;
    private $dt_final_controle;
    
    function __construct(){
        
    }
  
    /* Setters and Getters */
    
    function setIdCrontrole($valor){
        $this->id_controle = $valor;
    }
    
    function getIdCrontrole(){
        return $this->id_controle;
    }
    
    function setProfessorId($valor){
        $this->professor_id = $valor;
    }
    
    function getProfessorId(){
        return $this->professor_id;
    }
    
    function setLaboratorioId($valor){
        $this->laboratorio_id = $valor;
    }
    
    function getLaboratorioId(){
        return $this->laboratorio_id;
    }
    
    function setObservacaoControle($valor){
        $this->observacao_controle = $valor;
    }
    
    function getObservacaoControle(){
        return $this->observacao_controle;
    }
    
    function setDtInicialControle($valor){
        $this->dt_inicial_controle = $valor;
    }
    
    function getDtInicialControle(){
        return $this->dt_inicial_controle;
    }
    
    function setDtFinalControle($valor){
        $this->dt_final_controle = $valor;
    }
    
    function getDtFinalControle(){
        return $this->dt_final_controle;
    }
   
}

?>
