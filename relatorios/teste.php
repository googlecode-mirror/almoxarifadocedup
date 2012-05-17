<?php

include 'app.ado/DataBase.php';

$db = new DataBase();

$con = $db->getConn()->query('select * from emprestimos where usuario_id = 2;')->fetchAll(PDO::FETCH_CLASS, 'Emp');

$pdf = new TRelEmprestimo($con);
$pdf->render();

?>