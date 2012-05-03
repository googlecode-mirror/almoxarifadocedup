<?php
if (isset($_GET['key'])){
    $id = $_GET['key'];
    
    $row = Utils::findById($id, 'req_manutencao', 'id_requisicao');
    $requisicao = new Requerir();
    RequerirMapper::map($requisicao,$row);
    
    if ($requisicao->getEstadoId() != 1){
        
        $sessao->addVar('msg',2);
        header('location:index.php?modulo=manutencoes&page=my_requisicao');
    }
    
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
    
    $sessao->addVar('msg',1);
    header('location:index.php?modulo=manutencoes&page=my_requisicao');
  
}
