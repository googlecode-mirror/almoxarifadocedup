<?php
/**
 * Description of RequerirMapper
 *
 * @author Home
 */
class RequerirMapper {
    
    function __construct(){
        
    }
    
    static function map(Requerir $requisicao,array $propriedades){
        
        if (array_key_exists('id_requisicao',$propriedades)){
            $requisicao->setIdRequisicao($propriedades['id_requisicao']);
        }
        
        if (array_key_exists('dt_requisicao',$propriedades)){
            $requisicao->setDtRequisicao($propriedades['dt_requisicao']);
        }
        
        if (array_key_exists('equipamento_requisicao',$propriedades)){
            $requisicao->setEquipamentoRequisicao($propriedades['equipamento_requisicao']);
        }
        
        if (array_key_exists('local_equipamento',$propriedades)){
            $requisicao->setLocalEquipamento($propriedades['local_equipamento']);
        }
        
        if (array_key_exists('defeito_requisicao',$propriedades)){
            $requisicao->setDefeitoRequisicao($propriedades['defeito_requisicao']);
        }
        
        if (array_key_exists('requisitante_id',$propriedades)){
            $requisicao->setRequisitanteId($propriedades['requisitante_id']);
        }
        
        if (array_key_exists('estado_id',$propriedades)){
            $requisicao->setEstadoId($propriedades['estado_id']);
        }
  
    }
    
    static function requisicaoInsert(Requerir $requisicao){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "INSERT INTO req_manutencao (dt_requisicao,
                                             equipamento_requisicao,
                                             local_equipamento,
                                             defeito_requisicao,
                                             requisitante_id,
                                             estado_id)
                       VALUE (STR_TO_DATE(?,'%d/%m/%Y'),?,?,?,?,?)";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($requisicao->getDtRequisicao(),
                                   $requisicao->getEquipamentoRequisicao(),
                                   $requisicao->getLocalEquipamento(),
                                   $requisicao->getDefeitoRequisicao(),
                                   $requisicao->getRequisitanteId(),
                                   $requisicao->getEstadoId()));
            
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
   
    static function getRequisicaoByResp($id){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = 'SELECT distinct R.*,U.nome_usuario,E.nome_estado_requisicao FROM req_manutencao R
               INNER JOIN manutencoes M ON
               (R.id_requisicao = M.req_manutencao_id)
               INNER JOIN usuarios U ON
               (U.id_usuario = R.requisitante_id)
               INNER JOIN estados_requisicoes E ON
               (R.estado_id = E.id_estado_requisicao)
               WHERE deleted = 0 and R.estado_id = 3 and M.responsavel_id = ?
               ORDER BY R.id_requisicao DESC';
                       
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
            
               $result = $sth->fetchALL(PDO::FETCH_OBJ);
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
    
    public static function Requisicaoupdate(Requerir $requisicao){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "UPDATE req_manutencao SET equipamento_requisicao=?,
                                           local_equipamento=?,
                                           defeito_requisicao=?
                                          
                       WHERE deleted = 0 and id_requisicao = ?";
    
               $sth = $conn->prepare($sql);
               $sth->execute(array($requisicao->getEquipamentoRequisicao(),
                                   $requisicao->getLocalEquipamento(),
                                   $requisicao->getDefeitoRequisicao(),
                                   $requisicao->getIdRequisicao()));
               
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
            }
        
    }
    
     static function requisicaoDelete(Requerir $requisicao){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "UPDATE req_manutencao SET deleted=1
                      WHERE id_requisicao = ?";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($requisicao->getIdRequisicao()));
            
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
     static function getRequisicaoByCriteria(SearchCriteria $criteria){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = 'SELECT R.*,U.nome_usuario,E.nome_estado_requisicao FROM req_manutencao R
               INNER JOIN usuarios U on
               (R.requisitante_id = U.id_usuario)
               INNER JOIN estados_requisicoes E on
               (R.estado_id = E.id_estado_requisicao)
               WHERE deleted = 0
                and R.estado_id <> 4
                and R.estado_id <> 5';
               
              if ($criteria !== null){
                    if ($criteria->getValueCriteria() !== null) {
                        $sql .=" and E.id_estado_requisicao = {$criteria->getValueCriteria()}";
                    }
               }
               
               $sql .=' ORDER BY R.id_requisicao ASC';
               
               $sth = $conn->prepare($sql);
               $sth->execute();
            
               $result = $sth->fetchALL(PDO::FETCH_OBJ);
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
    
    static function getRequisicaoByIdRequisicao($id){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = 'SELECT R.*,U.nome_usuario,E.nome_estado_requisicao FROM req_manutencao R
               INNER JOIN usuarios U on
               (R.requisitante_id = U.id_usuario)
               INNER JOIN estados_requisicoes E on
               (R.estado_id = E.id_estado_requisicao)
               WHERE deleted = 0 and R.id_requisicao = ?';
              
                       
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
            
               $result = $sth->fetch(PDO::FETCH_OBJ);
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
    
    
}

?>
