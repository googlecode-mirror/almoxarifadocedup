<?php

include_once 'util/TSessao.class.php';

class TApplication{
    
    static private $styleLink = array('login','style','principal','menu','controler_bar');
    
    static private $scriptLink = array('jquery','jquery-1.6.2.min','jquery-ui-1.8.16.custom.min','script');
    
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
    
           static public function init(){

               function __autoload($classe){
                   
                   $modulo = (isset($_GET['modulo'])) ? $_GET['modulo'] : null;

                   $pastas = array('app.ado','app.config','app.widgets','util','app.comuns/app.model','app.comuns/mapping',
                            "modulos/{$modulo}/app.model","modulos/{$modulo}/mapping");
                    
                   foreach ($pastas as $pasta){
                         if (file_exists("{$pasta}/{$classe}.class.php")) {

                             include_once "{$pasta}/{$classe}.class.php";
                         }
                    }
                }  
           }
    
            
            static public function run(){
                
                $sessao = new TSessao(true);
                $flashes = null;

                $modulo = (isset($_GET['modulo'])) ? $_GET['modulo'] : null;
                $page = (isset($_GET['page'])) ? $_GET['page'] : null;
                $logout = (isset($_GET['logout'])) ? $_GET['logout'] : null;
                
                $usuario = $sessao->getVar('usuario');
                
                
                include 'app.functions/validate.php';
                //validate($usuario);           
                
                if (($page != null) and ($logout == null) and (($usuario != null)) or ($page == 'add-usuario')) {
                    
                    $menu = new TMenu($usuario->permissoes,array('gerenciar')); 
                    
                     if ($page == 'panel'){
                         $templatePage = "app.comuns/template/{$page}.phtml";
                         require('layout/index.phtml');
                     
           
                     }elseif ($modulo != null) {

                            if (file_exists("modulos/{$modulo}/app.control/{$page}.php")){                  
                                require("modulos/{$modulo}/app.control/{$page}.php"); 
                            }
                                     
                            if (file_exists("modulos/{$modulo}/template/{$page}.phtml")){                
 
                                $templatePage = "modulos/{$modulo}/template/{$page}.phtml";
                                if (Flash::hasFlashes()) {
                                    $flashes = Flash::getFlashes();
                                }
                            }
                                     
                            require('layout/index.phtml');
                     }
		}else{
                    if ($usuario == null){
                          
                          require("app.comuns/app.control/login.php"); 
                          $templatePage = "app.comuns/template/login.phtml";
                          require('layout/index.phtml');
                         
                    }else{
                          $menu = new TMenu($usuario->permissoes);
                          require("app.comuns/app.control/login.php");
                          $templatePage = "app.comuns/template/panel.phtml";
                          require('layout/index.phtml');
                                
                    }
               }     
          }
}



TApplication::init();
TApplication::run();
?>