<?php
$id = $_GET['key'];

$requisicao = RequerirMapper::getRequisicaoByIdRequisicao($id);
    
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
?>
