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
    { ?>
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
<?php foreach($this->obj as $ob){?>
                <tr>
			<td><?php echo $ob->getDtInicialControle(); ?></td>
			<td><?php echo $ob->loadProfessor(); ?></td>
			<td><?php echo $ob->loadLaboratorio(); ?></td>
			<td><?php echo $ob->getObservacaoControle(); ?></td>
			<td><?php echo $ob->getDtFinalControle(); ?></td>
		</tr>
<?php } ?>
            </tbody>
        </table>
<?php }
}

?>
