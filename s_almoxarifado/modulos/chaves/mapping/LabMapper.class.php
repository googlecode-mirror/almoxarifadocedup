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
               $results = $sth->fetchALL(); 
               
               foreach ($results as $result){
                   $lab = new Lab();
                   self::map($lab,$result);
                   $objs[] = $lab;
                   
               }
               return $objs;
               
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
            
        
    }
}

?>
