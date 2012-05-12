<?php
     
    if (array_key_exists('key',$_GET)){
        $sessao->addVar('id',$_GET['key']);
    }
    
    if ($sessao->getVar('id') != null){
        $requisitante = Utils::findById($sessao->getVar('id'), 'usuarios', 'id_usuario');
    }
    
    if (array_key_exists('save',$_POST)){
    	
    	$dados = array('nome_requisitante' => array('Requisitante'),
    		       'nome_responsavel' => array('Responsável'),
    		       'dt_inicial_emprestimo'=> array('Data', 'tipo' => 'data'),
    			 
    	);
    	
    	$validacao = ValidaFormulario($dados);
    	 
    	if ($validacao === true){
        
	        $emp = new Emp();
	        $emp->setRequisitanteId($sessao->getVar('id'));
	        $emp->setUsuarioId($sessao->getVar('usuario')->id_usuario);  
	        EmpMapper::map($emp, $_POST);
	        $date_inicial = Utils::formatDateTimeUs($_POST['dt_inicial_emprestimo'].' '.date('H:m:s'));
	        $emp->setDtInicialEmprestimo($date_inicial);
	  
	        if ($sessao->getVar('mat') != null){
	            
	            foreach ($sessao->getVar('mat') as $item){
	                $itemObject = new Item();
	                ItemMapper::map($itemObject, $item);
	                $emp->addItens($itemObject);
	            
	            }
	        
	            EmpMapper::insert($emp);
	            $sessao->removeVar('mat');
	            
	            $sessao->addVar('msg',3);
	            header('location:index.php?modulo=usuarios&page=visualizar');
	                
	        }else{
	            Flash::addFlash('Por favor adicione um item.');
	        }
    	}else{
    		Flash::addFlash($validacao);
    	}
        
        
        
    }
    


    if (array_key_exists('add-mat',$_GET)){
      $dados = array('item' => array('Item'),
                     'item_qtd' => array('Qtd','tipo' => 'inteiro'));

      $validacao = ValidaFormulario($dados);
      
      if ($validacao === true){
          
        $data = array('descricao_item' => $_POST['item'],
                      'quantidade_item' => str_pad($_POST['item_qtd'], 2, '0', STR_PAD_LEFT),
                      'dt_final'=> $_POST['item_entrega'].' '.Utils::formatTime($_POST['hora_entrega'].':'.$_POST['minuto_entrega'].':00'));  
        
        $sessao->addArray('mat',$data);
        header('location:index.php?modulo=emprestimos&page=gerar&key='.$sessao->getVar('id'));
      }
    }
    
    if (array_key_exists('del',$_GET)){

       $sessao->delArray('mat',$_GET['nome']);
       
      header('location:index.php?modulo=emprestimos&page=gerar&key='.$sessao->getVar('id')); 
     }
 
?>
