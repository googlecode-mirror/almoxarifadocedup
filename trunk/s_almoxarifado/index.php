<?php

$sessao = new Sessao();

function __autoload($classe)
{
	   $pastas = array('app.widgets', 'app.ado', 'app.model', 'app.control');
	   foreach ($pastas as $pasta)
	   {
		      if (file_exists("{$pasta}/{$classe}.class.php"))
                      {
		
			         include_once "{$pasta}/{$classe}.class.php";
		      }
	   }
}


include 'app.funcoes/validate.php';

validate();



class TApplication
{
	   static public function run()
	   {
                 
                 if(!$_GET) $_GET['class'] = 'Principal';
                 
                 // carrega a pagina de login e pula o restante
                 if($_GET['class'] == 'Login') include ('template/login.html');
                 else
                 {
                      // abre o arquivo de template
                      $template = file_get_contents('layout.html');
		      
                      // inicializa a variavel que vai armazenar o conteudo
                      $content = '';

                        $class = $_GET['class'];
                        if (class_exists($class))
                        {
                                $pagina = new $class;
                                ob_start();
                                $pagina->show();
                                $content = ob_get_contents();
                                ob_end_clean();
                        }
                        else if (function_exists($method))
                        {
                                call_user_func($method, $_GET);
                        }

		      echo str_replace('#conteudo#', $content, $template);
                 }
	   }
}
TApplication::run();
?>