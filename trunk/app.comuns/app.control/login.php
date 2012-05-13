<?php

 if (isset($_GET['logout'])){
     $sessao->removeVar('usuario');
     header('location:index.php');
 }   

 
 if (array_key_exists('check',$_POST)) {  
    
    $login = new Login();
    LoginMapper::map($login,$_POST); 
    LoginMapper::autenticar($login);
    
 }
 
?>
