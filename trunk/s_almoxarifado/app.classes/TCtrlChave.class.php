<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TCtrlChave
 *
 * @author Jomaro
 */
class TCtrlChave {

    public function getDisponiveis()
    {
        include 'app.ado/DataBase.php';
        include 'TChaveDisponivel.class.php';
        
        $db = new DataBase();
        $chaves = array();
        
        $chavesDisponiveis = $db->query('SELECT id_laboratorio,numero_laboratorio,nome_laboratotiro FROM laboratorios WHERE chave_laboratorio=0;')->fetchALL(PDO::FETCH_ASSOC);
        
        foreach ($chavesDisponiveis as $value) {
            $chaves[] = new TChaveDisponivel($value['id_laboratorio'],$value['nome_laboratorio'],$value['numero_laboratorio']);
        }
        
        return $chaves;
    }
    
    public function getIndisponiveis()
    {
        include 'app.ado/DataBase.php';
        include 'TChaveIndisponivel.class.php';
        
        $db = new DataBase();

        $chaves = array();
        
        $sql = 'SELECT 
    c.professor_id,c.laboratorio_id,c.observacoes,c.hr_inicial,
    l.nome_laboratorio,l.numero_laboratorio, u.nome_usuario
FROM ctrl_chaves c, laboratorios l, usuarios u 
WHERE c.laboratorio_id=l.id_laboratorio AND c.professor_id=u.id_usuario AND c.hr_final IS NULL;';
        
        $chavesIndisponiveis = $db->query($sql)->fetchALL(PDO::FETCH_ASSOC);
        
        foreach ($chavesIndisponiveis as $values)
        {
            $chaves[] = new TChaveIndisponivel($values['c.laboratorio_id'],
                                               $values['l.nome_laboratorio'],
                                               $values['l.numero_laboratorio'],
                                               $values['c.professor_id'],
                                               $values['u.nome_usuario'],
                                               $values['c.observacoes'],
                                               $values['u.nome_usuario']);
        }
        
        return $chaves;
    }

    public function update()
    {
        
    }
    
    public function reload()
    {
        
    }
    
}

?>
