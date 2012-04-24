<?php
  if (isset($_GET['key'])){
    $id = $_GET['key'];
  }else{
    $id = $sessao->getVar('usuario')->id_usuario;
  }

    $usuario = new Usuario();
    $row = Utils::findById($id,'usuarios','id_usuario');
    UsuarioMapper::map($usuario,$row);

  
   if (array_key_exists('edit',$_POST)){
      
      $objectUsuario = new Usuario();
      $objectUsuario->setIdUsuario($id);
      
      UsuarioMapper::map($objectUsuario,$_POST);
      UsuarioMapper::update($objectUsuario);
      
      $sessao->addVar('msg',1);
      header('location:index.php?modulo=usuarios&page=list-usuario');
      
  }
  


?>
