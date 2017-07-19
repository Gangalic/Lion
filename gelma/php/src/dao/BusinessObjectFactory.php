<?php
namespace php\src\dao;
use php\src\content as Content;
use php\src\user as User;
require_once("BusinessObjectArray.php");
require_once(__DIR__."/../content/Content.php");
require_once(__DIR__."/../user/User.php");

class BusinessObjectFactory{
  static public function createContent($parameters){
    $id = $parameters[0];
    $type = $parameters[1];
    $date = $parameters[2];
    $title = $parameters[3];
    $content = $parameters[4];

    return new Content\Content($id, $title, $type, $date, $content);
  }

  static public function createUser($parameters){
    $id = $parameters[0];
    $login = $parameters[1];
    $password = $parameters[2];
    $name = $parameters[3];
    $last_name = $parameters[4];
    $signature = $parameters[5];

    return new User\User($id, $login, $password, $name, $last_name, $signature);


  }
}
?>
