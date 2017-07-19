<?php
namespace php\src\dao;

require_once("Displayable.php");
require_once("Storable.php");

abstract class BusinessObject implements Displayable, Storable{
  protected $id;

  public function get_id(){
		return $this->id;
	}
}
?>
