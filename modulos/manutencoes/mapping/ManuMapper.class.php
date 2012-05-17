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
         
         if (array_key_exists('responsavel_id',$propriedades)){
         	$manu->setResponsavelId($propriedades['responsavel_id']);
         }
         
         if (array_key_exists('data_manutencao',$propriedades)){
            $manu->setDataManutencao($propriedades['data_manutencao']);
         }
  
         if (array_key_exists('definitivo_manutencao',$propriedades)){
            $manu->setDefinitivoManutencao($propriedades['definitivo_manutencao']);
         }
         
         if (array_key_exists('providencia_manutencao',$propriedades)){
         	$manu->setProvidenciaManutencao($propriedades['providencia_manutencao']);
         }
         
         if (array_key_exists('req_manutencao_id',$propriedades)){
            $manu->setReqManutencaoId($propriedades['req_manutencao_id']);
         }
    }
    
    public static function addManu(Manu $manu){
        
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "INSERT INTO manutencoes (data_manutencao,
                                             definitivo_manutencao,
                                             req_manutencao_id)
                       VALUES (?,?,?)";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($manu->getDataManutencao(),
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
    
    public static function addProvidencia(Manu $manu){
        
               TTransaction::open('my_config');
               if ($conn = TTransaction::get()){
        
                    $sql = "INSERT INTO providencia_manu (descricao_providencia,
                    									  manutencao_id,
                    									  data_providencia,
                    									  responsavel_id)
                            VALUES (?,?,?,?)";

                    $sth = $conn->prepare($sql);
                    $sth->execute(array($manu->getProvidenciaManutencao(),
                    					$manu->getReqManutencaoId(),
                    					$manu->getDataManutencao(),
                                        $manu->getResponsavelId()));
                    
                    if ($manu->getDefinitivoManutencao() == 1){

                    	$sql = "UPDATE req_manutencao SET estado_id = 4
                    		WHERE id_requisicao = ?";
                    	$sth = $conn->prepare($sql);
                    	$sth->execute(array($manu->getReqManutencaoId()));
                    	
                    	$sql = "UPDATE manutencoes SET definitivo_manutencao = 1
                    	WHERE req_manutencao_id = ?";
                    	$sth = $conn->prepare($sql);
                    	$sth->execute(array($manu->getReqManutencaoId()));
                    	
                    }
                    
      
                    TTransaction::close();
  
               }

    }
    
}

?>
