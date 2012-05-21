<?php

include_once '../componentes/MPDF54/mpdf.php';

class TRelatorio {
    
    public $pdf;
    
    public function __construct()
    {
        $this->pdf = new mPDF( 'utf-8' , 'A4' );
		$this->pdf->WriteHTML('<link type="text/css" href="app.misc/css/pdf.css" rel="stylesheet" />',1);
		
		//$this->pdf->allow_charset_conversion=true;
		
        // $this->pdf->SetHTMLHeader();
        // $this->pdf->SetHTMLFooter();
		
		// $this->pdf->WriteHTML(utf8_encode('alo mundo'));
		// $this->pdf->Output('jomaro.pdf');
    }
    
    public function __call($method,$params)
    {
        if(method_exists($this->pdf,$method))
            $this->pdf->$method($params);
    }
    
}

?>
