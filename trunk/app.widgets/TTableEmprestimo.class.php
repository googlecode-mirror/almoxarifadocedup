<?php

class TTableEmprestimo
{
    private $obj;
    
    function __construct(Emp $obj) {
        $this->obj = $obj;
    }
    
    public function render()
    {
	$html = "<table>
	<thead>
		<tr>
			<th>Requisitante: {$this->obj->loadRequisitante()}</th>
			<th>Data: {$this->obj->dt_inicial_emprestimo}</th>
		</tr>
		<tr>
			<th>Descricao</th>
			<th>Quantidade</th>
			<th>Entrega</th>
		</tr>
	</thead>
	<tbody>";
	$itens = $this->obj->loadItens();
	foreach($itens as $item){
	$html .="<tr>
			<td>{$item->descricao_item}</td>
			<td>{$item->quantidade_item}</td>
			<td>{$item->dt_final}</td>
		</tr>";
	}
	$html .="	</tbody>
</table>"; 

	return $html;
	}
}

?>
