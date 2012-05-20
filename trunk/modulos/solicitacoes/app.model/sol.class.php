<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sol
 *
 * @author Home
 */
class Sol {
   
    public $id_aquisicao;
    public $fase_id;
    public $semestre;
    public $requisitante_id;
    public $disciplina_id;
    public $dt_aquisicao_incial;
    public $items;
    
    function setIdAquisicao($valor){
        $this->id_aquisicao = $valor;
    }
    
    function setFaseId($valor){
        $this->fase_id = $valor;
    }
    
    function setSemestre($valor){
        $this->semestre = $valor;
    }
    
    function setRequisitanteId($valor){
        $this->requisitante_id = $valor;
    }
    
    function setDisciplinaId($valor){
        $this->disciplina_id = $valor;
    }
    
    function setDtAquisicaoInicial($valor){
        $this->dt_aquisicao_incial = $valor;
    }
    
    function addItens(ItemSol $item){
        $this->items[] = $item;
    }
    
}

?>
