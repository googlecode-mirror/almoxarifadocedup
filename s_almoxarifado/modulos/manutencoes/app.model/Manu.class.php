<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manu
 *
 * @author Home
 */
class Manu {
    
    /**
     * 
     * @var int 
     */
    private $id_manutencao;
    
    /**
     *
     * @var int 
     */
    private $professor_id;
    
    /**
     *
     * @var date 
     */
    private $data_manutencao;
    
    /**
     *
     * @var text 
     */
    private $providencia_manutencao;
    
    /**
     * boolean
     * @var int 
     */
    private $definitivo_manutencao;
    
    /**
     * 
     * @var int 
     */
    private $req_manutencao_id;
    
    function __construct(){
        
    }
    
    // Setters and Getters
    
    function setIdManutencao($valor){
        $this->id_manutencao = $valor; 
    }
    
    function getIdManutencao(){
        return $this->id_manutencao; 
    }
    
    function setProfessorId($valor){
        $this->professor_id = $valor; 
    }
    
    function getProfessorId(){
        return $this->professor_id; 
    }
    
    function setDataManutencao($valor){
        $this->data_manutencao = $valor; 
    }
    
    function getDataManutencao(){
        return $this->data_manutencao; 
    }
    
    function setProvidenciaManutencao($valor){
        $this->providencia_manutencao = $valor; 
    }
    
    function getProvidenciaManutencao(){
        return $this->providencia_manutencao; 
    }
    
    function setDefinitivoManutencao($valor){
        $this->definitivo_manutencao = $valor; 
    }
    
    function getDefinitivoManutencao(){
        return $this->definitivo_manutencao; 
    }
    
     function setReqManutencaoId($valor){
        $this->req_manutencao_id = $valor; 
    }
    
    function getReqManutencaoId(){
        return $this->req_manutencao_id; 
    }
    
    
    
    
    
   
    
}

?>
