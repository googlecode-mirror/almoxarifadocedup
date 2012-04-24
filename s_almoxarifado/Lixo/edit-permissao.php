<?php

    //recupera o usuario 
$usuario = Utils::findById($_GET['key'],'usuarios','id_usuario');
    
    //checkbox
$dataBancoVetor = PermissaoMapper::getPermissoesById($_GET['key']);
foreach ($dataBancoVetor as $array){
    $dataBanco[] = $array[0];
}

    //edit - insert
for ($i=0;$i <= 14;$i++){ 
    $data[] = (isset($_POST['p'.$i])) ? $_POST['p'.$i] : 0; 
}

if (array_key_exists('save', $_POST)){

    PermissaoMapper::InsertPermissoes($_GET['key'],$data);
    $sessao->addVar('msg',2);
    header("location:index.php?modulo=usuarios&page=list-usuario&key={$_GET['key']}");
   
}


    
    
    
    


?>
