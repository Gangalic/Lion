<?php
namespace php\src\dao;

interface Displayable{
  public function display_as_user();

	public function display_as_admin();

	public function display_add_form();

	public function display_updt_form();

  public function to_json();
}

?>
