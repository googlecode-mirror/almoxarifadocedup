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

?>
