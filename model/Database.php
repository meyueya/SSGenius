<?php
/** 
 * Archivo de conexión a la base de datos, lo usan muchos archivos como "ReporteFacebookModel.php"
 * @author Mario Gonzales Flores noranterri@gmail.com
 * @capa de abstracción de base de datos usando Singleton
 * 
 */
require 'Safepdo.php';
final class Database {
    private static $db = "SsgApp";//
    private static $dns;  
    private static $username;
    private static $password;   
    private static $instance;
    private static $driver_options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;'); 
    private static $iniFile = '/home/ssgenius/configuration/database.ini';
       
  private function __construct() { }   
  /**  
   * Crea una instancia de la clase PDO  
   *   
   * @access public static  
   * @return object de la clase PDO  
   */   
  public static function getInstance()   
  {   
      $fileConfig = parse_ini_file(self::$iniFile, true);
      if (!$fileConfig) { throw new \Exception("Can't open or parse ini file.");  }
      $database = $fileConfig[''.self::$db.''];
      self::$dns = $database['dns'];
      self::$username = $database['user'];
      self::$password = $database['pass'];
    if (!isset(self::$instance))   
    {   
      self::$instance = new SafePDO(self::$dns, self::$username, self::$password, self::$driver_options);   
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    }   
    return self::$instance;   
  }   
 /**  
  * Impide que la clase sea clonada  
  *   
  * @access public  
  * @return string trigger_error  
  */   
  public function __clone()   
  {   
    trigger_error('Clone is not allowed.', E_USER_ERROR);   
  }   
	
}
//$dbh = Database::getInstance(); //ejemplo de uso