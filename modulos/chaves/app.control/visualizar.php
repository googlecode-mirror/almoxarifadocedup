<?php
    $laboratorios = LabMapper::getLabs();
    
    if (array_key_exists('labkey',$_GET)){
    	
    	$page = 'chave-detail';
    
	    $ch = Utils::findById($_GET['labkey'], 'ctrl_chaves', 'laboratorio_id');
	    $lab = Utils::findById($_GET['labkey'], 'laboratorios', 'id_laboratorio');
	    $user = Utils::findById($ch['professor_id'], 'usuarios', 'id_usuario');
	    $data_hora = explode(' ',$ch['dt_inicial_controle']);

    }
?>
