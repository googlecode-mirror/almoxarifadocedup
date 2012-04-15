<?php
/*
 * To change this template, choose Tools | Templates
 */
if($_POST['login'] and $_POST['senha'])
{
    $db = new DataBase();
    $sql = 'select 
    id_usuario as id,
    nome_usuario as nome,
    login_usuario as login,
    senha_usuario as senha
from usuarios
where login_usuario like ? and senha_usuario like ?;';
    $cmd = $db->getConn()->prepare($sql);
    $cmd->execute(array($_POST['login'],$_POST['senha']));
    $s_user = $cmd->fetch(PDO::FETCH_OBJ);
    $db = null;
    
    $user = new TUsuario($s_user->id,$s_user->nome);
    $user->setLogin($s_user->login,$s_user->senha);
    $user->loadPermissao();
    $user->loadDisciplina();
    
    if($user)
    {
        include 'app.classes/Sessao.php';
        $sessao = new Sessao(true);
        $sessao->addVar('user',$user);
    }
    var_dump($_SESSION);
    
    //header('location: index.php');
}
else
{
    header('location: index.php');
}

?>
