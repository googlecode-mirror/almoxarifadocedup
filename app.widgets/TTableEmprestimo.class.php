<?php

class TTableEmprestimo
{
    private $obj;
    
    function __construct(Emp $obj) {
        $this->obj = $obj;
    }
    
    public function render()
    {?>
<table>
	<thead>
		<tr>
			<th>Requisitante: <?php echo $this->obj->loadRequisitante(); ?></th>
			<th>Data: <?php echo $this->obj->dt_inicial_emprestimo; ?></th>
		</tr>
		<tr>
			<th>Descricao</th>
			<th>Quantidade</th>
			<th>Entrega</th>
		</tr>
	</thead>
	<tbody>
<?php $itens = $this->obj->loadItens();
foreach($itens as $item){?>
		<tr>
			<td><?php echo $item->descricao_item; ?></td>
			<td><?php echo $item->quantidade_item; ?></td>
			<td><?php echo $item->dt_final;?></td>
		</tr>
<?php } ?>
	</tbody>
</table>    
<?php }
}

?>
