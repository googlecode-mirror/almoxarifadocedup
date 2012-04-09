<?php
/**
 * classe TSession
 * gerencia uma se��o com o usu�rio
 */
class TSession
{
    /**
     * m�todo construtor
     * inicializa uma se��o
     */
    function __construct()
    {
        if (!isset($_SESSION)){
	
			session_start();
		}
    }

    /**
     * m�todo setValue()
     * armazena uma vari�vel na se��o
     * @param $var     = Nome da vari�vel
     * @param $value = Valor
     */
    static function setValue($var, $value)
    {
        $_SESSION[$var] = $value;
    }
	
	/**
     * m�todo setValueArray()
     * armazena uma vari�vel na se��o Array
     * @param $var     = Nome da vari�vel
     * @param $value = Valor
	 * @param $key = posi��o da Array
     */
	function setValueArray($var, $key = 0, $value)
    {
        $_SESSION[$var][$key] = $value;
    }


    /**
     * m�todo getValue()
     * retorna uma vari�vel da se��o
     * @param $var = Nome da vari�vel
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
     * m�todo freeSession()
     * destr�i os dados de uma se��o
     */
    function freeSession()
    {
        $_SESSION = array();
        session_destroy();
    }
}
?>
