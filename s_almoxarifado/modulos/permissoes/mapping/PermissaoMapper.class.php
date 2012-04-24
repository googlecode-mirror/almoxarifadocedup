<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissaoMapper
 *
 * @author Home
 */
class PermissaoMapper {
    
    function __construct(){
        
    }
    public static function getModulos(){
       
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = "SELECT id_modulo, nome_modulo FROM modulos";
         
               $sth = $conn->prepare($sql);
               $sth->execute();
            
               $result = $sth->fetchALL(PDO::FETCH_NUM);
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
    
    public static function getPermissoes(){
       
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
                
               $sql = "SELECT id_permissao, nome_permissao FROM permissoes";
         
               $sth = $conn->prepare($sql);
               $sth->execute();
            
               $result = $sth->fetchALL(PDO::FETCH_NUM);
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
    
    public static function getModulo_Permissoes(){
       
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = "SELECT count(id_modulo) FROM modulos";
               $sth = $conn->prepare($sql);
               $sth->execute();
               $count = $sth->fetch();
               
               for ($i=1;$i <= $count[0];$i++){
             
                   $sql = "SELECT * FROM modulos_permissoes
                       WHERE modulo_id = ?
                       ORDER by permissao_id";
               
                   $sth = $conn->prepare($sql);
                   $sth->execute(array($i));
                   $result[] = $sth->fetchALL(PDO::FETCH_NUM);    
               
               }
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
    
    public static function getPermissoesById($id){
       
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = "SELECT mpu.modulo_permissao_id, mp.modulo_id FROM modulos_permissoes_usuarios mpu
                       INNER JOIN modulos_permissoes mp ON
                       (mp.id_modulo_permissao = mpu.modulo_permissao_id) 
                       WHERE usuario_id = ?
                       order by mp.modulo_id";
         
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
            
               $result = $sth->fetchALL(PDO::FETCH_NUM);
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
    
     public static function InsertPermissoes($id, $arrayPost, $qtd_modulos_permissoes){
       
        TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               
               $sql = "DELETE FROM modulos_permissoes_usuarios
                       WHERE usuario_id = ?";
 
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
               
               
               for ($i=0;$i < $qtd_modulos_permissoes;$i++){
                    
                   if ($arrayPost[$i] != 0){
                            
                          
                        $sql = "INSERT INTO modulos_permissoes_usuarios (modulo_permissao_id,
                               usuario_id) VALUE (?,?)";
                       
                    
                        $sth = $conn->prepare($sql);
                        $sth->execute(array($arrayPost[$i],$id));       
             }
  
               
               }
              
               TTransaction::close();
         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
   
}

?>
