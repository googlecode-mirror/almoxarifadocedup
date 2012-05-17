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
    
    function loadProfessor()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $nome = $db->getConn()->query('select nome_usuario from usuarios where id_usuario = '.$this->professor_id.';')->fetch(PDO::FETCH_COLUMN);
        unset($db);
        return $nome;
    }
    
    function loadLaboratorio()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $lab = $db->getConn()->query('select nome_laboratorio from laboratorios where id_laboratorio = '.$this->laboratorio_id.';')->fetch(PDO::FETCH_COLUMN);
        unset($db);
        return $lab;
    }   
}

?>
