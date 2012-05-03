<?php
    $id = $sessao->getVar('usuario')->id_usuario;
    $requisicoes = RequerirMapper::getRequisicaoByResp($id);
    
?>
