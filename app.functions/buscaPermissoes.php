<?php

function buscaPermissoes($id)
{
    include 'app.ado/DataBase.php';
    $db = new DataBase();

    $modulos = $db->getConn()->query('select m.nome_modulo from modulos m
inner join modulos_permissoes mp on (mp.modulo_id = m.id_modulo)
inner join modulos_permissoes_usuarios mpu on (mpu.modulo_permissao_id = mp.id_modulo_permissao)
where mpu.usuario_id = '.$id.'
group by m.nome_modulo;')->fetchAll(PDO::FETCH_COLUMN);
    
    foreach($modulos as $modulo){
    $permissoes[$modulo] = $db->getConn()->query('select p.nome_permissao from permissoes p
inner join modulos_permissoes mp on (mp.permissao_id = p.id_permissao)
inner join modulos m on (mp.modulo_id = m.id_modulo)
inner join modulos_permissoes_usuarios mpu on (mpu.modulo_permissao_id = mp.id_modulo_permissao)
where mpu.usuario_id = '.$id.' and m.nome_modulo like "'.$modulo.'"
group by p.nome_permissao;')->fetchAll(PDO::FETCH_COLUMN);
    }
    
    $permissoes['usuarios'][] = 'info-usuario';
    $permissoes['usuarios'][] = 'logout';
    $permissoes['manutencoes'][] = 'm-manutencoes';
    
    return $permissoes;
}

?>
