<?php

class TRelChave{
    
    private $id;
    private $dt_inicial;
    private $dt_final;
    private $order;
    private $conteudo;
    
    public function __construct($conteudo = null) 
    {
        if($conteudo != null)
        {
            if(is_array($conteudo) or is_a($conteudo, TTableChave))
                $this->conteudo = $conteudo;       
        }
    }
        
    public function setConteudo($conteudo){        
        $this->conteudo = $conteudo;
    }
    
    public function setParams($dt_inicial = null,$dt_final = null,$id = null,$order = null)
    {
        if($dt_inicial) $this->dt_inicial = $dt_inicial;
        if($dt_final) $this->dt_final = $dt_final;
        if($id) $this->id = $id;
        if($order) $this->order = $order;
    }
    
    public function render()
    {
        if(!$this->conteudo)
        {
            include_once 'app.ado/DataBase.php';
            $pdo = new DataBase();
            $db = $pdo->getConn();
            
            $sql = 'select * from ctrl_chaves';
            
            if($this->dt_inicial or $this->dt_final)
            {
                $this->dt_inicial = $this->dt_inicial ? $this->dt_inicial : '2012/01/01';
                $this->dt_final = $this->dt_final ? $this->dt_final : date('Y/m/d');
                
                $sql .= ' where ((dt_inicial_controle between ? and ?) or (dt_final_controle between ? and ?))';
                
                $exec[] = $this->dt_inicial;
                $exec[] = $this->dt_final;
                
                if($this->id)
                {
                    $sql .= ' and id_controle = ?';
                    $exec[] = $this->id;
                }
            }
            elseif($this->id)
            {
                $sql .= ' where id_controle = ?';
                $exec[] = $this->id;
            }
            
            if($this->order)
            {
                $sql .= ' order by ?';
                $exec[] = $this->order;
            }
            
            $sth = $db->prepare($sql);
            $conteudo = $sth->execute($exec);
            $this->conteudo = $conteudo->fetchAll(PDO::FETCH_CLASS, 'CrlChave');
        }
        
        $tabela = new TTableChave($this->conteudo);
        
        $pdf = new TRelatorio();
        $pdf->writeHTML($tabela->render());
        $pdf->render();
        $pdf->exit();
    }
    
}





?>
