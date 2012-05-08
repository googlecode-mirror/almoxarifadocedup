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
            $valida = false;

            if(isset($permissoes[$_GET['modulo']]))
            {
                if(in_array($_GET['page'],$permissoes[$_GET['modulo']])) $valida = true;
                
            }
            
            if(!$valida)
            {
                // se o usuario não tem permissao redireciona pra pagina principal
                // sessão para indicar que dever ser mostrado a menssagem de não permitido
                $sessao = new TSessao(true);
                $sessao->addVar('msg1',5);
                header('location: index.php');
            }
            return $valida;
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
