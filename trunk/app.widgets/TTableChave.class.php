<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TTableChave
 *
 * @author User
 */
class TTableChave{
    
    private $obj;
    
    public function __construct(array $obj) {
        $this->obj = $obj;
    }
    
    public function render()
    {?>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Professor</th>
                    <th>Laboratorio</th>
                    <th>Observacao</th>
                    <th>Hora Entrega</th>
                </tr>
            </thead>
            <tbody>
<?php foreach($this->obj as $ob){ 
    $date = explode(' ',$ob->dt_final_controle); ?>
                <tr>
			<td><?php echo $date[0]; ?></td>
			<td><?php echo $ob->professor_id; ?></td>
			<td><?php echo $ob->laboratorio_id; ?></td>
			<td><?php echo $ob->observacao_controle; ?></td>
			<td><?php echo $date[1]; ?></td>
		</tr>
<?php } ?>
            </tbody>
        </table>
<?php }
}

?>
