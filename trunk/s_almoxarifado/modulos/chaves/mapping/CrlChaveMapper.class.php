<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrlChaveMapper
 *
 * @author Home
 */
class CrlChaveMapper {
    
    static function map (CrlChave $ch, array $propriedades){
        
        if (array_key_exists('id_controle',$propriedades)){
            $ch->setIdCrontrole($propriedades['id_controle']);
        }
        
        if (array_key_exists('professor_id',$propriedades)){
            $ch->setProfessorId($propriedades['professor_id']);
        }
        
        if (array_key_exists('laboratorio_id',$propriedades)){
            $ch->setLaboratorioId($propriedades['laboratorio_id']);
        }
        
        if (array_key_exists('observacao_controle',$propriedades)){
            $ch->setObservacaoControle($propriedades['observacao_controle']);
        }
        
        if (array_key_exists('dt_inicial_controle',$propriedades)){
            $ch->setDtInicialControle($propriedades['dt_inicial_controle']);
        }
        
        if (array_key_exists('dt_final_controle',$propriedades)){
            $ch->setDtFinalControle($propriedades['dt_final_controle']);
        }
    }
    
    static function addCrlChave(CrlChave $ch){
        TTransaction::open('my_config');
        
        if ($conn = TTransaction::get()){
               $sql = "INSERT INTO ctrl_chaves
                                 (professor_id,
                                  laboratorio_id,
                                  observacao_controle,
                                  dt_inicial_controle) VALUES
                                                               (?,?,?,?)";
                                                
               $sth = $conn->prepare($sql);
               $sth->execute(array($ch->getProfessorId(),
                                   $ch->getLaboratorioId(),
                                   $ch->getObservacaoControle(),
                                   $ch->getDtInicialControle()));
               
               $sql = "UPDATE laboratorios SET chave_laboratorio=1
                       WHERE id_laboratorio = ?";
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($ch->getLaboratorioId()));
               
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
            
    }
}

?>
