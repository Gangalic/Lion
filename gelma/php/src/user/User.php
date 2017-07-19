<?php
namespace php\src\user;
use php\src\dao as DAO;
require_once(__DIR__."/../dao/BusinessObject.php");

/**
*	User is a business object constituting the business logic of the application. It forms a basis to describe users from an OOP perspective.
*/
class User extends DAO\BusinessObject{
	/**
	* @var string $login User login
	*/
	private $login;
	/**
	* @var string $password User crypted password
	*/
	private $password;
	/**
	* @var string $name User name
	*/
	private $name;
	/**
	* @var string $last_name User last name
	*/
	private $last_name;
	/**
	* @var string $signature User signature
	*/
	private $signature;

	public function __construct($id, $login, $password, $name, $last_name, $signature){
		$this->id = $id;
		$this->login = $login;
		$this->password = $password;
		$this->name = $name;
		$this->last_name = $last_name;
		$this->signature = $signature;
	}

	public function __get($property_name){
		switch($property_name){
      case "login":
        return $this->login;
			case "password":
        return $this->password;
			case "name":
        return $this->name;
			case "last_name":
        return $this->last_name;
			case "signature":
        return $this->signature;
			default:
				throw new \Exception("undefined property");
		}
	}

	/**
	* Method displaying the completed HTML template for a given business object from a general end-user perspective (public website)
	*/
	public function display_as_user(){

	}

	/**
	* Method displaying the completed HTML template for a given business object from an administrator perspective (admin website)
	*/
	public function display_as_admin(){

	}

	/**
	* Method displaying the completed HTML form template to add a given business object to the database
	*/
	public function display_add_form(){

	}

	/**
	* Method displaying the completed HTML form template to update a given business object in the database
	*/
	public function display_updt_form(){

	}

	public function to_json(){
		$properties = array(
			'id' => $this->id,
			'signature' => $this->signature,
			'login' => $this->login,
			'password' => $this->password,
			'name' => $this->name,
			'last_name' => $this->last_name
		);
		return $properties;
	}
}
?>
