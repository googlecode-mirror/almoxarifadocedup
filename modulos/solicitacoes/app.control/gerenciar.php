<?php

  if (array_key_exists('delete-key',$_GET)){
      
      SolMapper::delete($_GET['delete-key']);
      $sessao->addVar('msg', 2);
      header('location:index.php?modulo=solicitacoes&page=visualizar');
  }
  
?>
