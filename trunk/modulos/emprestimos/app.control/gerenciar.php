<?php
    
    if (array_key_exists('id',$_GET)){
        
        EmpMapper::concluiEmp($_GET['id']);
        
        $sessao->addVar('msg', 1);
        header("location:index.php?modulo=emprestimos&page=visualizar&key={$_GET['key']}");
    }
 
   
?>
