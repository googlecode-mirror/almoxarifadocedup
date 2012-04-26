<?php
$id = $_GET['key'];
$requisicao = RequerirMapper::getRequisicaoByIdRequisicao($id);
$sessao->addVar('estado',$requisicao->estado_id);

if (array_key_exists('confirm',$_POST)){
    
    $data = array('professor_id' => $sessao->getVar('usuario')->id_usuario,
                  'data_manutencao' => $_POST['data_manutencao'],
                  'providencia_manutencao' => $_POST['providencia_manutencao'],
                  'definitivo_manutencao' => 0,
                  'req_manutencao_id' => $id);
                  
    
    $manutencao = new Manu();
    ManuMapper::map($manutencao,$data);
    ManuMapper::addManu($manutencao);

}




?>
