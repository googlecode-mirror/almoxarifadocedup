<?php
/**
 * classe TButton
 * respons�vel por exibir um bot�o
 */
class TButton extends TField
{
    private $action;
    private $label;
    private $formName;
	private $type = 'submit';
	private $src = '#';
	private $java = '#';

    /**
     * m�todo setAction
     * define a a��o do bot�o (fun��o a ser executada)
     * @param $action = a��o do bot�o
     * @param $label    = r�tulo do bot�o
     */
    public function setAction($action, $label)
    {
        $this->action = $action;
        $this->label = $label;
    }

    /**
     * m�todo setFormName
     * define o nome do formul�rio para a a��o bot�o
     * @param $name = nome do formul�rio
     */
    public function setFormName($name)
    {
        $this->formName = $name;
    }
	/**
     * m�todo setType
     * define o tipo e o src do button
	 * para fazer um IMAGE BUTTON
     * @param $tipo = image
	 * @param $src = caminho image
     */
	
	function setType($tipo,$src){
		
		$this->type = $tipo;
		$this->src = $src;
	}
	
	/**
     * m�todo setJava
     * define um funcao javascript
     * @param $function nome da fun��o
     */
	
	function setJava($function){
		$this->java = $function;
	}

    /**
     * m�todo show()
     * exibe o bot�o
     */
    public function show()
    {
        $url = $this->action->serialize();
        // define as propriedades do bot�o
        $this->tag->name    = $this->name;    // nome da TAG
        $this->tag->type    = $this->type;       // tipo de input
        $this->tag->value   = $this->label;   // r�tulo do bot�o
		$this->tag->src 	= $this->src;
        // se o campo n�o � edit�vel
        if (!parent::getEditable())
        {
            $this->tag->disabled = "1";
            $this->tag->class = 'tfield_disabled'; // classe CSS
        }
        // define a a��o do bot�o
        $this->tag->onclick =	"document.{$this->formName}.action='{$url}'; ";

	
        // exibe o bot�o
        $this->tag->show();
    }
}
?>
