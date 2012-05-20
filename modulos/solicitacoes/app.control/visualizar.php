<?php
    if (isset($_POST['val'])){
        $itens = SolMapper::getItens($_POST['val']);
        echo json_encode($itens);
    }


   $criteria = new SearchCriteria();
    
    if (array_key_exists('busca',$_POST)){
        $criteria->setValueCriteria($_POST['CampoBusca']);
    }
 
  $solicitacoes = SolMapper::getSolicitacoes($criteria);

  if ($sessao->getVar('msg') != null){
    
    if ($sessao->getVar('msg') == '2'){
        Flash::addFlash('Solicitação excluida!');
    }  
      
    if ($sessao->getVar('msg') == '3'){
        Flash::addFlash('Solicitação registrada!');
    }
    
    $sessao->removeVar('msg');
}
?>
