<?php

    if (isset($_GET['key'])){

        $id = $_GET['key'];
        $row = Utils::findById($id, 'req_manutencao', 'id_requisicao');
        $requisicao = new Requerir();
        $requisicao->setIdRequisicao($id);
        RequerirMapper::map($requisicao,$row);
        
            
            if ($requisicao->getRequisitanteId() != $sessao->getVar('usuario')->id_usuario){
                $sessao->addVar('msg',2);
                header('location:index.php?modulo=manutencoes&page=requerir-visualizar');
                
            }else{
        
                
                RequerirMapper::RequisicaoDelete($requisicao);

                $sessao->addVar('msg',1);
                header('location:index.php?modulo=manutencoes&page=requerir-visualizar');
        
            }
    
    }


?>
