<?php
  /**
   * var responsável por popular o <SELECT> 
   */  
  $tipos_usuarios = Usuario::allTipos();

  if (array_key_exists('save',$_POST)){
      
     $usuario = new Usuario();
     UsuarioMapper::map($usuario,$_POST);
     
     if (($_POST['celular_usuario']) == ''){
         $usuario->setCelularUsuario(null);
         
     }
     
     UsuarioMapper::insert($usuario);
     
     $sessao->addVar('msg',2);
     header('location:index.php');

  }
  
?>
