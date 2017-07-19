<?php
namespace php\src\dao;
use php\src\content as Content;
use php\src\user as User;

require_once("BusinessObject.php");
require_once("BusinessObjectArray.php");
require_once("BusinessObjectFactory.php");
require_once("PDOSingleton.php");

require_once(__DIR__."/../content/ContentSQLAdaptor.php");
require_once(__DIR__."/../user/UserSQLAdaptor.php");

class DataAccessObject{
	private $db_access;

	public function __construct(){
		$this->db_access = new PDOSingleton();
	}

	public function get($business_object_class){
		$sql_query;
		switch($business_object_class){
			case "Content" :
				if(func_num_args() == 2){
					$sql_query = Content\ContentSQLAdaptor::get(func_get_arg(1), LANGUAGE);
				} else {
					$sql_query = Content\ContentSQLAdaptor::get(LANGUAGE);
				}
				break;
			case "User" :
				if(func_num_args() == 2){
					$sql_query = User\UserSQLAdaptor::get(func_get_arg(1));
				} else {
					$sql_query = User\UserSQLAdaptor::get();
				}
				break;
		}
		// query to PDO
		$query_result = $this->db_access->get_connection()->query($sql_query);
		//insert in the resulting business object array
		$query_result = $query_result->fetchAll();
		$business_object_array = new BusinessObjectArray();
		foreach($query_result as $value){
			$current_object;
			switch($business_object_class){
				case "Content" :
					$current_object = BusinessObjectFactory::createContent($value);
					break;
				case "User" :
					$current_object = BusinessObjectFactory::createUser($value);
					break;
			}
			$business_object_array->add($current_object);
		}
		return $business_object_array;
	}

	public function store(BusinessObject $business_object){
		$sql_request;
		if(empty($business_object->get_id())){
			// insert into the database
			switch(get_class($business_object)){
				case "php\src\content\Content" :
					$sql_request = Content\ContentSQLAdaptor::insert($business_object->title, $business_object->type, $business_object->content, FK_USER, LANGUAGE);
					break;
				case "php\src\user\User" :
					$sql_request = User\UserSQLAdaptor::insert($business_object->login, $business_object->password, $business_object->name, $business_object->last_name, $business_object->signature);
					break;
				default :
					throw new \Exception("Unknown class.");
					break;
			}
		} else {
			// update the field
			switch(get_class($business_object)){
				case "php\src\content\Content" :
					$sql_request = Content\ContentSQLAdaptor::update($business_object->get_id(), $business_object->title, $business_object->type, $business_object->content, $business_object->date, LANGUAGE);
					break;
				case "php\src\user\User" :
					$sql_request = User\UserSQLAdaptor::update($business_object->get_id(),$business_object->login, $business_object->password, $business_object->name, $business_object->last_name, $business_object->signature);
					break;
				default :
					throw new \Exception("Unknown class.");
					break;
			}
		}
		// echo $sql_request;
		$this->db_access->get_connection()->exec($sql_request);
	}

	public function delete(BusinessObject $business_object){
		$sql_query;
		switch(get_class($business_object)){
			case "php\src\content\Content" :
				$sql_query = Content\ContentSQLAdaptor::delete($business_object->get_id());
				break;
			case "php\src\user\User" :
				$sql_query = User\UserSQLAdaptor::delete($business_object->get_id());
				break;
		}
		// query to PDO
		$query_result = $this->db_access->get_connection()->exec($sql_query);
	}

	public function __destruct(){
		$this->db_access = null;
	}
}
?>
