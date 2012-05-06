<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemMapper
 *
 * @author Home
 */
class ItemMapper {
    
    public static function map(Item $item, array $propriedades){
        
        if (array_key_exists('id_emprestimo',$propriedades)){
            $item->setIdItem($propriedades['id_emprestimo']);
        }
        
        if (array_key_exists('descricao_item',$propriedades)){
            $item->setDescricaoItem($propriedades['descricao_item']);
        }
        
        if (array_key_exists('quantidade_item',$propriedades)){
            $item->setQuantidadeItem($propriedades['quantidade_item']);
        }
        
        if (array_key_exists('dt_final',$propriedades)){
            $item->setDtFinal($propriedades['dt_final']);
        }
        
        if (array_key_exists('emprestimo_id',$propriedades)){
            $item->setEmprestimoId($propriedades['emprestimo_id']);
        }
    }
    
   
}

?>
