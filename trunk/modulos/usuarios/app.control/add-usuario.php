<?php
  /**
   * var responsável por popular o <SELECT> 
   */  
  $tipos_usuarios = Usuario::allTipos();

  if (array_key_exists('save',$_POST)){
      
     $val = new Validate();
     
     $campos = $_POST;
     $val->setCampos('Nome',$campos['nome_usuario'])->nome();
     
     if ($val->valida){ 
        
        $usuario = new Usuario();
        UsuarioMapper::map($usuario,$_POST);

        if (($_POST['celular_usuario']) == ''){
            $usuario->setCelularUsuario(null);

        }

        UsuarioMapper::insert($usuario);

        $sessao->addVar('msg',2);
        header('location:index.php');
        
     }else{
         foreach ($val->erros() as $erro){
             echo $erro;
         }
         
     }
  }
  
?>
