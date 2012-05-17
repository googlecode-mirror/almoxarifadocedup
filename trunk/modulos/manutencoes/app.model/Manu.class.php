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
    private $reponsavel_id;
    
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
    
    /**
     *
     * @var text 
     */
    private $comentario_manutencao;
    
    function __construct(){
        
    }
    
    // Setters and Getters
    
    function setIdManutencao($valor){
        $this->id_manutencao = $valor; 
    }
    
    function getIdManutencao(){
        return $this->id_manutencao; 
    }
    
    function setResponsavelId($valor){
        $this->responsavel_id = $valor; 
    }
    
    function getResponsavelId(){
        return $this->responsavel_id; 
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
    
    function setComentarioManutencao($valor){
        $this->comentario_manutencao = $valor; 
    }
    
    function getComentatioManutencao(){
        return $this->comentario_manutencao; 
    }
    
    function loadResponsavel()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $est = $db->getConn()->query('select nome_usuario from usuarios where id_usuario = '.$this->responsavel_id.';')->fetch(PDO::FETCH_COLUMN);
        return $est;
    }
}

?>
