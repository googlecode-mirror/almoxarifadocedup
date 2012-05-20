<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemSolMapper
 *
 * @author Home
 */
class ItemSolMapper {
    public static function map(ItemSol $item, array $propriedades){
        
        if (array_key_exists('id_item',$propriedades)){
            $item->setIdItem($propriedades['id_item']);
        }
        
        if (array_key_exists('descricao_item',$propriedades)){
            $item->setDescricaoItem($propriedades['descricao_item']);
        }
        
        if (array_key_exists('quantidade_item',$propriedades)){
            $item->setQuantidadeItem($propriedades['quantidade_item']);
        }
        
        if (array_key_exists('dt_requisicao',$propriedades)){
            $item->setDtRequisicao($propriedades['dt_requisicao']);
        }
        
        if (array_key_exists('dt_recebimento',$propriedades)){
            $item->setDtRecebimento($propriedades['dt_recebimento']);
        }
        
        if (array_key_exists('aquisicao_id',$propriedades)){
            $item->setAquisicaoId($propriedades['aquisicao_id']);
        }
    }
}

?>
