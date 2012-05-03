select 
    id_usuario as id,
    nome_usuario as nome,
    login_usuario as login,
    senha_usuario as senha
from usuarios
where login_usuario like ? and senha_usuario like ?;