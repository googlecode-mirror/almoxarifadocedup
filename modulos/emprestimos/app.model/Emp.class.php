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
    
    
    
}

?>
