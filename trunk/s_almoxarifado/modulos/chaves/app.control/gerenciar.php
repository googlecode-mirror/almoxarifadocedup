<?php
    
   if (array_key_exists('key',$_GET)){
       $usuario = Utils::findById($_GET['key'],'usuarios', 'id_usuario');
       
       $criteria = new SearchCriteria();
       $criteria->setValueCriteria('0');
       $laboratorios = LabMapper::getLabs($criteria);
     
   }
   
   if (array_key_exists('save',$_POST)){
      
       $data = array ('professor_id' => $_GET['key'],
                      'laboratorio_id' => $_POST['laboratorio_id'],
                      'observacao_controle' => ($_POST['observacao_controle'] == '') ? null : $_POST['observacao_controle'],
                      'dt_inicial_controle' => Utils::FormatDateTimeUs($_POST['dt_inicial_controle'].' '.$_POST['hora_inicial_controle']));
       
       $ch = new CrlChave;
       CrlChaveMapper::map($ch,$data);
       CrlChaveMapper::addCrlChave($ch);
       
       header('location:index.php?modulo=usuarios&page=visualizar');
       
   }

?>
