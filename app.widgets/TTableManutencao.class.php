<?php

class TTableManutencao
{
    private $obj;
    
    function __construct(Requerir $obj) {
        $this->obj = $obj;
    }
    
    public function render()
    {?>
<table>
    <thead>
        <tr>
            <th>Laboratorio: <?php echo $this->obj->getLocalEquipamento();?></th>
            <th>Equipamento: <?php echo $this->obj->getEquipamentoRequisicao();?></th>
            <th>Defeito: <?php echo $this->obj->getDefeitoRequisicao();?></th>
            <th>Data: <?php echo $this->obj->getDtRequisicao();?></th>
            <th>Requisitante: <?php echo $this->obj->loadRequisitante();?></th>
        </tr>
        <tr>
            <th>Data</th>
            <th>Providencia</th>
            <th>Responsavel</th>
        </tr>
    </thead>
    <tbody>
<?php $manutencoes = $this->obj->loadManutencoes();
    foreach($manutencoes as $manu){ ?>
        <tr>
            <td><?php echo $manu->getDataManutencao();?></td>
            <td><?php echo $manu->getProvidenciaManutencao();?></td>
            <td><?php echo $manu->loadResponsavel();?></td>
        </tr>
    </tbody>
</table>        
<?php }
    }
}
?>
