<?php
    $cursos = SolMapper::getCursos();
    if (array_key_exists('val', $_POST)){
       header('Content-type: text/json');
        
       $disciplinas = SolMapper::getDisciplinas($_POST['val']);
       echo json_encode($disciplinas);
    }
    
   if (array_key_exists('valor', $_POST)){
       header('Content-type: text/json');
       
       $fases = SolMapper::getFases($_POST['valor']);
       echo json_encode($fases);
       
   }
   
   if (array_key_exists('items', $_GET)){
       $page = 'items';
   }
 
   
   if (array_key_exists('save', $_POST)){
       
       $sessao->removeVar('matSol');
       
       $dados = array('nome_requisitante' => array('Requisitante'),
	   	      'curso_id' => array('Curso','tipo' => 'select'),
                      'disciplina_id' => array('Disciplina','tipo' => 'select'),
                      'fase_id' => array ("Fase", 'tipo' => 'select'),
                      'semestre' => array ('Semestre')
	);
        
       $validacao = ValidaFormulario($dados);
       
       if ($validacao === true){
           
       $sessao->addVar('infos',$_POST);
       header('location:index.php?modulo=solicitacoes&page=gerar&items=1');
     }
   }
   
   if (array_key_exists('add-mat',$_GET)){
     
       if (array_key_exists('item',$_POST)){
            
           $dados = array('item' => array('Item'),
                           'item_qtd' => array('Qtd','tipo' => 'inteiro'));

            $validacao = ValidaFormulario($dados);

            if ($validacao === true){

                $data = array('descricao_item' => $_POST['item'],
                            'quantidade_item' => str_pad($_POST['item_qtd'], 2, '0', STR_PAD_LEFT)
                            );  

                $sessao->addArray('matSol',$data);
                header('location:index.php?modulo=solicitacoes&page=gerar&items=1&add-mat=1');
            }
        }
   }
    
    if (array_key_exists('del',$_GET)){

       $sessao->delArray('matSol',$_GET['nome']);
       
      header('location:index.php?modulo=solicitacoes&page=gerar&items=1&add-mat=1'); 
     }
     
     
     
   if (array_key_exists('save-aquisicao',$_GET)){
       
                $dados = $sessao->getVar('infos');
       
                $sol = new Sol();
                $sol->setRequisitanteId($sessao->getVar('usuario')->id_usuario); 
	        SolMapper::map($sol, $dados);
  
                $data = explode(' ',$dados['dt_aquisicao_inicial']);
	        $date_inicial = Utils::conv_data_to_us($data[0]);
	        $sol->setDtAquisicaoInicial($date_inicial.' '.$data[1]);
	  
	        if ($sessao->getVar('matSol') != null){
	            
	            foreach ($sessao->getVar('matSol') as $item){
	                $itemObject = new ItemSol();
	                ItemSolMapper::map($itemObject, $item);
	                $sol->addItens($itemObject);
	            
	            }
	        
	            SolMapper::insert($sol);
	            $sessao->removeVar('matSol');
	            
	            $sessao->addVar('msg',3);
                    $sessao->removeVar('infos');
	            header('location:index.php?modulo=solicitacoes&page=visualizar');
	                
	        }else{
                    header('location:index.php?modulo=solicitacoes&page=gerar&items=1');
	            Flash::addFlash('Por favor adicione um item.');
	        }
       
   }

   
   
    
    
     


    
    
    

?>
