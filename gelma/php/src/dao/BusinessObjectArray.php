<?php
namespace php\src\dao;
require_once("BusinessObject.php");

class BusinessObjectArray implements \ArrayAccess{
	public $size;
	public $array;

	public function offsetExists($offset){
		return $offset < $this->size;
	}

	public function offsetGet($offset){
		return $this->array[$offset];
	}

	public function offsetSet($offset, $value){
		$this->array[$offset] = $value;
	}

	public function offsetUnset($offset){
		unset($this->array[$offset]);
	}

	public function __construct(){
		$this->size = 0;
		$this->array = array();
	}

	public function add(BusinessObject $b_o){
		$this->array[$this->size] = $b_o;
		$this->size ++;
		return true;
	}

	public function display_as_user(){
		echo "<ul>";
		foreach($this->array as $bo){
			$bo->display_as_user();
		}
		echo "</ul>";
	}

	public function display_as_admin(){
		echo "<ul>";
		foreach($this->array as $bo){
			$bo->display_as_admin();
		}
		echo "</ul>";
	}

	public function to_json(){
		$bo_array = array();
		foreach($this->array as $current_bo){
			array_push($bo_array, $current_bo->to_json());
		}
		return json_encode($bo_array);
	}
}
?>
