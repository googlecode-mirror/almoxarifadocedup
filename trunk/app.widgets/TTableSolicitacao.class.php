<?php

class TTableSolicitacao
{
    private $obj;
    
    public function render()
    {?>
<table>
    <thead>
        <tr>
            <th><img ></th>
        </tr>
        <tr>
            <th>Curso: </th>
            <th>Fase: </th>
            <th>Sem: </th>
        </tr>
        <tr>
            <th style='width: 50px'>Professor: </th>
            <th style='width: 50px'>Disciplina: </th>
        </tr>
        <tr>
            <th rowspan=2>Item</th>
            <th rowspan=2>Quantidade</th>
            <th rowspan=2>Descri��o / Especifica��o</th>
            <th colspan=2>Data</th>		
        </tr>
        <tr>
            <th>Solicitacao</th>
            <th>Entrega</th>
        </tr>	
    </thead>
    <tbody>
<?php foreach(){ ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<?php } ?>
    </tbody>
</table>
<?php }
}

?>
