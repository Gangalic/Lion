<?php
namespace php\src\controller;

use php\src\dao as DAO;
require_once(__DIR__."/Router.php");
require_once(__DIR__."/../dao/DataAccessObject.php");
require_once(__DIR__."/../dao/BusinessObjectArray.php");
require_once(__DIR__."/../dao/BusinessObjectFactory.php");

// the controller deals with foreign keys management
/**
* The Controller orchestrates the RESTful application by acting as a bridge between the HTTP/URI (using a Router) and the database (using a DAO).
*/
class Controller{
	private $dao;
	private $business_objects;

	public function __construct(){
		$this->dao = new DAO\DataAccessObject();
	}

	public function __get($name){
		switch($name){
			case "bo" :
				return $this->business_objects;
			default :
				throw new \Exception("Unknown property");
				break;
		}
	}

	/**
	*	Retrieve relevant resources
	*/
	public function run(){
		$uri = $_SERVER['REQUEST_URI'];
		$request_array = Router::read($uri);
		$http_method = $_SERVER['REQUEST_METHOD'];
		$class = $request_array[0];
		switch($http_method){
			case "GET" :
				if(!defined("LANGUAGE")){
					define("LANGUAGE", $_POST["LANGUAGE"]);
				}
				if(count($request_array) == 2){
					$this->business_objects = $this->dao->get($class, $request_array[1]);
				} else {
					$this->business_objects = $this->dao->get($class);
				}
				break;
			case "POST" :
				$bo;
				if(!defined("FK_USER")){
					define("FK_USER", $_POST["FK_USER"]);
				}
				if(!defined("LANGUAGE")){
					define("LANGUAGE", $_POST["LANGUAGE"]);
				}
				switch($class){
					case "Content" :
						$params = array(null,  $_POST["type"], null, $_POST["title"], $_POST["content"]);
						$bo = DAO\BusinessObjectFactory::createContent($params);
						break;
					case "User" :
						$params = array(null, $_POST["login"], $_POST["password"], $_POST["name"], $_POST["last_name"], $_POST["signature"]);
						$bo = DAO\BusinessObjectFactory::createUser($params);
						break;
					default :
						throw new \Exception("Unknown business object class");
						break;
				}
				$this->dao->store($bo);
				break;
			case "PUT" :
				$bo;
				if(!defined("LANGUAGE")){
					define("LANGUAGE", $_POST["LANGUAGE"]);
				}
				switch($class){
					case "Content" :
						$params = array($request_array[1],  $_POST["type"], $_POST["date"], $_POST["title"], $_POST["content"]);
						$bo = DAO\BusinessObjectFactory::createContent($params);
						break;
					case "User" :
						$params = array($request_array[1], $_POST["login"], $_POST["password"], $_POST["name"], $_POST["last_name"], $_POST["signature"]);
						$bo = DAO\BusinessObjectFactory::createUser($params);
						break;
					default :
						throw new \Exception("Unknown business object class");
						break;
				}
				$this->dao->store($bo);
				break;
			case "DELETE" :
				$bo;
				switch($class){
					case "Content" :
						$params = array($request_array[1], null, null, null, null);
						$bo = DAO\BusinessObjectFactory::createContent($params);
						break;
					case "User" :
						$params = array($request_array[1], null, null, null, null, null);
						$bo = DAO\BusinessObjectFactory::createUser($params);
						break;
					default :
					throw new \Exception("Unknown business object class");
					break;
				}
				$this->dao->delete($bo);
				break;
			default :
			 	throw new \Exception("Unknown HTTP method");
				break;
		}
	}

	/**
	*	Display the business object array in a JSON format, for front-end integration
	*/
	public function to_json(){
		echo $this->business_objects->to_json();
	}
}
?>
