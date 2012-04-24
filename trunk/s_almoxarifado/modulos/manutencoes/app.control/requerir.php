<?php

if (array_key_exists('key',$_GET)){
    
    $id = $_GET['key'];
    
    $requisicoes = UTils::findById($id,'req_manutencao','id_requisicao');
    
}




if (array_key_exists('save',$_POST)){
    $data = array(
        'dt_requisicao' => $_POST['dt_requisicao'],
        'equipamento_requisicao' => $_POST['equipamento_requisicao'],
        'local_equipamento' => $_POST['local_equipamento'],
        'defeito_requisicao' => $_POST['defeito_requisicao'],
        'requisitante_id' => $sessao->getVar('usuario')->id_usuario,
        'estado_id' => '1',
    );

    $requisicao = new Requerir();
    RequerirMapper::map($requisicao,$data);
    RequerirMapper::RequisicaoInsert($requisicao);
    
    $sessao->addVar('msg',1);
  
}

if (array_key_exists('update',$_POST)){
    $data = array(
        'dt_requisicao' => $_POST['dt_requisicao'],
        'equipamento_requisicao' => $_POST['equipamento_requisicao'],
        'local_equipamento' => $_POST['local_equipamento'],
        'defeito_requisicao' => $_POST['defeito_requisicao'],
        'requisitante_id' => $sessao->getVar('usuario')->id_usuario,
        'estado_id' => '1',
    );
    
    $requisicao = new Requerir();
    $requisicao->setIdRequisicao($id);
    RequerirMapper::map($requisicao,$data);
    RequerirMapper::RequisicaoUpdate($requisicao);
    
    $sessao->addVar('msg',3);
    header('location:index.php?modulo=manutencoes&page=requerir-visualizar');
  
}




?>