<?php
//Salvar com o nome Config.php
class Config{
	public static $host = 'localhost';
	public static $database = 'aula';
	public static $driver = 'pgsql';
	public static $usuario = 'postgres';
	public static $senha = 'postgres';
	public static function getDsn(){
		return Config::$driver . ':host='.Config::$host.
			';dbname='.Config::$database;
	}
}
//pgsql:host=localhost;dbname=aula
?>
