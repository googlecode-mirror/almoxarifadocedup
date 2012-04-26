<?php
$permissoes = PermissaoMapper::getPermissoes();
$modulos = PermissaoMapper::getModulos();
$modulos_permissoes = PermissaoMapper::getModulo_Permissoes();
    
    //recupera o usuario 
$usuario = Utils::findById($_GET['key'],'usuarios','id_usuario');
    
    //recupera as pemissões do usuario
$dataBancoVetor = PermissaoMapper::getPermissoesById($_GET['key']);
    
    // transforma o ventor em array
foreach ($dataBancoVetor as $array){
    $dataBanco[] = $array[0];
}
    //edit - insert
if (array_key_exists('save', $_POST)){
    $count = $_POST['count'];
    
    for ($i=1;$i <= $count;$i++){ 
        $data[] = (isset($_POST['p'.$i])) ? $_POST['p'.$i] : 0; 
    }
  

    PermissaoMapper::InsertPermissoes($_GET['key'],$data,$count);
    $sessao->addVar('msg',2);
    header("location:index.php?modulo=usuarios&page=visualizar&key={$_GET['key']}");
   
}


?>