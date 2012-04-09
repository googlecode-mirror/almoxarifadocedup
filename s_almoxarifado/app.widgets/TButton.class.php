<?php
/**
 * classe TButton
 * responsável por exibir um botão
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
     * método setAction
     * define a ação do botão (função a ser executada)
     * @param $action = ação do botão
     * @param $label    = rótulo do botão
     */
    public function setAction($action, $label)
    {
        $this->action = $action;
        $this->label = $label;
    }

    /**
     * método setFormName
     * define o nome do formulário para a ação botão
     * @param $name = nome do formulário
     */
    public function setFormName($name)
    {
        $this->formName = $name;
    }
	/**
     * método setType
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
     * método setJava
     * define um funcao javascript
     * @param $function nome da função
     */
	
	function setJava($function){
		$this->java = $function;
	}

    /**
     * método show()
     * exibe o botão
     */
    public function show()
    {
        $url = $this->action->serialize();
        // define as propriedades do botão
        $this->tag->name    = $this->name;    // nome da TAG
        $this->tag->type    = $this->type;       // tipo de input
        $this->tag->value   = $this->label;   // rótulo do botão
		$this->tag->src 	= $this->src;
        // se o campo não é editável
        if (!parent::getEditable())
        {
            $this->tag->disabled = "1";
            $this->tag->class = 'tfield_disabled'; // classe CSS
        }
        // define a ação do botão
        $this->tag->onclick =	"document.{$this->formName}.action='{$url}'; ";

	
        // exibe o botão
        $this->tag->show();
    }
}
?>
