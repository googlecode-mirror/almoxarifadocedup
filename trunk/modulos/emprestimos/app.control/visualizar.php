<?php
    $id = $_GET['key'];
    $usuario = Utils::findById($id, 'usuarios', 'id_usuario');
    $itens = EmpMapper::getEmps($id);
    
     if ($sessao->getVar('msg') != null){
   
        if ($sessao->getVar('msg') == 1){
           Flash::addFlash('Empréstimo concluído.');
           $sessao->removeVar('msg');
        }
        
    }
    
    


?>
