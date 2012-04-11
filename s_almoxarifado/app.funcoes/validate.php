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
    if(isset($sessao->session))
    {
        // verifica se o endereço está correto
        if(end($path) == 'index.php')
        {
            // verifica se a pessoa esta tentando se logar novamente
            if($_GET['class'] == 'login')
            {
                header('location: index.php');
            }
            
        }
        else
        {
            header('location: index.php');
        }
        
        
    }
    else
    {
        // redireciona o usuario que não está logado para a pagina de login
        if(!((end($path) == 'index.php') and ($_GET['page'] == 'login'))) 
        { header('location: index.php?class=login'); }
    }
}

?>
