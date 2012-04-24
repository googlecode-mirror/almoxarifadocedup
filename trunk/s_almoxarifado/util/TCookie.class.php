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
                         
                    
                    setcookie($this->nome,
							  $this->value,
							  $this->time,
							  $this->caminho,
							  $this->dominio,
							  $this->htts,
							  $this->http);
                    
                }
                
		
		public static function getVar($nome){
	  
		   return $_COOKIE[$nome];
		   echo 'lala';
		}
		
		function removeVar($nome){
		
			unset($_COOKIE[$nome]);
		}
		
	}
	
	
	$cookie = new TCookie('nome01','Luan',0);
	
	

?>