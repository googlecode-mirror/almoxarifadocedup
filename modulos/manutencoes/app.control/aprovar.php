<?php

$id = $_GET['key'];
$requisicao = new Requerir;

    
  
        if ((array_key_exists('key',$_GET)) and (array_key_exists('cancel',$_GET))) {

            $requisicao->CancelarStatus($id);
            $sessao->addVar('msg',2);
            header("location:index.php?modulo=manutencoes&page=visualizar");

        }elseif (array_key_exists('negar',$_GET)){

            $requisicao->negar($id);
            $sessao->addVar('msg',2);
            header("location:index.php?modulo=manutencoes&page=visualizar");


        }elseif(array_key_exists('key',$_GET)){

            $requisicao->aprovar($id);
            $sessao->addVar('msg',2);
            header("location:index.php?modulo=manutencoes&page=visualizar");
        }
   
?>
