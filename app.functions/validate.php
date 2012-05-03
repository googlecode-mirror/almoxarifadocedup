<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validate()
{
    // obtem o nome do arquivo que está sendo acessado
    $path = explode("/",$_SERVER['SCRIPT_NAME']);
    
    
    // verifica se o usuario está logado
    if(isset($sessao->session['usuario']))
    {
        // verifica se o endereço está correto
        if(end($path) == 'index.php')
        {
            // impede a pessoa de se logar novamente
            if($_GET['page'] == 'login')
            {
                header('location: index.php');
            }
            
        }
                
        if($sessao->getVar('usuario'))
        {
            $user = $sessao->getVar('usuario');
            
            $permissoes = $user->getPermissoes();
            
            $valida = false;
            
            foreach($permissoes as $permissao)
            {
                if(($permissao->modulo = $_GET['modulo']) && ($permissao->script = $_GET['page']))
                {
                    $valida = true;
                }
            }
            
            if(!valida)
            {
                header('location: index.php');
            }
        }
    }
    else
    {
        // redireciona o usuario que não está logado para a pagina de login
        if(!((end($path) == 'index.php') and ($_GET['class'] == 'login'))) 
        { header('location: index.php'); }
    }
}

?>
