<?php

   if (array_key_exists('key',$_GET)){
       $usuario = Utils::findById($_GET['key'],'usuarios', 'id_usuario');
       
       $criteria = new SearchCriteria();
       $criteria->setValueCriteria('0');
       $laboratorios = LabMapper::getLabs($criteria);
     
   }
   
   if (array_key_exists('save',$_POST)){
   	
	   $dados = array('nome_usuario' => array('Usuário'),
	   			       'dt_inicial_controle'=> array('Data', 'tipo' => 'data'),
	   			
	   );
   	
       $validacao = ValidaFormulario($dados);
       
       if ($validacao === true){
	       $data = array ('professor_id' => $_GET['key'],
	                      'laboratorio_id' => $_POST['laboratorio_id'],
	                      'observacao_controle' => ($_POST['observacao_controle'] == '') ? null : $_POST['observacao_controle'],
	                      'dt_inicial_controle' => Utils::FormatDateTimeUs($_POST['dt_inicial_controle'].' '.$_POST['hora_inicial_controle']));
	       
	       $ch = new CrlChave;
	       CrlChaveMapper::map($ch,$data);
	       CrlChaveMapper::addCrlChave($ch);
	       
	       header('location:index.php?modulo=chaves&page=visualizar');
       }else{
       	   Flash::addFlash($validacao);
       }
       
   }
   
   if (array_key_exists('labkey', $_GET)){
        
       $crlchave = new CrlChave;
       $crlchave->setLaboratorioId($_GET['labkey']);
       $crlchave->setDtFinalControle(date('Y-m-d H:i:s'));
       
       CrlChaveMapper::ConcluiCrlChave($crlchave);
       
       header('location:index.php?modulo=chaves&page=visualizar');
   }
   
   if (array_key_exists('lab',$_GET)){
       $page = 'add-lab';
       
      if (array_key_exists('labkeyedit',$_GET)){
          
          $lab = Utils::getById($_GET['labkeyedit'], 'laboratorios', 'id_laboratorio', 'Lab');
         
      }
       
      if (array_key_exists('saveLab',$_POST)){
       
            $data = array('nome_laboratorio' => $_POST['nome_laboratorio'],
                            'numero_laboratorio' => $_POST['numero_laboratorio']);

            $lab = new Lab();          
            LabMapper::map($lab, $data);
            LabMapper::addLabs($lab);

            header('location:index.php?modulo=chaves&page=visualizar');
            
      }
          
      if(array_key_exists('updateLab',$_POST)){
  
            $data = array('id_laboratorio' => $_POST['id_laboratorio'],
                            'nome_laboratorio' => $_POST['nome_laboratorio'],
                            'numero_laboratorio' => $_POST['numero_laboratorio']);

            $lab = new Lab();          
            LabMapper::map($lab, $data);
            LabMapper::updateLab($lab);

            header('location:index.php?modulo=chaves&page=visualizar');
      } 
      
      if (array_key_exists('labkeydelete',$_GET)){
          
          $lab = new Lab();
          $lab->setIdLaboratorio($_GET['labkeydelete']);
          LabMapper::deleteLab($lab);
          
          header('location:index.php?modulo=chaves&page=visualizar');
  
      }
       
   }

?>
