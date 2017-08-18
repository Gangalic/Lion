<?php
  namespace trunk\admin;
  require_once(__DIR__."/../gelma/php/src/controller/Controller.php");
  use \php\src\controller as Controller;

  define("UPDATE", 1);

  $uri;
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $uri = $_GET["url"];
  } elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"),$post_vars);
    $uri = $post_vars["url"];
    foreach($post_vars as $key => $value){
      $_POST[$key] = $value;
    }
  } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uri = $_POST["url"];
  } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"),$post_vars);
    $uri = $post_vars["url"];
  }

  define("LANGUAGE", "English");
  define("FK_USER", "1");
  $controller = new Controller\Controller();
  $controller->run($uri);

  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (strpos($uri, 'update') !== false){
      //if the uri contains update
      $controller->display_updt_form();
    } else {
      $controller->display_as_admin();
    }
  }
?>
