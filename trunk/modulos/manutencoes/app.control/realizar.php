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

}else{
            if ($requisicao->estado_id == 3){
	
		$data = array('req_manutencao_id' => $_GET['key']);
	
		$manu = new Manu;
		ManuMapper::map($manu,$data);
		$manutencao = ManuMapper::getManuByRequisicao($manu);
	
	    }
            
            if (array_key_exists('m-manu',$_GET)){
	
		$PageVoltarLista = 'm-manutencoes';
            }else{
		$PageVoltarLista = 'visualizar';
		
            }
	
            $sessao->addVar('estado',$requisicao->estado_id);
     }

?>
