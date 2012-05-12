<?php
$estados = Utils::getAll('estados_requisicoes');
$criteria = new SearchCriteria();

if ((isset($_POST['busca'])) and $_POST['estadoBusca'] != 'todos') {
  
      $criteria->setValueCriteria($_POST['estadoBusca']);

}else if (($sessao->getVar('estado') != null) and array_key_exists('estado',$_GET)){
      
      $criteria->setValueCriteria($sessao->getVar('estado')); 
}
    
$requisicoes = RequerirMapper::getRequisicaoByCriteria($criteria);
if (array_key_exists('erro',$_GET)){
    if ($_GET['erro'] == 'concl'){
        Flash::addFlash('Você não pode concluir esta manutencão, pois ela não é sua.');
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
        Flash::addFlash('Você não pode editar/deletar requisições de outros usuários!');
    }
    
    if ($sessao->getVar('msg') == '4'){
        Flash::addFlash('Requisição excluída.');
    }
    
    $sessao->removeVar('msg');
}

if (array_key_exists('key',$_GET)){
	
	$page = 'requerir-detail';
	$id = $_GET['key'];
	
	$requisicao = RequerirMapper::getRequisicaoByIdRequisicao($id);
        $sessao->addVar('estado',$requisicao->estado_id);
	
	if ($requisicao->estado_id == 3){
	
		$data = array('req_manutencao_id' => $id);
	
		$manu = new Manu;
		ManuMapper::map($manu,$data);
		$manutencao = ManuMapper::getManuByRequisicao($manu);
	
		$usuario = UTils::findById($manutencao->professor_id, 'usuarios', 'id_usuario');
	
	}
	
	if (array_key_exists('m-manu',$_GET)){
	
		$PageVoltarLista = 'm-manutencoes';
	}else{
		$PageVoltarLista = 'visualizar';
		
	}
	
	$sessao->addVar('estado',$requisicao->estado_id);

}

if (array_key_exists('req-key',$_GET)){

	$id = $_GET['req-key'];
	$row = Utils::findById($id, 'req_manutencao', 'id_requisicao');
	$requisicao = new Requerir();
	$requisicao->setIdRequisicao($id);
	RequerirMapper::map($requisicao,$row);


	if ($requisicao->getRequisitanteId() != $sessao->getVar('usuario')->id_usuario){
		$sessao->addVar('msg',3);
		header('location:index.php?modulo=manutencoes&page=visualizar');

	}else{

		RequerirMapper::RequisicaoDelete($requisicao);
		$sessao->addVar('msg',4);
		header('location:index.php?modulo=manutencoes&page=visualizar');

	}

}






?>
