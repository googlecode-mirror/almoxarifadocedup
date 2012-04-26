<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permissao
 *
 * @author Jomaro
 */
class Permissao {
    //put your code here
    public $modulo;
    
    public $script;
    
    public function __construct($modulo,$script)
    {
        $this->modulo = $modulo;
        $this->script = $script;
    }
}

?>
