<?php

class ItemSol {
    
    public $id_item;
    public $descricao_item;
    public $quantidade_item;
    public $dt_requisicao_item;
    public $dt_recebimento_item;
    public $aquisicao_id; 

    function setIdItem($valor){
        $this->id_item = $valor;
    }
    
    function setDescricaoItem($valor){
        $this->descricao_item = $valor;
    }
    
    function setQuantidadeItem($valor){
        $this->quantidade_item = $valor;
    }
    
    function setDtRequisicao($valor){
        $this->dt_requisicao_item = $valor;
    }
    
    function setDtRecebimento($valor){
        $this->dt_recebimento_item = $valor;
    }
    
    function setAquisicaoId($valor){
        $this->aquisicao_id = $valor;
    }
    
    
    
}

?>
