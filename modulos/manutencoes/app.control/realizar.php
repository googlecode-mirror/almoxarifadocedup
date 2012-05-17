<?php
$id = $_GET['key'];
$requisicao = RequerirMapper::getRequisicaoByIdRequisicao($id);
$sessao->addVar('estado',$requisicao->estado_id);

$dados = array ('nome_usuario' => array('Responsável'),
		'providencia_manutencao' => array ('Providência')
);

$page = 'requerir-detail';

$validacao = ValidaFormulario($dados);

if ($validacao === true){

	if (array_key_exists('key',$_GET)){
	   
	    
	    $data = array('responsavel_id' => $sessao->getVar('usuario')->id_usuario,
	    	          'data_manutencao' => date('Y-m-d H:i:s'),
	                  'definitivo_manutencao' => $_POST['definitivo_manutencao'],
                          'providencia_manutencao' => $_POST['providencia_manutencao'],
	                  'req_manutencao_id' => $id);
	    
	        $manutencao = new Manu();
	        ManuMapper::map($manutencao,$data);
	        ManuMapper::addManu($manutencao);
	    
            $sessao->addVar('msg','2');
	    header('location:index.php?modulo=manutencoes&page=visualizar&key='.$id);
	
        }  
//	else{
//		
//		$data = array('responsavel_id' => $sessao->getVar('usuario')->id_usuario,
//				'data_manutencao' => date('Y-m-d H:i:s'),
//				'definitivo_manutencao' => $_POST['definitivo_manutencao'],
//				'providencia_manutencao' => $_POST['providencia_manutencao'],
//				'req_manutencao_id' => $id);
//		
//		$manutencao = new Manu();
//		ManuMapper::map($manutencao,$data);
//		
//                $sessao->addVar('msg','2');
//		header('location:index.php?modulo=manutencoes&page=visualizar&key='.$id);	
//	}
}

?>
