<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LabMapper
 *
 * @author Home
 */
class LabMapper {
    
    static function map(Lab $lab, array $propriedades){
        
        if (array_key_exists('id_laboratorio',$propriedades)){
            $lab->setIdLaboratorio($propriedades['id_laboratorio']);
        }
        
        if (array_key_exists('nome_laboratorio',$propriedades)){
            $lab->setNomeLaboratorio($propriedades['nome_laboratorio']);
        }
        
        if (array_key_exists('numero_laboratorio',$propriedades)){
            $lab->setNumeroLaboratorio($propriedades['numero_laboratorio']);
        }
        
        if (array_key_exists('chave_laboratorio',$propriedades)){
            $lab->setChaveLaboratorio($propriedades['chave_laboratorio']);
        }   
    }
    
    public static function getLabs(SearchCriteria $condicao = null){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "SELECT * FROM laboratorios
                       WHERE deleted = 0";
               
               if ($condicao !== null){
                    if ($condicao->getValueCriteria() !== null) {
                        $sql .=" AND chave_laboratorio = {$condicao->getValueCriteria()}";
                    }
               }
               
               $sql .= " ORDER BY numero_laboratorio";
                                                
               $sth = $conn->prepare($sql);
               $sth->execute();
               $results = $sth->fetchAll(PDO::FETCH_CLASS,'Lab'); 
               
               return $results;
               
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
            
        
    }
    
    public static function addLabs(Lab $lab){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "INSERT INTO laboratorios 
                       (nome_laboratorio,
                        numero_laboratorio) VALUES
                                            (?,?)";
                                                
               $sth = $conn->prepare($sql);
               $sth->execute(array($lab->nome_laboratorio,
                                   $lab->numero_laboratorio));
             
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
    
    public static function updateLab(Lab $lab){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "UPDATE Laboratorios SET nome_laboratorio=?,
                                               numero_laboratorio=?
                       WHERE id_laboratorio = ?";
               var_dump($lab);                                 
               $sth = $conn->prepare($sql);
               $sth->execute(array($lab->nome_laboratorio,
                                   $lab->numero_laboratorio,
                                   $lab->id_laboratorio));
             
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
    }
}

?>
