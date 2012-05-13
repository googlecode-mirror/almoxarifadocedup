<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validate
 * Validação de campos
 * @author Home
 */
class Validate {
    
   private $campo;
   private $erros;
   
   function setCampos($nome,$valor){
       $this->campo = array ('nome' =>$nome,
                        'valor' => $valor);
   }
   
   function comum(){
       if (empty($this->campo['valor'])){
           $this->erros[]= $this->campo['nome'].' não pode ser vazio.';
       } 
   }
   
   function email(){
       if (!filter_var($this->campo['valor'], FILTER_VALIDATE_EMAIL)) {
           $this->erros[] = $this->campo['nome'].' é um email inválido.';
       }
   }
   
   function valida(){
       if (count($this->erros) > 0){
           return false;
       }else{
           return true;
       }
   }
   
   function getErros(){
       return $this->erros;
   }
 
}

?>
