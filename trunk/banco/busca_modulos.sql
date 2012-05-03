select m.nome_modulo from modulos m
inner join modulos_permissoes mp on (mp.modulo_id = m.id_modulo)
inner join modulos_permissoes_usuarios mpu on (mpu.modulo_permissao_id = mp.id_modulo_permissao)
where mpu.usuario_id = 3
group by m.nome_modulo;