<?php
    $id = $sessao->getVar('usuario')->id_usuario;
    $requisicoes = RequerirMapper::getRequisicaoById($id);
    
  

?>
