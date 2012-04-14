select u.nome_usuario,m.nome_modulo,p.nome_permissao 
from usuarios u
inner join modulos_permissoes_usuarios mpu on (mpu.usuario_id = u.id_usuario)
inner join modulos_permissoes mp on (mp.id_modulo_permissao = mpu.modulo_permissao_id)
inner join modulos m on (m.id_modulo = mp.modulo_id)
inner join permissoes p on (p.id_permissao = mp.permissao_id);