<?php

$id = $_GET['key'];
$requisicao = new Requerir;
  
if ((array_key_exists('key',$_GET)) and (array_key_exists('cancel',$_GET))) {
    
    $requisicao->CancelarStatus($id);
    header("location:index.php?modulo=manutencoes&page=requerir-detail&key={$id}");

}elseif(array_key_exists('key',$_GET)){
    
    $requisicao->aprovar($id);
    header("location:index.php?modulo=manutencoes&page=requerir-detail&key={$id}");
}



?>