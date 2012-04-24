<?php

if (array_key_exists('key',$_GET)) {
    
    $id = $_GET['key'];

    $requisicao = new Requerir;
    $requisicao->negar($id);
    
    header("location:index.php?modulo=manutencoes&page=requerir-detail&key={$id}");

}
?>
