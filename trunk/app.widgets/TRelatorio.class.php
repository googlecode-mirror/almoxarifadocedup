<?php

include_once 'componentes/MPDF54/mpdf.php';

class TRelatorio {
    
    public $pdf;
    
    public function __construct()
    {
        $this->pdf = new mPDF();
        $this->pdf->SetHTMLHeader();
        $this->pdf->SetHTMLFooter();
    }
    
    public function __call($method,$params)
    {
        if(method_exists($this->pdf,$method))
            $this->pdf->$method($params);
    }
    
}

?>
