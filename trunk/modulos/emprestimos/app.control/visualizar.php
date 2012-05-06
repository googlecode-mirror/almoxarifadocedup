<?php
    $id = $_GET['id'];
    $usuario = Utils::findById($id, 'usuarios', 'id_usuario');
    
    $itens = EmpMapper::getEmps($id);

?>
