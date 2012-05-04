<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginMapper
 * mapper para {@link Todo} de array
 * @author Home
 */
class LoginMapper {
    
    function __construct(){
        
    }
   
    /**
     * Maps array to the given {@link Login}.
     * @param Login $login
     * @param array $propriedades
     */
    public static function map(Login $login, array $propriedades){
        
        if (array_key_exists('login_usuario', $propriedades)) {
            $login->setUsuario($propriedades['login_usuario']);
        }
        
        if (array_key_exists('senha_usuario', $propriedades)) {
            $login->setSenha($propriedades['senha_usuario']);
        }
        
    }
    
    public static function autenticar(Login $login){
          
            TTransaction::open('my_config');
            $sessao = new TSessao(true);
            
            if ($conn = TTransaction::get()){
               $sql = 'SELECT * FROM usuarios
                       WHERE login_usuario like ? AND senha_usuario like ?';
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($login->getUsuario(),
                                   $login->getSenha()));
               $result = $sth->fetch(PDO::FETCH_OBJ);
               
               if ($result){
                   
                   include 'app.functions/buscaPermissoes.php';
                   $result->permissoes = buscaPermissoes($result->id_usuario);
                   
                   $sessao->addVar('usuario',$result);
                   header('location:index.php');
               }else{
                   $sessao->addVar('msg',1);
                   header('location:index.php');
               }
              
          
               TTransaction::close();
              
            }else{
                echo 'Sem conexão com banco!';
            }
     
    }
}

?>
