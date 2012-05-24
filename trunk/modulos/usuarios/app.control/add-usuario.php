<?php
  /**
   * var responsável por popular o <SELECT> 
   */  
  $tipos_usuarios = Usuario::allTipos();
  TApplication::setScript('jquery.sf');
  
  if (array_key_exists('save',$_POST)){
  	
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
      
	     $usuario = new Usuario();
	     UsuarioMapper::map($usuario,$_POST);
	     
	     if (($_POST['celular_usuario']) == ''){
	         $usuario->setCelularUsuario(null);
	         
	     }
	     
	     UsuarioMapper::insert($usuario);
	     
	     $sessao->addVar('msg',2);
	     header('location:index.php');
  	 }

  }
  
?>
