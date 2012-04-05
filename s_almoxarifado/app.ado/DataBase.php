<?php
//Salvar com o nome DataBase.php
include 'app.ado/Config.php';

class DataBase{
	public $conexao;
	public function __construct(){
		//PHP Data Object		
		$this->conexao = new PDO(Config::getDsn(),
					 Config::$usuario,
					 Config::$senha);
		$this->conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
	}
	public function getConn(){
		return $this->conexao;	
	}
	
	
}
?>
