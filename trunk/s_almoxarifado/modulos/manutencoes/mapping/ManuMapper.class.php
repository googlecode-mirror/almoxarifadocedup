<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManuMapper
 *
 * @author Home
 */
class ManuMapper {
    
     public static function map(Manu $manu, array $propriedades){
         
         if (array_key_exists('id_manutencao',$propriedades)){
            $manu->setIdManutencao($propriedades['id_manutencao']);
         }
         
         if (array_key_exists('professor_id',$propriedades)){
            $manu->setProfessorId($propriedades['professor_id']);
         }
         
         if (array_key_exists('data_manutencao',$propriedades)){
            $manu->setDataManutencao($propriedades['data_manutencao']);
         }
         
         if (array_key_exists('providencia_manutencao',$propriedades)){
            $manu->setProvidenciaManutencao($propriedades['providencia_manutencao']);
         }
         
         if (array_key_exists('definitivo_manutencao',$propriedades)){
            $manu->setDefinitivoManutencao($propriedades['definitivo_manutencao']);
         }
         
         if (array_key_exists('req_manutencao_id',$propriedades)){
            $manu->setReqManutencaoId($propriedades['req_manutencao_id']);
         }
    }
    
    public static function addManu(Manu $manu){
        
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "INSERT INTO manutencoes (professor_id,
                                             data_manutencao,
                                             providencia_manutencao,
                                             definitivo_manutencao,
                                             req_manutencao_id)
                       VALUE (?,STR_TO_DATE(?,'%d/%m/%Y'),?,?,?)";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($manu->getProfessorId(),
                                   $manu->getDataManutencao(),
                                   $manu->getProvidenciaManutencao(),
                                   $manu->getDefinitivoManutencao(),
                                   $manu->getReqManutencaoId()));
               
               
               $sql = "UPDATE req_manutencao SET estado_id = 3
                       WHERE id_requisicao = ?";
               $sth = $conn->prepare($sql);
               $sth->execute(array($manu->getReqManutencaoId()));
               
               
            
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
    public static function getManuByRequisicao(Manu $manu){
        
               TTransaction::open('my_config');
               if ($conn = TTransaction::get()){
        
                    $sql = "SELECT * FROM manutencoes
                            WHERE req_manutencao_id = ?";

                    $sth = $conn->prepare($sql);
                    $sth->execute(array($manu->getReqManutencaoId()));
                    $result = $sth->fetch(PDO::FETCH_OBJ);
                    
                    return $result;
                    

                    TTransaction::close();
  
               }

    }
    
}

?>
