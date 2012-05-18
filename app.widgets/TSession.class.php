<?php
/**
 * classe TSession
 * gerencia uma seção com o usuário
 */
class TSession
{
    /**
     * método construtor
     * inicializa uma seção
     */
    function __construct()
    {
        if (!isset($_SESSION)){
	
			session_start();
		}
    }

    /**
     * método setValue()
     * armazena uma variável na seção
     * @param $var     = Nome da variável
     * @param $value = Valor
     */
    static function setValue($var, $value)
    {
        $_SESSION[$var] = $value;
    }
	
	/**
     * método setValueArray()
     * armazena uma variável na seção Array
     * @param $var     = Nome da variável
     * @param $value = Valor
	 * @param $key = posição da Array
     */
	function setValueArray($var, $key = 0, $value)
    {
        $_SESSION[$var][$key] = $value;
    }


    /**
     * método getValue()
     * retorna uma variável da seção
     * @param $var = Nome da variável
     */
    static function getValue($var)
    {
		if (!isset($_SESSION)){
	
			session_start();
		}
		
        if (isset($_SESSION[$var]))
        {
            return $_SESSION[$var];
        }
    }

    /**
     * método freeSession()
     * destrói os dados de uma seção
     */
    function freeSession()
    {
        $_SESSION = array();
        session_destroy();
    }
}
?>
