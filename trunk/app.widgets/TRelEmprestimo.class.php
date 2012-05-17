<?php

class TRelEmprestimo{
    
    private $id;
    private $dt_inicial;
    private $dt_final;
    private $order;
    private $conteudo;
    
    public function __construct($conteudo = null) 
    {
        if($conteudo != null)
        {
            if(is_array($conteudo) or is_a($conteudo, TTableChave))
                $this->conteudo = $conteudo;       
        }
    }
        
    public function setConteudo($conteudo){        
        $this->conteudo = $conteudo;
    }
    
    public function setParams($dt_inicial = null,$dt_final = null,$id = null,$order = null)
    {
        if($dt_inicial) $this->dt_inicial = $dt_inicial;
        if($dt_final) $this->dt_final = $dt_final;
        if($id) $this->id = $id;
        if($order) $this->order = $order;
    }
    
    public function render()
    {
        if(is_array($this->conteudo))
        {
            $html = '';
            foreach($this->conteudo as $item)
            {
                $tabela = new TTableEmprestimo($item);
                $html .= $tabela->render();
            }
        }
        else 
        {
            $tabela = new TTableEmprestimo($this->conteudo);
            $html .= $tabela->render();
        }
        
        $pdf = new TRelatorio();
        $pdf->writeHTML($html);
        $pdf->render();
        $pdf->exit();
    }
    
}
?>
