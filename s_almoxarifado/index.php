<?php
include 'app.classes/Sessao.php';
include 'app.functions/validate.php';

var_dump($_SESSION);

if(!$_GET['class']=='login')
    $sessao = new Sessao();

//validate();

function __autoload($classe)
{
	   $pastas = array('app.widgets', 'app.ado', 'app.functions', 'app.actions','app.classes');
	   foreach ($pastas as $pasta)
	   {
		      if (file_exists("{$pasta}/{$classe}.class.php"))
                      {
			         include_once "{$pasta}/{$classe}.class.php";
                                 break;
		      }
                      if (file_exists("{$pasta}/{$classe}.{$_GET['type']}.php"))
                      {
			         include_once "{$pasta}/{$classe}.{$_GET['type']}.php";
                                 break;
		      }
	   }
}

var_dump($_GET);

 if(isset($_GET['type']) and $_GET['type']=='action')
 {
     if(file_exists("app.actions/{$_GET['class']}.action.php"))
          include_once "app.actions/{$_GET['class']}.action.php";
 }     
 else
 {     
    if(!$_GET) $_GET['class'] = 'Principal';

    // se está na página de login, carrega a pagina de login e pula o restante
    if($_GET['class'] == 'login') include ('template/login.html');
    else
    {
        // abre o arquivo de template
        $template = file_get_contents('layout.html');

        $path = "{$_GET['modulo']}/{$_GET['class']}.php";
        
        $content = 'substituir';

        echo str_replace('#conteudo#', $content, $template);
    }
 }
?>