<?php
  $criteria = new SearchCriteria();
    
    if (array_key_exists('busca',$_POST)){
        $criteria->setValueCriteria($_POST['CampoBusca']);
    }
 
  $usuarios = UsuarioMapper::getUsuarios($criteria);
  
  if (array_key_exists('empCancel',$_GET)){
      $sessao->removeVar('mat');
  }
  
  if (array_key_exists('empOk',$_GET)){
      Flash::addFlash('Empréstimo salvo com sucesso.');
  }
?>
