<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RequerirManu
 * Provê de métodos para a funcão de
 * requerimento de manutenção.
 * @author Home
 */
class Requerir {
    
    /**
     *
     * @var int 
     */
    private $id_requisicao;
    
    /**
     *
     * @var date 
     */
    private $dt_requisicao;
    
    /**
     *
     * @var string; 
     */
    private $equipamento_requisicao;
    
    /**
     *
     * @var string; 
     */
    private $local_equipamento;
    
    /**
     *
     * @var string 
     */
    private $defeito_requisicao;
     
    /**
     *
     * @var int 
     */
    private $requisitante_id;
    
    /**
     *
     * @var int 
     */
    private $estado_id;
    
    
    function __construct(){
        
    }
    
    function aprovar($id){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = 'UPDATE req_manutencao SET estado_id = 2
                       WHERE id_requisicao = ?';
                       
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
    
    function negar($id){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = 'UPDATE req_manutencao SET estado_id = 5
                       WHERE id_requisicao = ?';
                       
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
    
    function CancelarStatus($id){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = 'UPDATE req_manutencao SET estado_id = 1
                       WHERE id_requisicao = ?';
                       
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
    
    
    
    
    
    /* SETTERS and GETTERS */
    
    function setIdRequisicao($valor){
        $this->id_requisicao = $valor;
    }
    
    function getIdRequisicao(){
        return $this->id_requisicao;
    }
    
    function setDtRequisicao($valor){
        $this->dt_requisicao = $valor;
    }
    
    function getDtRequisicao(){
        return $this->dt_requisicao;
        
    }
    
    function setEquipamentoRequisicao($valor){
        $this->equipamento_requisicao = $valor;
    }
    
    function getEquipamentoRequisicao(){
        return $this->equipamento_requisicao;
    }
    
    function setLocalEquipamento($valor){
        $this->local_equipamento = $valor;
    }
    
    function getLocalEquipamento(){
        return $this->local_equipamento;
    }
    
    function setDefeitoRequisicao($valor){
        $this->defeito_requisicao = $valor;
    }
    
    function getDefeitoRequisicao(){
        return $this->defeito_requisicao;
    }
    
    function setRequisitanteId($valor){
        $this->requisitante_id = $valor;
    }
    
    function getRequisitanteId(){
        return $this->requisitante_id;
    }
    
    function setEstadoId($valor){
        $this->estado_id = $valor;
    }
    
    function getEstadoId(){
        return $this->estado_id;
    }
    
    function loadRequisitante()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $req = $db->getConn()->query('select nome_usuario from usuarios where id_usuario ='.$this->requisitante_id.';')->fetch(PDO::FETCH_COLUMN);
        return $req;
    }
    
    function loadEstado()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $est = $db->getConn()->query('select nome_estado_requisicao from estados_requisicoes where id_estado_requisicao ='.$this->estado_id.';')->fetch(PDO::FETCH_COLUMN);
        return $est;
    }
    
    function loadManutencoes()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $manu = $db->getConn()->query('select * from manutencoes where req_manutencao_id ='.$this->id_requisicao.';')->fetchAll(PDO::FETCH_CLASS, 'Manu');
        return $manu;
    }
    
}

?>
