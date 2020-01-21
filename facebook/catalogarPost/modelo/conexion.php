<?php  

	class Conexion
	{
		private $host;
		private $db;
		private $user;
		private $pass;
		function __construct()
		{

            
		}
		public function getConexion()
		{
			    $gbd = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			    return $gbd;
			
		}
	}
 ?>