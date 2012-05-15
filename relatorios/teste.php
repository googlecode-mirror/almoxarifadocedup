<?php

include 'DataBase.php';

$db = new DataBase();

$con = $db->getConn()->query('select id_controle,professor_id,laboratorio_id,observacao_controle,dt_final_controle from ctrl_chaves;')->fetchAll(PDO::FETCH_CLASS, 'CrlChave');

$pdf = new TRelChaves($con);
$pdf->render();

?>
