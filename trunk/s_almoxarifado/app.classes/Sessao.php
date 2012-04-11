<?php
/**
 * Classe de manipulação de SESSÃO do php
 *
 * @author Marco Aurélio Lima Fernandes
 */
class Sessao {

    private $session = array();
    private $_id = 'sessao_id';
    /**
     * Configuração das mensagens de erro
     */
    const ERROR_INI_SESSION = 'A sessão não foi inicializada';
    const ERROR_VAR_NOT_REGISTERED = 'Variável não registrada na sessão';
    const ERROR_ACCESS_NOT_PERMITED = 'Impossível adicionar esta variável';

    /**
     *
     * @param Boolean $autoStart Espeficica se sessão deve ser criada caso não exista
     */
    public function  __construct($autoStart = false) {
        
        if($this->sessionIsRegistered()){
            $this->session = $_SESSION;
        }else{
            if($autoStart == true){
                session_start($this->_id);
                session_name($this->_id);
                $_SESSION[$this->_id] = true;
                $this->session = $_SESSION;
            }else{
                throw new SessionException(self::ERROR_INI_SESSION);
            }

        }
        
    }
    /**
     *
     * @return Boolean Verifica se a sessão está registrada
     */
    private function sessionIsRegistered(){
        return ($this->_id == session_name());
    }

    /**
     * Atualiza as variáveis da sessão
     */
    private function refreshSession(){
        if($this->sessionIsRegistered()){
            $_SESSION = $this->session;
        }else{
            throw new SessionException(self::ERROR_INI_SESSION);
        }
    }
    /**
     *
     * @param String $nome Nome da variável de sessão
     * @param mixed $valor Valor da variável de sessão
     */
    public function addVar($nome,$valor){
        if($this->sessionIsRegistered()){
            if($nome != $this->_id){
                if(is_array($valor)){
                    if(empty($this->session[$nome])){
                        $this->session[$nome] = array();
                    }
                    foreach ($valor as $key => $value){

                        $this->session[$nome][$key] = $value;
                        
                    }
                }else{
                    $this->session[$nome] = $valor;
                    
                }
                
                $this->refreshSession();
            }else{
                throw new SessionException(self::ERROR_ACCESS_NOT_PERMITED);
            }
        }else{
            throw new SessionException(self::ERROR_INI_SESSION);
        }
    }

    /**
     *
     * @param String $nome Nome da variável de sessão
     * @return mixed Valor da variável de sessão
     */
    public function getVar($nome = null){
        if($this->sessionIsRegistered()){
			
            if($nome == null){
                return $this->session;
                
            }else{
                
                if(!isset($this->session[$nome])){
                    return null;
                }
                
                if(is_object($this->session[$nome])){                    
                    if(($a = @unserialize($this->session[$nome])) === TRUE){
                        return $a;
                    }else{                        
                        return $this->session[$nome];                        
                    }
                }else{
                    
                    return $this->session[$nome];
                }
            }
        }/*else{
            throw new SessionException(self::ERROR_INI_SESSION);
        }*/
    }
    /**
     *
     * @param String $nome Nome da variável de sessão a ser removida
     */
    public function removeVar($nome){
        if($this->sessionIsRegistered()){
            if($nome != $this->_id){
                unset($this->session[$nome]);
                $this->refreshSession();
            }else{
                throw new SessionException(self::ERROR_ACCESS_NOT_PERMITED);
            }
        }else{
            throw new SessionException(self::ERROR_INI_SESSION);
        }

    }

    /**
     * Destrói a sessão
     */
    public function fechar(){
        if($this->sessionIsRegistered()){
            session_destroy();
        }else{
            throw new SessionException(self::ERROR_INI_SESSION);
        }
    }
    /**
     *
     * @return String
     */
    public function  __toString() {
        return '<pre>'.print_r($this,true).'</pre>';
    }
}


?>
