<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TProfessor
 *
 * @author User
 */
class TProfessor extends TUsuario{
        
    protected $disciplinas;
    
    
    /**
     *
     * @param $nome 
     */
    public function update($nome)
    {
            include 'app.funcoes/array_implode.php';
            include 'app.ado/DataBase.php';
            
            
            // Monta a sql de update
            $sql = 'UPDATE usuarios SET nome_usuario=? WHERE id=?;';
            
            $db = new DataBase();
            $sth = $db->getConn()->prepare($sql);
            
            $sth->execute(array($nome,$this->id));        
    }
    
    
    /**
     * deleta um professor 
     */
    public function delete()
    {
        include 'app.ado/DataBase.php';

    }
   
}

?>
