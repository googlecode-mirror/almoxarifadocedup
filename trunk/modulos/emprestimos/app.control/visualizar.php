<?php
    if ($sessao->getVar('msg') != null){
   
        if ($sessao->getVar('msg') == 1){
           Flash::addFlash('Empréstimo concluído.'); 
        }
        $sessao->removeVar('msg');
    }

    $id = $_GET['id'];
    $usuario = Utils::findById($id, 'usuarios', 'id_usuario');
    $itens = EmpMapper::getEmps($id);
    
    if (array_key_exists('key',$_GET)){
        
        EmpMapper::concluiEmp($_GET['key']);
        
        $sessao->addVar('msg', 1);
        header("location:index.php?modulo=emprestimos&page=visualizar&id={$_GET['id']}");
    }


?>
