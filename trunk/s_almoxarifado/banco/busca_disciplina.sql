select 
    d.id_disciplina as id,
    d.nome_disciplina as disciplina
from disciplinas d
inner join disciplinas_usuarios du on (d.id_disciplina = du.disciplina_id)
where du.usuario_id = ?;