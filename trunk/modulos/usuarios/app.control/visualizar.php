<?php
  $criteria = new SearchCriteria();
    
    if (array_key_exists('busca',$_POST)){
        $criteria->setValueCriteria($_POST['CampoBusca']);
    }
 
  $usuarios = UsuarioMapper::getUsuarios($criteria);
?>
