<?php

$estados = Utils::getAll('estados_requisicoes');
$criteria = new SearchCriteria();

if ((isset($_POST['busca'])) and $_POST['estadoBusca'] != 'todos') {
  
      $criteria->setValueCriteria($_POST['estadoBusca']);

}else if (($sessao->getVar('estado') != null) and array_key_exists('estado',$_GET)){
      
      $criteria->setValueCriteria($sessao->getVar('estado')); 
      $sessao->removeVar('estado');
 
}
    
$requisicoes = RequerirMapper::getRequisicaoByCriteria($criteria);

if (array_key_exists('erro',$_GET)){
    if ($_GET['erro'] == 'concl'){
        Flash::addFlash('Você não pode concluir esta manutencão.');
    }
}

if ($sessao->getVar('msg') != null){
    
    if ($sessao->getVar('msg') == '1'){
        Flash::addFlash('Requisição registrada!');
    }
    
    if ($sessao->getVar('msg') == '2'){
        Flash::addFlash('Requisição alterada!');
    }
    
    if ($sessao->getVar('msg') == '3'){
        Flash::addFlash('Você não pode editar/deletar esta requisição!');
    }
    
    if ($sessao->getVar('msg') == '4'){
        Flash::addFlash('Requisição excluída.');
    }
    
    $sessao->removeVar('msg');
}


?>
