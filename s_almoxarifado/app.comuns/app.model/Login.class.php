<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginModel
 *
 * @author Home
 */
class Login {
    
    /** @var string */
    private $usuario;
    /** @var string */
    private $senha;
    
    function __construct(){
     
    }
   
    /**
    * @param nome usuario
    */
    function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    
     /**
    * @return string
    */
    function getUsuario(){
        return $this->usuario;
    }
    
    /**
    * @param senha_usuario
    */
    function setSenha($senha){
        $this->senha = $senha;
    }
    
     /**
    * @return string
    */
    function getSenha(){
        return $this->senha;
    }
 
}

?>
