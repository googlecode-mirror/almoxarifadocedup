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
class TProfessor {
        
    /**
     *
     * @param array $array = array dos valores indexados pelos campos 
     * 
     * array(3) {
     *  ["id_professor"]=>
     *  int(5)
     *  ["nome_professor"]=>
     *  string(4) "joao"
     *  ["dt_nascimento"]=>
     *  string(10) "14/02/1980"
     *} 
     */
    public function update(array $array)
    {
            include 'app.funcoes/array_implode.php';
            include 'app.ado/DataBase.php';
            
            
            // Monta a sql de update
            $sql = 'UPDATE usuarios SET '.array_implode('=',',',$array).' WHERE id=?;';
            
            $db = new DataBase();
            $db->getConn()->prepare($sql);
            
            $db->getConn()->execute(array($this->id));        
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
