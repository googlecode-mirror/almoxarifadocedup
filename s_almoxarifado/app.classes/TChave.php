<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TChave
 *
 * @author User
 */
abstract class TChave {
    
    public $id_laboratorio;
    public $nome_laboratorio;
    public $numero_laboratorio;
    
    abstract function __construct();
}

?>
