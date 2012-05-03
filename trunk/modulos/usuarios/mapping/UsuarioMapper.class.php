<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioMapper
 *
 * @author Home
 */
class UsuarioMapper {
     
    function __construct(){
        
    }
   
    /**
     * Maps para Model {Usurios}
     * @param Usuario $usuario
     * @param array $propriedades
     */
    public static function map(Usuario $usuario, array $propriedades){
        
        if (array_key_exists('id_usuario', $propriedades)) {
            $usuario->setIdUsuario($propriedades['id_usuario']);
        }
        
        if (array_key_exists('nome_usuario', $propriedades)) {
            $usuario->setNomeUsuario($propriedades['nome_usuario']);
        }
        
        if (array_key_exists('tipo_usuario_id', $propriedades)) {
            $usuario->setTipoUsuarioId($propriedades['tipo_usuario_id']);
        }
        
        if (array_key_exists('email_usuario', $propriedades)) {
            $usuario->setEmailUsuario($propriedades['email_usuario']);
        }
        
        if (array_key_exists('telefone_usuario', $propriedades)) {
            $usuario->setTelefoneUsuario($propriedades['telefone_usuario']);
        }
        
        if (array_key_exists('celular_usuario', $propriedades)) {
            $usuario->setCelularUsuario($propriedades['celular_usuario']);
        }
        
        if (array_key_exists('dt_nascimento_usuario', $propriedades)) {
            $usuario->setDtNascimentoUsuario($propriedades['dt_nascimento_usuario']);
        }
        
        if (array_key_exists('login_usuario', $propriedades)) {
            $usuario->setLoginUsuario($propriedades['login_usuario']);
        }
        
        if (array_key_exists('senha_usuario', $propriedades)) {
            $usuario->setSenhaUsuario($propriedades['senha_usuario']);
        }
        
    }
    
    public static function insert(Usuario $usuario){
         
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "INSERT INTO usuarios (nome_usuario,
                                             tipo_usuario_id,
                                             email_usuario,
                                             telefone_usuario,
                                             celular_usuario,
                                             dt_nascimento_usuario,
                                             login_usuario,
                                             senha_usuario)
                       VALUE (?,?,?,?,?,STR_TO_DATE(?,'%d/%m/%Y'),?,?)";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($usuario->getNomeUsuario(),
                                   $usuario->getTipoUsuarioId(),
                                   $usuario->getEmailUsuario(),
                                   $usuario->getTelefoneUsuario(),
                                   $usuario->getCelularUsuario(),
                                   $usuario->getDtNascimentoUsuario(),
                                   $usuario->getLoginUsuario(),
                                   $usuario->getSenhaUsuario()));
            
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
            }
            
        
    }
    
    public static function update(Usuario $usuario){
        
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "UPDATE usuarios SET nome_usuario=?,
                                           tipo_usuario_id=?,
                                           email_usuario=?,
                                           telefone_usuario=?,
                                           celular_usuario=?,
                                           dt_nascimento_usuario=STR_TO_DATE(?,'%d/%m/%Y'),
                                           login_usuario=?,
                                           senha_usuario=?
             
                       WHERE id_usuario = ?";
    
               $sth = $conn->prepare($sql);
               $sth->execute(array($usuario->getNomeUsuario(),
                                   $usuario->getTipoUsuarioId(),
                                   $usuario->getEmailUsuario(),
                                   $usuario->getTelefoneUsuario(),
                                   $usuario->getCelularUsuario(),
                                   $usuario->getDtNascimentoUsuario(),
                                   $usuario->getLoginUsuario(),
                                   $usuario->getSenhaUsuario(),
                                   $usuario->getIdUsuario()));
            
               TTransaction::close();

            }else{
                echo 'Sem conexão com banco!';
            }
        
    }
    
    public static function getUsuarios(SearchCriteria $condicao = null){
       
         
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = "SELECT U.*,T.nome_tipo FROM usuarios U ";
               $sql .="INNER JOIN tipos_usuarios T ON
                       (T.id_tipo = U.tipo_usuario_id)";
               
               if ($condicao !== null){
                    if ($condicao->getValueCriteria() !== null) {
                        $sql .=" WHERE U.nome_usuario like '{$condicao->getValueCriteria()}%'";
                    }
               }
               
               $sql .=" ORDER BY U.id_usuario DESC";
                       
               $sth = $conn->prepare($sql);
               $sth->execute();
            
               $result = $sth->fetchALL(PDO::FETCH_OBJ);
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    } 
    
    
}

?>
