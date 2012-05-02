<?php
	
	
	class TCookie {
	
		private $nome;
		private $value;
		private $time;
		private $caminho;
		private $dominio;
		private $htts;
		private $http;
		
		function __construct($nome,
				     $value,
				     $time = 0,
	                             $caminho = '/',
	                             $dominio ='',
                                     $htts = false,
                                     $http = false){
		
			$this->nome = $nome;
			$this->value = $value;
			$this->time = $time;
			$this->caminho = $caminho;
			$this->dominio = $dominio;
			$this->htts = $htts;
			$this->http = $http;
    
                        $this->value = serialize($this->value);
                              
                        self::addVar();
                }		
		
                
                function addVar(){
                 
                    setcookie($this->nome,
			      $this->value,
                              $this->time,
			      $this->caminho,
			      $this->dominio,
			      $this->htts,
			      $this->http);

                }
                
                
                function setValue($nome,$value){
                    
                    $this->nome = $nome;
                    $this->value = $value;
                    
                    self::addVar();
          
                    }
                
		
		public static function getVar($nome){
                    
                   if (array_key_exists($nome,$_COOKIE)){
                      $a = ($_COOKIE[$nome]);
                      return unserialize($a);
                   }                     
                   
		}
		
		function removeVar($nome){
		
		   unset($_COOKIE[$nome]);
		}
		
	}
	
	
	$cookie = new TCookie('nome01','Luan',0);
	
	

?>