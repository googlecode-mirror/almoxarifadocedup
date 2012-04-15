<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TUsuario
 *
 * @author Jomaro
 */
class TUsuario {
    
    protected $id;
    protected $nome;
    protected $login;
    protected $senha;

    protected $permissoes;
    protected $disciplinas;
    
    public function __construct($id,$nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }
    
    public function setPermissao($permissao)
    {
        $this->permissoes[] = $permissao;
    }
    
    public function setDisciplina($disciplina)
    {
        $this->disciplinas[] = $disciplina;
    }
    
    public function setLogin($login,$senha)
    {
        $this->login = $login;
        $this->senha = $senha;
    }
    
    public function loadDisciplina()
    {
        $db = new DataBase();
        $sql = 'select 
    d.id_disciplina as id,
    d.nome_disciplina as disciplina
from disciplinas d
inner join disciplinas_usuarios du on (d.id_disciplina = du.disciplina_id)
where du.usuario_id = ?;';
        $sth = $db->getConn()->prepare($sql);
        $sth->execute(array($this->id));
        $this->disciplinas = $sth->fetchALL(PDO::FETCH_ASSOC);
        $db = null;
   }
    
    public function loadPermissao()
    {
        $db = new DataBase();
        $sql = 'select 
    mp.id_modulo_permissao as id,
    p.nome_permissao as permissao, 
    m.nome_modulo as modulo
from  modulos_permissoes_usuarios mpu
inner join modulos_permissoes mp on (mp.id_modulo_permissao = mpu.modulo_permissao_id)
inner join modulos m on (m.id_modulo = mp.modulo_id)
inner join permissoes p on (p.id_permissao = mp.permissao_id)
where mpu.usuario_id = ?;';
        $sth = $db->getConn()->prepare($sql);
        $sth->execute(array($this->id));
        $this->permissoes = $sth->fetchALL(PDO::FETCH_ASSOC);
        $db = NULL;
    }
}

?>
