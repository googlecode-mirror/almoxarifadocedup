﻿<?php
/**
 * classe TAction
 * encapsula uma ação
 */
class TAction
{
    private $action;
    private $param;
	private $page;

    /**
     * método __construct()
     * instancia uma nova ação
	 * @param $page = paramentro resposável para guardar pagina a ser carregada
     * @param $action = método a ser executado
     */
    public function __construct($page,$action)
    {
        $this->page = $page;
		$this->action = $action;
		
    }

    /**
     * método setParameter()
     * acrescenta um parâmetro ao método a ser executdao
     * @param $param = nome do parâmetro
     * @param $value = valor do parâmetro
     */
    public function setParameter($param, $value)
    {
        $this->param[$param] = $value;
    }

    /**
     * método serialize()
     * transforma a ação em uma string do tipo URL
     */
    public function serialize()
    {
        // verifica se a ação é um método
       
        if (is_string($this->action)) // é uma string
        {
            // obtém o nome da função
			$url['class'] = $this->page;
            $url['method'] = $this->action;
			
        }

        // verifica se há parâmetros
        if ($this->param)
        {
            $url = array_merge($url, $this->param);
        }
        // monta a URL
        return  $this->page.'.class.php?' . http_build_query($url);
    }
}
?>
