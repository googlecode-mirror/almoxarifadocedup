<?php
$id = $_GET['key'];
$requisicao = RequerirMapper::getRequisicaoByIdRequisicao($id);
$sessao->addVar('estado',$requisicao->estado_id);

if (array_key_exists('confirm',$_POST)){
    
    
    
    
}


?>
