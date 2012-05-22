<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmpMapper
 *
 * @author Home
 */
class EmpMapper {
    
    public static function map(Emp $emp, array $propriedades){
        
        if (array_key_exists('id_emprestimo',$propriedades)){
            $emp->setIdEmprestimo($propriedades['id_emprestimo']);
        }
        
        if (array_key_exists('dt_inicial_emprestimo',$propriedades)){
            $emp->setDtInicialEmprestimo($propriedades['dt_inicial_emprestimo']);
        }
        
        if (array_key_exists('requisitante_id',$propriedades)){
            $emp->setRequisitanteId($propriedades['requisitante_id']);
        }
        
        if (array_key_exists('usuario_id',$propriedades)){
            $emp->setUsuarioId($propriedades['usuario_id']);
        }
        
    }
    
    public static function insert(Emp $emp){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "INSERT INTO emprestimos (dt_inicial_emprestimo,
                                                requisitante_id,
                                                usuario_id)
                       VALUE (?,?,?)";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($emp->dt_inicial_emprestimo,
                                   $emp->requisitante_id,
                                   $emp->usuario_id));
               
               $lastId = $conn->lastInsertId();
               
               foreach ($emp->items as $item){
                    if ($item->dt_final == null){
                        $entregue = 1;
                    }else{
                        $entregue = 0;
                    }

                    $sql = "INSERT INTO itens_emprestimos (descricao_item,
                                                           quantidade_item,
                                                           dt_final,
                                                           emprestimos_id,
                                                           entregue
                                                           )
                            VALUES (?,?,?,?,?)";
                    $sth = $conn->prepare($sql);
                    $sth->execute(array($item->descricao_item,
                                        $item->quantidade_item,
                                        $item->dt_final,
                                        $lastId,
                                        $entregue));

               }
               
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
    public static function getEmps($id){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "SELECT I.* FROM itens_emprestimos I
                       INNER JOIN emprestimos E ON
                       E.id_emprestimo = I.emprestimos_id
                       WHERE E.requisitante_id = ? AND
                       I.dt_final <> '' and entregue = 0";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               return $sth->fetchAll(PDO::FETCH_CLASS,'Item');
               
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
        public static function concluiEmp($id){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "UPDATE itens_emprestimos SET entregue = 1
                       WHERE id_item = ?";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));        
               
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }

    }

}

?>
