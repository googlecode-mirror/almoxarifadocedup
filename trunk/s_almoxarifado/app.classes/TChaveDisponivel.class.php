<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TChaveDisponivel
 *
 * @author User
 */
class TChaveDisponivel extends TChave{
    
    public function __construct($id,$nome,$numero) {
        $this->id_laboratorio = $id;
        $this->nome_laboratorio = $nome;
        $this->numero_laboratorio = $numero;
    }
    
    public function emprestar($professor_id,$observações)
    {
        $sql = 'INSERT INTO ctrl_chaves (professor_id,laboratorio_id,observacoes,dt_inicial) 
                VALUES (?,?,?,?);';
        
        $db = new DataBase();
        $sth = $db->getConn()->prepare($sql);
        
        $sth->execute(array($professor_id,  $this->id_laboratorio,$observações,date('Y/d/m H:i:s')));
    }
    
    
}

?>
