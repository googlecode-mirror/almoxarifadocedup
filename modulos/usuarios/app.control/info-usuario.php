<?php
   $id = $sessao->getVar('usuario')->id_usuario;
   $usuario = new Usuario(); 

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
      
	      $usuario->setIdUsuario($id);
              
              if (($_POST['celular_usuario']) == ''){
	             $usuario->setCelularUsuario(null);
	          }
	      
	      UsuarioMapper::map($usuario,$_POST);
	      UsuarioMapper::update($usuario);
	      Flash::addFlash('Usuario Alterado');
	      
	  
	  }
     
  }

   $row = Utils::findById($id,'usuarios','id_usuario');
   UsuarioMapper::map($usuario,$row);
?>
