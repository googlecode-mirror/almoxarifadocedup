<?php
//Salvar com o nome Config.php
class Config{
	public static $host = 'localhost';
	public static $database = 's_almoxarifado';
	public static $driver = 'mysql';
	public static $usuario = 'root';
	public static $senha = '';
	public static function getDsn(){
		return Config::$driver . ':host='.Config::$host.
			';dbname='.Config::$database;
	}
}
//pgsql:host=localhost;dbname=aula

?>
