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

if (array_key_exists('comentario_manutencao', $_POST)){
    
    $manutencao = UTils::findById($_GET['key'], 'manutencoes', 'req_manutencao_id');

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
