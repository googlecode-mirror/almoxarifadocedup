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
class TChaveDisponivel {
    
    public $id_laboratorio;
    public $nome_laboratorio;
    public $numero_laboratorio;

    public function __construct($id,$nome,$numero) {
        $this->id_laboratorio = $id;
        $this->nome_laboratorio = $nome;
        $this->numero_laboratorio = $numero;
    }
    
    public function encerrar()
    {
        $sql = 'UPDATE ctrl_chaves SET dt_devolucao=? WHERE id=?;';
        
        $sth = $db->prepare($sql);
        
        $sth->execute(array(date('Y/m/d H:i:s'),$this->id_laboratorio));
        
    }
    
}

?>
