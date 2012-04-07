<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TChaveIndisponivel
 *
 * @author User
 */
class TChaveIndisponivel extends TChave{
    
    protected $id_professor;
    protected $nome_professor;
    
    protected $observacoes;
    protected $dt_inicial;
    
    public function __construct($id_laboratorio,$nome_laboratorio,$numero_laboratorio,$id_professor,
            $nome_professor,$observacoes,$dt_retirada) 
    {
        $this->id_laboratorio = $id_laboratorio;
        $this->nome_laboratorio = $nome_laboratorio;
        $this->numero_laboratorio = $numero_laboratorio;

        $this->id_professor = $id_professor;
        $this->nome_professor = $nome_professor;

        $this->observacoes = $observacoes;
        $this->dt_inicial = $dt_retirada;
    }
    
    public function entregar()
    {
        include 'app.ado/DataBase.php';
        
        $sql = 'UPDATE ctrl_chaves SET dt_final=? WHERE id=?;';
        
        $db = new DataBase();
        $sth = $db->getConn()->prepare($sql);
        
        $sth->execute(array(date('Y/m/d H:i:s'),$this->id_laboratorio));  
    }
}

?>
