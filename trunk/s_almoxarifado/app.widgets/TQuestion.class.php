<?php
/**
 * classe TQuestion
 * Exibe perguntas ao usuário
 */
class TQuestion
{
    /**
     * método construtor
     * instancia objeto TQuestion
     * @param $message = pergunta ao usuário
     * @param $action_yes = ação para resposta positiva
     * @param $action_no = ação para resposta negativa
    */
    function __construct($message, $url_yes, $url_no)
    {
        // instancia o painel para exibir o diálogo
        $painel = new TElement('div');
        $painel->class = "tquestion";

        // cria um botão para a resposta positiva
        $button1 = new TElement('input');
        $button1->type = 'button';
        $button1->value = 'Sim';
        $button1->onclick="javascript:location='$url_yes'";
        $button1->id = 'bt1';

        // cria um botão para a resposta negativa
        $button2 = new TElement('input');
        $button2->type = 'button';
        $button2->value = 'Não';
        $button2->onclick="javascript:location='$url_no'";

        // cria uma tabela para organizar o layout
        $table = new TTable;
        $table->align = 'center';
        $table->cellspacing = 10;
    
       

        // cria uma linha para o ícone e a mensagem
        $row=$table->addRow();
        $row->addCell(new TImage('app.misc/images/question.png'));
        $row->addCell($message);

        // cria uma linha para os botões
        $row=$table->addRow();
        $row->addCell($button1);
        $row->align = 'left';
        $row->addCell($button2);

        // adiciona a tabela ao painél
        $painel->add($table);
        // exibe o painél
        $painel->show();
    }
}
?>
