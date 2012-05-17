<?php
$id = $_GET['key'];
$requisicao = RequerirMapper::getRequisicaoByIdRequisicao($id);
$sessao->addVar('estado',$requisicao->estado_id);

$dados = array ('nome_usuario' => array('Responsável'),
		'providencia_manutencao' => array ('Providência')
);

$validacao = ValidaFormulario($dados);

if ($validacao === true){

	if (array_key_exists('first',$_GET)){
	   
	    
	    $data = array('responsavel_id' => $sessao->getVar('usuario')->id_usuario,
	    			  'data_manutencao' => date('Y-m-d H:i:s'),
	                  'definitivo_manutencao' => $_POST['definitivo_manutencao'],
	    		      'providencia_manutencao' => $_POST['providencia_manutencao'],
	                  'req_manutencao_id' => $id);
	    
	        $manutencao = new Manu();
	        ManuMapper::map($manutencao,$data);
	        ManuMapper::addManu($manutencao);
	        ManuMapper::addProvidencia($manutencao);
	    
	    header('location:index.php?modulo=manutencoes&page=visualizar&key='.$id);
	
	   
	}else{
		
		$data = array('responsavel_id' => $sessao->getVar('usuario')->id_usuario,
				'data_manutencao' => date('Y-m-d H:i:s'),
				'definitivo_manutencao' => $_POST['definitivo_manutencao'],
				'providencia_manutencao' => $_POST['providencia_manutencao'],
				'req_manutencao_id' => $id);
		
		$manutencao = new Manu();
		ManuMapper::map($manutencao,$data);
		ManuMapper::addProvidencia($manutencao);
		
		header('location:index.php?modulo=manutencoes&page=visualizar&key'.$id);
		
	}


}else{
	if (array_key_exists('first',$_GET)){
		header('location:index.php?modulo=manutencoes&page=visualizar&first=1&key='.$_GET['key']);
	}else{
		header('location:index.php?modulo=manutencoes&page=visualizar&key='.$_GET['key']);
	}
}

if (array_key_exists('comentario_manutencao', $_POST)){
    
   $manutencao = Utils::findById($_GET['key'], 'manutencoes', 'req_manutencao_id');
        
        if ($manutencao['professor_id'] == $sessao->getVar('usuario')->id_usuario){
                
                $manu = new Manu;
                $manu->setReqManutencaoId($id);
                $manu->setComentarioManutencao($_POST['comentario_manutencao']);
                ManuMapper::addComents($manu);
           
            header('location:index.php?modulo=manutencoes&page=m-manutencoes');
        }else{
            header('location:index.php?modulo=manutencoes&page=visualizar&erro=concl');
        }
    
}




?>
