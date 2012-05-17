<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Emp
 *
 * @author Home
 */
class Emp {
    
    public $id_emprestimo;
    public $dt_inicial_emprestimo;
    public $requisitante_id;
    public $usuario_id;
    public $items;
    
    function addItens(Item $item){
        $this->items[] = $item;
    }
    
    function setIdEmprestimo($valor){
        $this->id_emprestimo = $valor;
    }
    
    function setDtInicialEmprestimo($valor){
        $this->dt_inicial_emprestimo = $valor;
    }
    
    function setRequisitanteId($valor){
        $this->requisitante_id = $valor;
    }
    
    function setUsuarioId($valor){
        $this->usuario_id = $valor;
    }
    
    function __set($name, $value) {
        if($name == 'Items')
        {
            $this->addItens($value);        
        }            
    }
    
    function loadItens()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $itens = $db->getConn()->query('select * from itens_emprestimos where emprestimos_id = '.$this->id_emprestimo.';')->fetchAll(PDO::FETCH_CLASS, "Item");
        return $itens;
    }
    
    function loadRequisitante()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $req = $db->getConn()->query('select nome_usuario from usuarios where id_usuario = '.$this->requisitante_id.';')->fetchAll(PDO::FETCH_CLASS, "Item");
        return $req;
    }
        
    function loadAtendente()
    {
        include_once 'app.ado/DataBase.php';
        $db = new DataBase();
        $aten = $db->getConn()->query('select nome_usuario from usuarios where id_usuario = '.$this->usuario_id.';')->fetchAll(PDO::FETCH_CLASS, "Item");
        return $aten;
    }
    
}

?>
