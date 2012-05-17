<?php

include 'app.ado/DataBase.php';

$db = new DataBase();

$con = $db->getConn()->query('select * from req_manutencao;')->fetchAll(PDO::FETCH_CLASS, 'Requerir');

$pdf = new TRelManutencao($con);
$pdf->render();

?>