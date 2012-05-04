<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validate($usuario)
{
    // verifica se o usuario está logado
    if($usuario)
    {          
        if($_GET)
        {
            $permissoes = $usuario->permissoes;
            
            //$valida = false;

            if(isset($permissoes[$_GET['modulo']]))
            {
                if(in_array($_GET['page'],$permissoes[$_GET['modulo']])) $valida = true;
                
            }
            
            if(!$valida)
            {
                // se o usuario não tem permissao redireciona pra pagina principal
                header('location: index.php');
            }
        }
    }
    else
    {
        // redireciona o usuario que não está logado para a pagina de login pra não exibir nada no get
        if($_GET != null) 
           header('location: index.php');
    }
}

?>
