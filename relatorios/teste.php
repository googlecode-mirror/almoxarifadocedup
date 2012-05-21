<?php

include 'app.ado/DataBase.php';

$db = new DataBase();

$con = $db->getConn()->query('select * from emprestimos where usuario_id = 2;')->fetchAll(PDO::FETCH_CLASS, 'Emp');

$pdf = new TRelEmprestimo($con);
$pdf->render();


// include_once '../componentes/MPDF54/mpdf.php';

// $pdf = new mPDF();

// $pdf->WriteHTML("alo mundo");

// $pdf->Output('jomaro.pdf',"D");

// exit();

?>