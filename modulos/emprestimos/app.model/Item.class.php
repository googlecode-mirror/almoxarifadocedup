<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item
 *
 * @author Home
 */
class Item {
    
    public $id_item;
    public $descricao_item;
    public $quantidade_item;
    public $dt_final;
    public $emprestimo_id;
    
    function setIdItem($valor){
        $this->id_item = $valor;
    }
    
    function setDescricaoItem($valor){
        $this->descricao_item = $valor;
    }
    
    function setQuantidadeItem($valor){
        $this->quantidade_item = $valor;
    }
    
    function setDtFinal($valor){
        $this->dt_final = $valor;
    }
    
    function setEmprestimoId($valor){
        $this->emprestimo_id = $valor;
    }
    
    
    
    
}

?>
