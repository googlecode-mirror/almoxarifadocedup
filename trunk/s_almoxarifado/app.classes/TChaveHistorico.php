<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TChaveHistorico
 *
 * @author Jomaro
 */
class TChaveHistorico extends TChaveIndisponivel{

    public $dt_final;
    
    public function __construct($id_laboratorio,$nome_laboratorio,$numero_laboratorio,$id_professor,
            $nome_professor,$observacoes,$dt_inicial,$dt_final) 
    {
        $this->id_laboratorio = $id_laboratorio;
        $this->nome_laboratorio = $nome_laboratorio;
        $this->numero_laboratorio = $numero_laboratorio;

        $this->id_professor = $id_professor;
        $this->nome_professor = $nome_professor;

        $this->observacoes = $observacoes;
        $this->dt_inicial = $dt_inicial;
        $this->dt_final = $dt_final;
    }
}

?>
