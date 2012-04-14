select 
    mp.id_modulo_permissao as id,
    p.nome_permissao as permissao, 
    m.nome_modulo as modulo
from  modulos_permissoes_usuarios mpu
inner join modulos_permissoes mp on (mp.id_modulo_permissao = mpu.modulo_permissao_id)
inner join modulos m on (m.id_modulo = mp.modulo_id)
inner join permissoes p on (p.id_permissao = mp.permissao_id)
where mpu.usuario_id = ?;