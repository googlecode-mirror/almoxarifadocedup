<?php
function __autoload($classe){  
                   
    $modulos = array('chaves','emprestimos','manutencoes','permissoes','solicitacoes','usuarios');

    foreach ($modulos as $modulo){

        if(file_exists('modulos/'.$modulo.'/app.model/'.$classe.'.class.php')){
            include_once ('modulos/'.$modulo.'/app.model/'.$classe.'.class.php');
        }
        if(file_exists('modulos/'.$modulo.'/mapping/'.$classe.'.class.php')){
            include_once ('modulos/'.$modulo.'/mapping/'.$classe.'.class.php');
        }
    }

    $pastas = array('app.ado','app.config','app.widgets','util','app.comuns/app.model','app.comuns/mapping',
                "modulos/{$modulo}/app.model","modulos/{$modulo}/mapping");
                
    foreach ($pastas as $pasta){
        if (file_exists("{$pasta}/{$classe}.class.php")) {

            include_once "{$pasta}/{$classe}.class.php";
        }
    }
}   
    


class TApplication{
    
    static private $styleLink = array();
    
    static private $scriptLink = array('jquery','jquery-1.7.2.min','jquery-ui-1.8.16.custom.min','script','java');
    
    static public function setStyle($estilo)
    {
        if(!in_array($estilo, self::$styleLink)) 
            array_push (self::$styleLink,$estilo);
    }

    static public function setScript($script)
    {
        if(!in_array($script, self::$scriptLink)) 
                self::$scriptLink[] = $script;
    }    
            
    static public function run(){

        $sessao = new TSessao(true);
        include ('util/Validacao.php');
        $flashes = null;
        
        $usuario = $sessao->getVar('usuario');
		
        include 'app.functions/validate.php';
        $valida = validate($usuario);
        
        //include 'relatorios/teste.php';
        
        if ($valida){

            if($usuario)
            {
                $menu = new TMenu($usuario->permissoes,array('gerenciar')); 
                TApplication::setStyle('menu');
                TApplication::setStyle('controler_bar');
            }

            if (!$_GET)
            {
                if($usuario == null)
                {
                    require("app.comuns/app.control/login.php"); 
                    TApplication::setStyle('login');
                    $templatePage = "app.comuns/template/login.phtml";
                }else{
                    if ($sessao->getVar('msg1') != null){                          
                        if ($sessao->getVar('msg1') == 5){
                            Flash::addFlash('Você não tem permissão!');
                        	$flashes = Flash::getFlashes();
                        	$sessao->removeVar('msg1');
                        } 
                    }
                    $templatePage = "app.comuns/template/panel.phtml";
                } 
            }else{
                $modulo = (isset($_GET['modulo'])) ? $_GET['modulo'] : null;
                $page = (isset($_GET['page'])) ? $_GET['page'] : null;

                if (file_exists("modulos/{$modulo}/app.control/{$page}.php"))
                {                  
                    require("modulos/{$modulo}/app.control/{$page}.php"); 
                }
                if (file_exists("modulos/{$modulo}/template/{$page}.phtml"))
                {                
                    $templatePage = "modulos/{$modulo}/template/{$page}.phtml";
                }  
            }     
            if (isset($validacao)){
	            if ($validacao !== true ){
	                Flash::addFlash($validacao);
	            }
            }
            
            if (Flash::hasFlashes()) 
            {	
            	
                $flashes = Flash::getFlashes();
             
            }
   
            if (!isset($_GET['ajax'])){
                TApplication::setStyle('style');
                TApplication::setStyle('principal');
                TApplication::setStyle('redmond/jquery-ui-1.8.16.custom');
                require('layout/index.phtml');
            }
        }
        else
        {
            header('location: index.php');
        }     
    }
}

TApplication::run();

?>