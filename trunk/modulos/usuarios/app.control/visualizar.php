<?php
 $criteria = new SearchCriteria();
    
    if (array_key_exists('busca',$_POST)){
        $criteria->setValueCriteria($_POST['CampoBusca']);
    }
 
  $usuarios = UsuarioMapper::getUsuarios($criteria);
  $sessao->addVar('usuarios',$usuarios);
 
  if (array_key_exists('empCancel',$_GET)){
      $sessao->removeVar('mat');
  }
  
  if ($sessao->getVar('msg') != null){
    
    if ($sessao->getVar('msg') == 1){
        Flash::addFlash('Usuário alterado.');
        
    }elseif ($sessao->getVar('msg') == 2){
        Flash::addFlash('Permissão alterada.');

    }elseif ($sessao->getVar('msg') == 3){
        Flash::addFlash('Empréstimo salvo com sucesso.');

    }elseif ($sessao->getVar('msg') == 4){
        Flash::addFlash("Usuário excluído"); 
    }
    
   $sessao->removeVar('msg'); 
}


?>
