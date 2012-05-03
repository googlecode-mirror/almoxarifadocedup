select p.nome_permissao from permissoes p
inner join modulos_permissoes mp on (mp.permissao_id = p.id_permissao)
inner join modulos m on (mp.modulo_id = m.id_modulo)
inner join modulos_permissoes_usuarios mpu on (mpu.modulo_permissao_id = mp.id_modulo_permissao)
where mpu.usuario_id = 3 and m.nome_modulo like 'manutencoes'
group by p.nome_permissao;