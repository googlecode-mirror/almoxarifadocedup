<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SolMapper
 *
 * @author Home
 */
class SolMapper {
    
    public static function map(Sol $sol, array $propriedades){
        
        if (array_key_exists('id_aquisicao',$propriedades)){
            $sol->setIdAquisicao($propriedades['id_aquisicao']);
        }
        
        if (array_key_exists('fase_id',$propriedades)){
            $sol->setFaseId($propriedades['fase_id']);
        }
        
        if (array_key_exists('semestre',$propriedades)){
            $sol->setSemestre($propriedades['semestre']);
        }
        
        if (array_key_exists('requisitante_id',$propriedades)){
            $sol->setResponsavelId($propriedades['requisitante_id']);
        }
        
        if (array_key_exists('disciplina_id',$propriedades)){
            $sol->setDisciplinaId($propriedades['disciplina_id']);
        }
        if (array_key_exists('dt_aquisicao_inicial',$propriedades)){
            $sol->setDtAquisicaoInicial($propriedades['dt_aquisicao_inicial']);
        }
        
        
    }
    
    
    public static function getCursos(){
        TTransaction::open('my_config');
        
        if ($conn = TTransaction::get()){
               $sql = "SELECT * FROM cursos";

               $sth = $conn->prepare($sql);
               $sth->execute();
               
               return $sth->fetchALL();

               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
    public static function getDisciplinas($id){
        TTransaction::open('my_config');
        
        if ($conn = TTransaction::get()){
               $sql = "SELECT * FROM disciplinas
                       WHERE curso_id = ?";

               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               return $sth->fetchALL();

               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
    public static function getFases($id){
        TTransaction::open('my_config');
        
        if ($conn = TTransaction::get()){
               $sql = "SELECT F.* FROM cursos_fases CF
                       INNER JOIN fases F ON
                       (F.id_fase = CF.fase_id)
                       WHERE CF.curso_id = ?";

               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               return $sth->fetchALL();

               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
    public static function insert(Sol $sol){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "INSERT INTO aquisicoes (fase_id,
                                               semestre,
                                               requisitante_id,
                                               disciplina_id,
                                               dt_aquisicao_inicial)
                       VALUE (?,?,?,?,?)";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($sol->fase_id,
                                   $sol->semestre,
                                   $sol->requisitante_id,
                                   $sol->disciplina_id,
                                   $sol->dt_aquisicao_incial));
               
               $lastId = $conn->lastInsertId();
               
               foreach ($sol->items as $item){
                 
                   
                    $sql = "INSERT INTO item_aquisicao (descricao_item,
                                                         quantidade_item,
                                                         aquisicao_id)
                            VALUES (?,?,?)";
                    $sth = $conn->prepare($sql);
                    $sth->execute(array($item->descricao_item,
                                        $item->quantidade_item,
                                        $lastId));

               }
               
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
    public static function getSolicitacoes(SearchCriteria $condicao = null){
         
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = "SELECT A.id_aquisicao, 
                                    U.nome_usuario,
                                    A.dt_aquisicao_inicial,
                                    A.semestre,
                                    D.nome_disciplina,
                                    F.nome,
                                    C.nome_curso FROM aquisicoes A
                        INNER JOIN usuarios U ON
                        (A.requisitante_id = U.id_usuario)
                        INNER JOIN disciplinas D ON
                        (A.disciplina_id = D.id_disciplina)
                        INNER JOIN fases F ON
                        (A.fase_id = F.id_fase)
                        INNER JOIN cursos C ON
                        (D.curso_id = C.id_curso)";
                     
               
               if ($condicao !== null){
                    if ($condicao->getValueCriteria() !== null) {
                        $sql .=" WHERE U.nome_usuario like '{$condicao->getValueCriteria()}%'";
                    }
               }
               
               $sql .= "ORDER BY id_aquisicao DESC";
                       
               $sth = $conn->prepare($sql);
               $sth->execute();
            
               return $sth->fetchALL(PDO::FETCH_OBJ);

               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
    
    public static function getItens($id){
        
        TTransaction::open('my_config');
        
        if ($conn = TTransaction::get()){
               $sql = "SELECT * FROM item_aquisicao
                       WHERE aquisicao_id = ?";

               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               return $sth->fetchALL();

               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
 
    }
    
    public static function delete($id){
        
        TTransaction::open('my_config');
        
        if ($conn = TTransaction::get()){
               $sql = "DELETE FROM item_aquisicao
                       WHERE aquisicao_id = ?";
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
                
               $sql = "DELETE FROM aquisicoes
                       WHERE id_aquisicao = ?";
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));

               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
        
        
    }
}

?>
