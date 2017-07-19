<?php
namespace php\src\content;
use php\src\dao as DAO;
require_once(__DIR__."/../dao/BusinessObject.php");

/**
*	Content is a business object constituting the business logic of the application. It forms a basis to describe content from an OOP perspective.
*/
class Content extends DAO\BusinessObject{
	/**
	*	@var string $title Title of the content
	*/
	private $title;
	/**
	* @var string $type Type of the content depending on the application context
	*/
	private $type;
	/**
	* @var string $date Date of creation
	*/
	private $date;
	/**
	* @var string $content Content of the object
	*/
	private $content;

	/**
	* @param integer $id
	* @param string $title
	* @param string $type
	* @param string $date
	* @param string $content
	*/
	public function __construct($id, $title, $type, $date, $content){
		$this->id = $id;
		$this->title = $title;
		$this->type = $type;
		$this->date = $date;
		$this->content = $content;
	}

	/**
	*	@param string $property_name
	*/
	public function __get($property_name){
		switch($property_name){
      case "title":
        return $this->title;
			case "type":
        return $this->type;
			case "date":
        return $this->date;
			case "content":
        return $this->content;
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
			'title' => $this->title,
			'type' => $this->type,
			'date' => $this->date,
			'content' => $this->content
		);
		return $properties;
	}
}
?>
