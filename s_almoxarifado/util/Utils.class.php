<?php
/**
 * Miscellaneous utility methods.
 */
final class Utils {

    private function __construct() {
    }

    /**
     * Generate link.
     * @param string $page target page
     * @param array $params page parameters
     */
    public static function createLink($page, array $params = array()) {
        $params = array_merge($params, array('page' => $page));
        // TODO add support for Apache's module rewrite
        return 'index.php?' .http_build_query($params);
    }

    /**
     * Format date.
     * @param String $date date to be formatted for Brazilian
     * @return string formatted date
     */
    public static function formatDateBr($date){
	$ano = substr($date,0,4);
	$mes = substr($date,5,2);
	$dia = substr($date,8,4);
	return "{$dia}/{$mes}/{$ano}";
    }
    
    /**
     * Format date.
     * @param $date date to be formatted for US
     * @return string formatted date
     */
    public static function conv_data_to_us($date){
	$dia = substr($date,0,2);
	$mes = substr($date,3,2);
	$ano = substr($date,6,4);
	return "{$ano}-{$mes}-{$dia}";
     }
     
    /**
     * Retorna datetime no formato
     * para mysql
     * @param $databr string com date time
     * @return datetime 
     */
     
     static function formatDateTimeUs($databr) {
       $date = new DateTime($databr);
       return $date->format('Y-m-d H:i:s');
    }

    /**
     * Format date and time.
     * @param DateTime $date date to be formatted
     * @return string formatted date and time
     */
    public static function formatDateTime(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('d/m/Y H:i');
    }
    
    /**
     * Rertorna a data atual.
     * @return data atual 
     */
    public static function getDate(){
       return date('d/m/Y');
    }

    /**
     * Redirect to the given page.
     * @param type $page target page
     * @param array $params page parameters
     */
    public static function redirect($page, array $params = array()) {
        header('Location: ' . self::createLink($page, $params));
        die();
    }

    /**
     * Get value of the URL param.
     * @return string parameter value
     * @throws NotFoundException if the param is not found in the URL
     */
    public static function getUrlParam($name) {
        if (!array_key_exists($name, $_GET)) {
            throw new NotFoundException('URL parameter "' . $name . '" not found.');
        }
        return $_GET[$name];
    }
    
    /**
     * Obter registro pelo ID
     * @return Array com o resultado
     * @param $id int valor chave primária
     * @param $tabela string nome da entidade
     * @param $campo string nome do campo da chave primária
     */
    public static function findById($id,$tabela,$campo){
        
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "SELECT * FROM {$tabela}
                      WHERE {$campo} = ?";
                                                
               
               $sth = $conn->prepare($sql);
               $sth->execute(array($id));
            
               $result = $sth->fetch();
               
               return $result;
               
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
    
    /**
     * Obter todos os registros
     * @return Array com o resultado
     * @param $id int valor chave primária
     * @param $tabela string nome da entidade
     * @param $campo string nome do campo da chave primária
     */
    
    public static function getAll($tabela){
        
         TTransaction::open('my_config');
            
         if ($conn = TTransaction::get()){
               $sql = "SELECT * FROM {$tabela}";

               $sth = $conn->prepare($sql);
               $sth->execute();
            
               $result = $sth->fetchALL();
               
               return $result;
               TTransaction::close();

         }else{
                echo 'Sem conexão com banco!';
         }
        
    }
    
}

?>
