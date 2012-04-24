<?php
   $id = $sessao->getVar('usuario')->id_usuario;
   $usuario = new Usuario(); 

   if (array_key_exists('edit',$_POST)){
      
      
      $usuario->setIdUsuario($id);
      
      UsuarioMapper::map($usuario,$_POST);
      UsuarioMapper::update($usuario);
      
      Flash::addFlash('Registro Alterado');  
     
  }

   $row = Utils::findById($id,'usuarios','id_usuario');
   UsuarioMapper::map($usuario,$row);
   
   
?>
