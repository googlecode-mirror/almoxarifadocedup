<?php
/**
 * classe TImage
 * classe para exibi��o de imagens
 */
class TImage
{
    private $source;  // localiza��o da imagem
    private $tag;     // objeto TElement

    /**
     * m�todo construtor
     * instancia objeto TImage
     * @param $source = localiza��o da imagem
     */
    public function __construct($source)
    {
        // atribui a localiza��o da imagem
        $this->source = $source;
        // instancia objeto TElement
        $this->tag    = new TElement('img');
    }

    /**
     * m�todo show()
     * exibe imagem na tela
     */
    public function show()
    {
        // define algumas propriedades da tag
        $this->tag->src = $this->source;
        $this->tag->border=0;
        // exibe tag na tela
        $this->tag->show();
    }
}
?>
