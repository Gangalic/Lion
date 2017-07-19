<?php
namespace php\src\dao;
use \PDO as PDO;

/**
* PDOSingleton encapsulates a PDO instance to ensure its uniqueness.
*/
class PDOSingleton{
	/**
	* @var PDO $pdo private instance of PHP data objects (PDO)
	*/
	private $pdo;

	/**
	* @return PDOSingleton
	*/
	public function __construct(){
		$this->pdo = null;
	}

	/**
	* This method gives an access to the database according
	* to the config.ini file through a PDO instance
	* @return PDO
	*/
	public function get_connection(){
		if(is_null($this->pdo)){
			try{
				$db_config = parse_ini_file(__DIR__."/../../../admin/config.ini");
				$server = $db_config["DB_SERVER"];
				$name = $db_config["DB_NAME"];
				$login = $db_config["DB_LOG"];
				$password = $db_config["DB_PASS"];
				$this->pdo = new PDO('mysql:host='.$server.';dbname='.$name, $login, $password);
			}
			catch(PDOException $e){
				echo "No database connection :", $e->getMessage();
  				die();
			}
		}
		return $this->pdo;
	}

	/**
	* @return void
	*/
	public function __destruct(){
		$this->pdo = null;
	}
}
?>
