<?php
  if (isset($_GET['key'])){
    $id = $_GET['key'];
  }else{
    $id = $sessao->getVar('usuario')->id_usuario;
  }

    $usuario = new Usuario();
    $row = Utils::findById($id,'usuarios','id_usuario');
    UsuarioMapper::map($usuario,$row);

  
   if (array_key_exists('edit',$_POST)){
   	
   	$dados = array('nome_usuario' => array('Nome'),
   				   'email_usuario'=> array('Email', 'tipo' => 'email'),
   			           'telefone_usuario' => array ('Telefone', 'tipo' => 'inteiro'),
   				   'dt_nascimento_usuario' => array ('Data Nascimento', 'tipo' => 'data'),
   				   'login_usuario' => array ("Login",'tipo' =>'nome'),
   				   'senha_usuario' => array('Senha'),
   			           'confirma_senha' => array('Repita a Senha', 'tipo' => 'igualdade', 'compara' => 'senha_usuario', 'legenda_2' => 'Senha'),
   					);   
   
   	$validacao = ValidaFormulario($dados);
   	
   	if ($validacao === true){
      
	      $objectUsuario = new Usuario();
	      $objectUsuario->setIdUsuario($id);
              
              if (($_POST['celular_usuario']) == ''){
	         $objectUsuario->setCelularUsuario(null);   
	      }
	      
	      UsuarioMapper::map($objectUsuario,$_POST);
	      UsuarioMapper::update($objectUsuario);
	      
	      $sessao->addVar('msg',1);
	      header('location:index.php?modulo=usuarios&page=visualizar');

   	}
      
  }
  


?>
