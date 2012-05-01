<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchCritera
 *
 * @author Home
 */
class SearchCriteria {
    
    private $value;
    
    function __construct(){
           
    }
    
    
    function setValueCriteria($value){
        $this->value = $value;
    }
    
    function getValueCriteria(){
        return $this->value;
    }
}

?>
