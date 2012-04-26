 <?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 * Usuario Model
 * @author Home
 */
class Usuario {
    
     /** @var int */
    private $id_usuario;
    /** @var string */
    private $nome_usuario;
    /** @var int */
    private $tipo_usuario_id;
    /** @var string */
    private $email_usuario;
    /** @var int */
    private $telefone_usuario;
    /** @var int */
    private $celular_usuario;
    /** @var date */
    private $dt_nascimento_usuario;
    /** @var string */
    private $login_usuario;
    /** @var string */
    private $senha_usuario;
    /** @var array de objetos tipos Permissao */ // por jomaro
    private $permissoes_usuario;
   
    function __construct(){
        
    }
   
    /**
     *
     * @param type $id_usuario 
     */
    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    
    /**
     *
     * @return int 
     */
    public function getIdUsuario(){
        return $this->id_usuario;
    }
    
    /**
     *
     * @param type $nome_usuario 
     */
    public function setNomeUsuario($nome_usuario){
        $this->nome_usuario = $nome_usuario;
    }
    
    /**
     *
     * @return string 
     */
    public function getNomeUsuario(){
        return $this->nome_usuario;
    }
    
    /**
     *
     * @param type $tipo_usuario_id 
     */
    public function setTipoUsuarioId($tipo_usuario_id){
        $this->tipo_usuario_id = $tipo_usuario_id;
    }
    
    /**
     *
     * @return int 
     */
    public function getTipoUsuarioId(){
        return $this->tipo_usuario_id;
    }
    
    /**
     *
     * @param type $email_usuario 
     */
    public function setEmailUsuario($email_usuario){
        $this->email_usuario = $email_usuario;
    }
    
    /**
     *
     * @return string 
     */
    public function getEmailUsuario(){
        return $this->email_usuario;
    }
    
    /**
     *
     * @param type $telefone_usuario 
     */
    public function setTelefoneUsuario($telefone_usuario){
        $this->telefone_usuario = $telefone_usuario;
    }
    
    /**
     *
     * @return int 
     */
    public function getTelefoneUsuario(){
        return $this->telefone_usuario;
    }
    
    /**
     *
     * @param type $celular_usuario 
     */
    public function setCelularUsuario($celular_usuario){
        $this->celular_usuario = $celular_usuario;
    }
    
    /**
     *
     * @return int 
     */
    public function getCelularUsuario(){
        return $this->celular_usuario;
    }
    
    /**
     *
     * @param type $dt_nascimento_usuario 
     */
    public function setDtNascimentoUsuario($dt_nascimento_usuario){
        $this->dt_nascimento_usuario = $dt_nascimento_usuario;
    }
    
    /**
     *
     * @return date 
     */
    public function getDtNascimentoUsuario(){
        return $this->dt_nascimento_usuario;
    }
    
    /**
     *
     * @param type $login_usuario 
     */
    public function setLoginUsuario($login_usuario){
        $this->login_usuario = $login_usuario;
    }
    
    /**
     *
     * @return string 
     */
    public function getLoginUsuario(){
        return $this->login_usuario;
    }
    
    /**
     *
     * @param type $senha_usuario 
     */
    public function setSenhaUsuario($senha_usuario){
        $this->senha_usuario = $senha_usuario;
    }
    
    /**
     *
     * @return string 
     */
    public function getSenhaUsuario(){
        return $this->senha_usuario;
    }
    
    
    
    
    public static function allTipos(){
        
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = 'SELECT * FROM tipos_usuarios';
               
               $sth = $conn->prepare($sql);
               $sth->execute();
               $result = $sth->fetchALL(PDO::FETCH_ASSOC);
         
               return $result;
              
               TTransaction::close();
              
               
            }else{
                echo 'Sem conexão com banco!';
            }
    }
    
   
}

?>
