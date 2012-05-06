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
                   
                    if ($item->dt_final != '00/00/00 00:00:00'){
                        $data = Utils::formatDateTimeUs($item->dt_final);
                        $item->setDtFinal($data);
                    }
                   
                    $sql = "INSERT INTO itens_emprestimos (descricao_item,
                                                           quantidade_item,
                                                           dt_final,
                                                           emprestimos_id)
                            VALUES (?,?,?,?)";
                    $sth = $conn->prepare($sql);
                    $sth->execute(array($item->descricao_item,
                                        $item->quantidade_item,
                                        $item->dt_final,
                                        $lastId));

               }
               
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
        }
    }
    
    
}

?>
